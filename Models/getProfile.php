<?php
session_start();
$dataArray = array();
$pdo = new PDO("mysql:host=localhost;dbname=josemariaramirez", 'josemariaramirez', "yKb!n224");
$sql = "SELECt u.* FROM usuarios u WHERE u.user_id=".$_SESSION['user_id'];
$res = $pdo->query($sql);
while ($category = $res->fetch(PDO::FETCH_ASSOC)) {
    $dataArray[] = $category;
}

$sql = "SELECt p.* FROM usuarios u, partidas p WHERE u.user_id = p.user_id AND u.user_id =".$_SESSION['user_id'];
$res = $pdo->query($sql);
while ($category = $res->fetch(PDO::FETCH_ASSOC)) {
    $dataArray[] = $category;
}
echo json_encode($dataArray);
