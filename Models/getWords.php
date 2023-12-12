<?php 
$wordsArray = array();
$pdo = new PDO("mysql:host=localhost;dbname=josemariaramirez", 'josemariaramirez', "yKb!n224");
$sql = "SELECT word_id as id, word, categoria FROM words w, categorias c Where w.category_id = c.category_id"; // Corregir aquí
$res = $pdo->query($sql);
while ($word = $res->fetch(PDO::FETCH_ASSOC)) {
    $wordsArray[] = $word;
}
echo json_encode($wordsArray);
