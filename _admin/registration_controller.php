<?php
session_start();

if (!isset($_SESSION['usertype']) || $_SESSION['usertype'] != "Admin") {
	header("Location: ../login.php");
	exit();
}

if (!isset($_POST['reg-submit'])) {
	header("Location: ../login.php");
	exit();
}

include "../db.php";

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$mi = $_POST['mi'];
$ctn = $_POST['ctn'];
$add = $_POST['add'];
$dob = $_POST['dob'];
$uname = $_POST['uname'];
$pass = $_POST['pass'];
$cpass = $_POST['cpass'];
$err="";

if($dob > '2003-12-31') {
	$err .= "*Date of birth must be atleast 15 years old to create an account. <br>";
}
if(strlen($fname) > 50) {
	$err .= "*first name is too long. <br>";
}
if(strlen($lname) > 50) {
	$err .= "*last name is too long. <br>";
}
if(strlen($uname) > 50) {
	$err .= "*username is too long. <br>";
}
if(1 === preg_match('~[0-9]~', $fname)) {
	$err .= "*first name is invalid. <br>";
}
if(1 === preg_match('~[0-9]~', $lname)) {
	$err .= "*last name is invalid. <br>";
}
if(1 === preg_match('~[0-9]~', $uname)) {
	$err .= "*username is invalid. <br>";
}
if(1 === preg_match('~[0-9]~', $mi)) {
	$err .= "*middle initital is invalid. <br>";
}
if(strlen($fname) < 2) {
	$err .= "*first name is too short. <br>";
}
if(strlen($lname) < 2) {
	$err .= "*last name is too short. <br>";
}
if(strlen($uname) < 2) {
	$err .= "*username is too short. <br>";
}
if(strlen($mi) > 1) {
	$err .= "*middle initital is too long. <br>";
}
if(strlen($ctn) > 11 || strlen($ctn) < 11) {
	$err .= "*Please enter a valid contact number. <br>";
}
if ($pass != $cpass) {
	$err .= "*Passwords do not match. <br>";
}
if (checkctn($con, $ctn)) {
	$err .= "*Contact number is already taken. <br>";
}
if (checkuname($con, $uname)) {
	$err .= "*Username is already taken. <br>";
}
if(!empty($err)) {
	$_SESSION['error'] = $err;
	header("Location: registration.php");
	exit();
}
$pass = md5($pass);

$con->query("INSERT INTO users (fname, lname, mi, dob, address, contact, username, password, usertype, lastlogin)
					VALUES ('$fname', '$lname', '$mi', '$dob', '$add', '$ctn', '$uname', '$pass', 'Client', '0000-00-00 00:00:00')");
if (!$con->error) {
	$_SESSION['success'] = "Client registered successfully";
	header("location: registration.php");
	exit();
} else {
	$_SESSION['error'] = $con->error;
	header("location: registration.php");
	exit();
}

function checkuname($con, $uname) {
	$result = $con->query("SELECT * FROM users WHERE username = '$uname'");
	if ($result->num_rows > 0) return true;
}

function checkctn($con, $ctn) {
	$result = $con->query("SELECT * FROM users WHERE contact = '$ctn'");
	if ($result->num_rows > 0) return true;
}
?>