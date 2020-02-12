<?php
session_start();

if (!isset($_POST['conf'])) {
	header("location: dashboard.php");
	exit();
}

include "../db.php";

$accno = $_POST['accno'];
$action = $_POST['action'];
$mark = $_POST['mark'];
$id = $_POST['id'];

$result = $con->query("SELECT * FROM reports WHERE id = $id AND status = 'Pending'");
if ($result->num_rows < 1) {
	$_SESSION['error'] = "The reported account is no longer pending.";
	header("location: lostatm.php");
	exit();
}

if ($mark == "true") {
	$con->query("UPDATE accounts
					SET status = 'Lost'
				  WHERE account_no = $accno");
}

$con->query("UPDATE reports
				SET status = '$action'
			  WHERE account_no = $accno");

if (!$con->error) {
	$_SESSION['success'] = ($mark == "true" ? "Account marked as lost successfully" : "Lost atm report has been denied");
	header("location: lostatm.php");
	exit();
} else {
	$_SESSION['error'] = $con->error;
	header("location: lostatm.php");
	exit();
}
?>