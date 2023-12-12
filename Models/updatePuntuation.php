<?php
session_start(); 
$usersArray = array();
$pdo = new PDO("mysql:host=localhost;dbname=josemariaramirez", 'josemariaramirez', "yKb!n224");
$sql = "UPDATe usuarios SEt puntuacion = {$_GET['valor']} Where email = '".$_SESSION['mail']."'";
$res = $pdo->query($sql);

    $usersArray['status'] = 'success';

echo json_encode($usersArray);