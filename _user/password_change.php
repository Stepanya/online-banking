<?php
session_start();

if (!isset($_POST['change'])) {
	header("location: dashboard.php");
	exit();
}

include "../db.php";

$pass = $_POST['pass'];
$cpass = $_POST['cpass'];
$curpass = $_POST['curpass'];
$id = $_POST['id'];
$err="";

$result = $con->query("SELECT password FROM users WHERE id = $id");
$row = $result->fetch_assoc();

if ($row['password'] != md5($curpass)) {
	$err .= "*Password is incorrect. <br>";
}
if ($pass != $cpass) {
	$err .= "*Passwords do not match. <br>";
} 
if (strlen($pass) < 8) {
	$err .= "*Password must be atleast 8 characters. <br>";
}

if(!empty($err)) {
	$_SESSION['error'] = $err;
	header("Location: password.php");
	exit();
}

$con->query("UPDATE users 
				SET password = '".md5($pass)."'
			  WHERE id = $id");

if (!$con->error) {
	$_SESSION['success'] = "Password updated successfully";
	header("location: password.php");
	exit();
} else {
	$_SESSION['error'] = $con->error;
	header("location: password.php");
	exit();
}
?>