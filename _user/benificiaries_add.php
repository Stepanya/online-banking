<?php

session_start();

if (!isset($_POST['add'])) {
	header("location: dashboard.php");
	exit();
}

include "../db.php";

$uname = $_SESSION['uname'];
$nickname = $_POST['nickname'];
$accno = $_POST['accno'];

$result = $con->query("SELECT * FROM benificiaries WHERE account_no = '$accno'");
if ($result->num_rows > 0) {
	$_SESSION['error'] = "Benificiary already exists.";
	header("location: benificiaries.php");
	exit();
}

$result = $con->query("SELECT * FROM accounts WHERE account_no = '$accno'");
if ($result->num_rows < 1) {
	$_SESSION['error'] = "The account number doesn't exits.";
	header("location: benificiaries.php");
	exit();
}

$con->query("INSERT INTO benificiaries (account_no, nickname, username)
					VALUES ('$accno', '$nickname', '$uname')");

if ($con->error) {
	$_SESSION['error'] = $con->error;
	header("location: benificiaries.php");
	exit();
} else {
	$_SESSION['success'] = "Benificiary was successfully added";
	header("location: benificiaries.php");
	exit();
}

?>