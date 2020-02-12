<?php 

session_start(); 

if (isset($_POST['login'])) {

	$pass = md5($_POST['pass']);
	$uname = addslashes($_POST['uname']);

	include "db.php";

	$usertypes=['users', 'admin'];
	$p = ['password', 'password'];

	foreach ($usertypes as $index => $value) {

		$result = $con->query("SELECT * FROM $value WHERE username = '$uname'");
		$row = $result->fetch_assoc();

		if ($result->num_rows == 1 && $index == 0) {
			if($pass == $row[$p[$index]]) {
				set_session($con, $row); 
				header("Location: _user/dashboard.php"); 
				exit();
			}
		} elseif ($result->num_rows == 1 && $index == 1) {
			if($pass == $row[$p[$index]]) {
				set_session($con, $row);
				header("Location: _admin/dashboard.php");
				exit();
			}
		}

	}

	header("Location: index.php");
	$_SESSION['error'] = "Username or Password is incorrect.";
	exit();
} elseif (isset($_SESSION['usertype']) && $_SESSION['usertype'] == "Admin") {
	header("Location: _admin/dashboard.php");
	exit();
} elseif (isset($_SESSION['usertype']) && $_SESSION['usertype'] == "Client") {
	header("Location: _user/dashboard.php");
	exit();
} else {
	header("Location: index.php");
	exit();
}

function set_session($con, $row) {
	
	$type = ucfirst($row['usertype']);
	$_SESSION['usertype'] = $type;
	$_SESSION['id'] = $row['id'];
	$_SESSION['uname'] = $row['username'];
	$_SESSION['lastlogin'] = date('M d, Y h:i', strtotime($row['lastlogin']));
	$_SESSION['name'] = ucfirst($row['fname']).' '.ucfirst($row['mi']).' '.ucfirst($row['lname']);
	$con->query("UPDATE ".($type == 'Admin' ? $type : 'users')." SET lastlogin = NOW() WHERE id = ".$row['id']);
}

?>