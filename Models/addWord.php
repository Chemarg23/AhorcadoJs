<?php
$pdo = new PDO("mysql:host=localhost;dbname=josemariaramirez", 'josemariaramirez', "yKb!n224");
$categoria = $_POST['categoria'];
$palabra = $_POST['palabra'];

$sql = "INSERt INTO words VALUES (null,'$palabra', '$categoria')";
$res = $pdo->query($sql);

echo json_encode($_POST);