<?php
include "../db.php";

$id = $_POST['id'];
$result = $con->query("SELECT * FROM accounts WHERE account_no = $id");
echo json_encode($result->fetch_assoc());
?>