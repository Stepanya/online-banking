<?php
session_start();
include "../db.php";

$id = $_POST['id'];
$result = $con->query("DELETE FROM users WHERE id = $id");

if (!$con->error) {
	$_SESSION['success'] = "Client deleted successfully";
	header("location: clients.php");
	exit();
} else {
	$_SESSION['error'] = $con->error;
	header("location: clients.php");
	exit();
}
?>