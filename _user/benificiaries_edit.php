<?php

session_start();

if (!isset($_POST['edit'])) {
	header("location: dashboard.php");
	exit();
}

include "../db.php";

$id = $_POST['id'];
$nickname = $_POST['nickname'];
$accno = $_POST['accno'];

$result = $con->query("SELECT * FROM accounts WHERE account_no = '$accno'");
if ($result->num_rows < 1) {
	$_SESSION['error'] = "The account number doesn't exits.";
	header("location: benificiaries.php");
	exit();
}

$con->query("UPDATE benificiaries SET 
				nickname = '$nickname',
				account_no = '$accno'
				WHERE id = $id");

if ($con->error) {
	$_SESSION['error'] = $con->error;
	header("location: benificiaries.php");
	exit();
} else {
	$_SESSION['success'] = "Account was updated.";
	header("location: benificiaries.php");
	exit();
}

?>