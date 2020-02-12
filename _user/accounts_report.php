<?php
session_start();

include "../db.php";
$id = $_POST['id'];

$result = $con->query("SELECT * FROM accounts WHERE status = 'Inactive' AND account_no = '$id'");

if ($result->num_rows) {
	$_SESSION['error'] = "That account is already markd as inactive.<br>
							If you wish to reactivate the account, please go to the nearest branch in your area.";
	header("location: accounts.php");
	exit();
}

$result = $con->query("SELECT * FROM accounts WHERE status = 'Lost' AND account_no = '$id'");

if ($result->num_rows) {
	$_SESSION['error'] = "That account is already marked as lost";
	header("location: accounts.php");
	exit();
}

$result = $con->query("SELECT * FROM reports WHERE account_no = $id");

if ($result->num_rows) {
	$_SESSION['error'] = "That account has already been reported as lost";
	header("location: accounts.php");
	exit();
}

$con->query("INSERT INTO reports (account_no) VALUES ($id)");

if ($con->error == "") {
	$_SESSION['success'] = "Account succssfully reported as lost.";
	header("location: accounts.php");
} else {
	$_SESSION['error'] = $con->error;
	header("location: accounts.php");
}
?>