<?php
$pdo = new PDO("mysql:host=localhost;dbname=josemariaramirez", 'josemariaramirez', "yKb!n224");
session_start();

// Assuming $_GET['palabra'], $_GET['intentos'], $_GET['variacion'], $_GET['resultado'], and $_SESSION['user_id'] are properly validated and sanitized.
$palabra = $_GET['palabra'];
$intentos = $_GET['intentos'];
$variacion = $_GET['variacion'];
$resultado = $_GET['result'];
$user_id = $_SESSION['user_id'];

$sql = "INSERt INTO partidas (palabra, intentos, var_puntuacion, resultado, user_id) VALUES (:palabra, :intentos, :variacion, :resultado, :user_id)";
$stmt = $pdo->prepare($sql);

$stmt->bindParam(':palabra', $palabra, PDO::PARAM_STR);
$stmt->bindParam(':intentos', $intentos, PDO::PARAM_INT);
$stmt->bindParam(':variacion', $variacion, PDO::PARAM_INT);
$stmt->bindParam(':resultado', $resultado, PDO::PARAM_STR);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

$res = $stmt->execute();

$status = ['status' => 'success'];
echo json_encode($status);