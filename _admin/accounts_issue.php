<?php

session_start();

if (!isset($_POST['issue'])) {
	header("location: dashboard.php");
	exit();
}

include "../db.php";

$id = $_POST['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$mi = $_POST['mi'];
$type = $_POST['type'];
$amount = $_POST['amount'];
$pin = $_POST['pin'];
$accno = $_POST['accno'];
$con->query("INSERT INTO accounts (user_id, type, fname, lname, mi, account_no, pin, balance)
					VALUES ('$id', '$type', '$fname', '$lname', '$mi', '$accno', '$pin', '$amount')");

if ($con->error) {
	$_SESSION['error'] = $con->error;
	header("location: clients.php");
	exit();
} else {
	$_SESSION['success'] = "Account was successfully issued.<br>
							Account Number: $accno<br>
							Pin Number: $pin";
	header("location: clients.php");
	exit();
}

?>