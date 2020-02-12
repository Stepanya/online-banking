<?php

session_start();

if (!isset($_POST['edit'])) {
	header("location: dashboard.php");
	exit();
}

include "../db.php";

$id = $_POST['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$mi = $_POST['mi'];
$type = $_POST['type'];
$status = $_POST['status'];
$bal = $_POST['bal'];
$pin = ($_POST['pin'] != "" ? ", pin = {$_POST['pin']} " : "");
$accno = $_POST['accno'];

$con->query("UPDATE accounts SET 
				fname = '$fname',
				lname = '$lname',
				mi = '$mi',
				type = '$type',
				balance = '$bal',
				status = '$status',
				balance = '$bal',
				account_no = '$accno'
				$pin
				WHERE id = $id");

if ($con->error) {
	$_SESSION['error'] = $con->error;
	header("location: accounts.php");
	exit();
} else {
	$_SESSION['success'] = "Account was updated.";
	header("location: accounts.php");
	exit();
}

?>