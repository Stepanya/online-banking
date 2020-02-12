<?php
session_start();
include "../db.php";

$id = $_POST['id'];
$result = $con->query("DELETE FROM accounts WHERE id = $id");

if (!$con->error) {
	$_SESSION['success'] = "Account deleted successfully";
	header("location: accounts.php");
	exit();
} else {
	$_SESSION['error'] = $con->error;
	header("location: accounts.php");
	exit();
}
?>