<?php
include "../db.php";
session_start();

if (!isset($_POST['deposit'])) {
	header("location: dashboard.php");
	exit();
}

$accno = $_POST['accno'];
$amount = $_POST['amount'];

$result = $con->query("SELECT * FROM accounts WHERE account_no = '$accno'");
if ($result->num_rows == 0) {
	$_SESSION['error'] = "The account does not exist.";
	header("location: deposit.php");
	exit();
}

$result = $con->query("SELECT * FROM accounts WHERE account_no = '$accno' AND status = 'Active'");
if ($result->num_rows == 0) {
	$_SESSION['error'] = "The account must be active to continue.";
	header("location: deposit.php");
	exit();
}

if (!checkamount($amount)) {
	$_SESSION['error'] = "Amount must be in denominations of Php 50.00";
	header("location: deposit.php");
	exit();
}

$result = $con->query("SELECT balance FROM accounts WHERE account_no = '$accno'");
$row = $result->fetch_assoc();
$bal = $row['balance'];
$afterbal = $bal + $amount;					  
$ref = ref();

$con->query("INSERT INTO transactions (account_no, reference, beneficiary, description, amount, bal_after_from, bal_after_to, date) VALUES ('$accno','$ref','$accno','Cash Deposit','$amount', '$bal', '$afterbal', NOW())");

if ($con->error != "") {
	$_SESSION['error'] = $con->error;
	header("location: deposit.php");
	exit();
}

$con->query("UPDATE accounts SET balance = $bal WHERE account_no = $accno");
if ($con->error != "") {
	$_SESSION['error'] = $con->error;
	header("location: deposit.php");
	exit();
}

$_SESSION['success'] = "Cash deposit was successful.<br><br>
						Amount Transferred: Php ".number_format($amount, 2)."<br>
						Recipient: $accno<br>
						Current Balance: Php ".number_format($bal, 2)."<br>
						Reference: ".$ref;
header("location: deposit.php");
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