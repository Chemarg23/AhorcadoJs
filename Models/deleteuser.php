<?php 

$pdo = new PDO("mysql:host=localhost;dbname=josemariaramirez", 'josemariaramirez', "yKb!n224");

$sql = "DELETe FROM users WHERE user_id =".intval($_POST['id']);
$res = $pdo->query($sql);
$result = ["status" => "success"];
header('Content-Type: application/json');
echo json_encode($result);

