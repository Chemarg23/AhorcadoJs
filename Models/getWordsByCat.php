<?php 
$wordsArray = array();
$pdo = new PDO("mysql:host=localhost;dbname=josemariaramirez", 'josemariaramirez', "yKb!n224");
$sql = "SELECt word FROM words Where category_id = {$_GET['categoria']}"; 
$res = $pdo->query($sql);
while ($word = $res->fetch(PDO::FETCH_ASSOC)) {
    $wordsArray[] = $word;
}
echo json_encode($wordsArray);
