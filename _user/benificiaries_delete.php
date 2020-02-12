<?php
session_start();
include "../db.php";

$id = $_POST['id'];
$result = $con->query("DELETE FROM benificiaries WHERE id = $id");

if (!$con->error) {
	$_SESSION['success'] = "Benificiary deleted successfully";
	header("location: benificiaries.php");
	exit();
} else {
	$_SESSION['error'] = $con->error;
	header("location: benificiaries.php");
	exit();
}
?>