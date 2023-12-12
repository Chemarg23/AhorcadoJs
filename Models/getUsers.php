<?php
session_start();
$usersArray = array();
$pdo = new PDO("mysql:host=localhost;dbname=josemariaramirez", 'josemariaramirez', "yKb!n224");
if (!isset($_GET['val'])) {
    $sql = "SELECt user_id as id, nombre, email, puntuacion FROM usuarios ";
} else{
    $sql = "SELECt puntuacion FROM usuarios where email = '{$_SESSION['mail']}'";
}
$res = $pdo->query($sql);
while ($user = $res->fetch(PDO::FETCH_ASSOC)) {
    $usersArray[] = $user;
}
echo json_encode($usersArray);
