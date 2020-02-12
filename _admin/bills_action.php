<?php
session_start();

if (!isset($_POST['conf'])) {
	header("location: dashboard.php");
	exit();
}

include "../db.php";

$action = $_POST['action'];
$accno = $_POST['accno'];
$id = $_POST['id'];

$result = $con->query("SELECT * FROM transactions WHERE id = $id AND status = 'Pending'");
$row = $result->fetch_assoc();
$amount = $row['amount'];

if ($result->num_rows < 1) {
	$_SESSION['error'] = "The transaction is no longer pending.";
	header("location: bills.php");
	exit();
}

$result = $con->query("SELECT balance FROM accounts WHERE account_no = '$accno'");
$row = $result->fetch_assoc();
$bal = $row['balance'] - $amount;
$bal = ($bal < 0 ? 0 : $bal);

if ($bal < 100) {
	$_SESSION['error'] = "The minimum maintaining balance is Php 100.00<br>
						  The payee's remaining balance after the transaction will be Php ".number_format($bal, 2);
	header("location: transfer.php");
	exit();				 
}

$con->query("UPDATE transactions
				SET status = '$action'
			  WHERE id = $id");

$con->query("UPDATE accounts
				SET balance = '$bal'
			  WHERE account_no = $accno");

if (!$con->error) {
	$_SESSION['success'] = ($action == "Approved" ? "Transaction was successfully approved" : "Transaction was denied");
	header("location: bills.php");
	exit();
} else {
	$_SESSION['error'] = $con->error;
	header("location: bills.php");
	exit();
}
?>