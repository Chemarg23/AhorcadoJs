<?php

$pdo = new PDO("mysql:host=localhost;dbname=josemariaramirez", 'josemariaramirez', "yKb!n224");

if (isset($_POST['user'])) {
    $sql = "DELETe FROM usuarios WHERE user_id =" . $_POST['id'];
    $res = $pdo->query($sql);
    $result = ["status" => "success"];
    header('Content-Type: application/json');
    echo json_encode($result);
} else if (isset($_POST['word'])) {
    $sql = "DELETe FROM words WHERE word_id =" . $_POST['id'];
    $res = $pdo->query($sql);
    $result = ["status" => "success"];
    header('Content-Type: application/json');
    echo json_encode($result);
} else if (isset($_POST['category'])) {
    $sql = "DELETe FROM categorias WHERE category_id =" . intval($_POST['id']);
    $res = $pdo->query($sql);
    $result = ["status" => "success"];
    header('Content-Type: application/json');
    echo json_encode($result);
}else{
    $error = ['status' => 'failure'];
    echo json_encode($error);
}
