<?php
include "../db.php";
session_start();

if (!isset($_POST['accno'])) {
	header("location: dashboard.php");
	exit();
}

$accno = $_POST['accno'];
$biller = $_POST['biller'];
$refno = $_POST['refno'];
$amount = $_POST['amount'];
$pin = $_POST['pin'];

$result = $con->query("SELECT * FROM accounts WHERE account_no = '$accno' AND status = 'Active'");
if ($result->num_rows == 0) {
	$_SESSION['error'] = "Your must be active to continue.";
	header("location: bill.php");
	exit();
}

$result = $con->query("SELECT pin FROM accounts WHERE account_no = '$accno'");
$row = $result->fetch_assoc();
if ($row['pin'] != $pin) {
	$_SESSION['error'] = "Pin code is incorrect.";
	header("location: bill.php");
	exit();
}

if (!checkamount($amount)) {
	$_SESSION['error'] = "Amount must be in denominations of Php 50.00";
	header("location: bill.php");
	exit();
}

$result = $con->query("SELECT balance FROM accounts WHERE account_no = '$accno'");
$row = $result->fetch_assoc();
$bal = $row['balance'] - $amount;
$bal = ($bal < 0 ? 0 : $bal);

if ($bal < 100) {
	$_SESSION['error'] = "The minimum maintaining balance is Php 100.00<br>
						  Your remaining balance after the transaction will be Php ".number_format($bal, 2);
	header("location: bill.php");
	exit();				 
}

$result = $con->query("SELECT balance FROM accounts WHERE account_no = '$biller'");
$row = $result->fetch_assoc();
$rec_bal = $row['balance'] + $amount;					  
$ref = ref();

$con->query("INSERT INTO transactions (account_no, reference, beneficiary, description, amount, bal_after_from, date, bill_ref, status) VALUES ('$accno','$ref','$biller','Bills Payment','$amount', '$bal', NOW(), '$refno', 'Pending')");

if ($con->error != "") {
	$_SESSION['error'] = $con->error;
	header("location: bill.php");
	exit();
}

$_SESSION['success'] = "Bill payment was now pending approval.<br><br>
						Bill Amount: Php ".number_format($amount, 2)."<br>
						Biller: $biller<br>
						Reference: ".$ref;
header("location: bill.php");
exit();

function checkamount($num) {
	if ($num > 0 && $num % 50 == 0) {
		return true;
	} else {
		return false;
	}
}
function ref() {
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $nums = '0123456789';
    $charLength = strlen($chars);
    $numLength = strlen($nums);
    $ref = '';
    for ($i = 0; $i < 2; $i++) {
    	$ref .= $chars[rand(0, $charLength - 1)];
    }
    for ($i = 2; $i < 10; $i++) {
    	$ref .= $nums[rand(0, $numLength - 1)];
    }
    return $ref;
}

?>