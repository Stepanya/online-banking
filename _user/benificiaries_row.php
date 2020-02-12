<?php
include "../db.php";

$id = $_POST['id'];
$result = $con->query("SELECT * FROM benificiaries WHERE id = $id");
echo json_encode($result->fetch_assoc());
?>