<?php
include "../db.php";

$id = $_POST['id'];
$result = $con->query("SELECT * FROM accounts WHERE id = $id");
echo json_encode($result->fetch_assoc());
?>