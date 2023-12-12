<?php

$pdo = new PDO("mysql:host=localhost;dbname=josemariaramirez", 'josemariaramirez', "yKb!n224");

try {
    $stmt = $pdo->prepare("INSERt INTO categorias VALUES (null, :categoria)");
    $stmt->bindParam(':categoria', $_GET['categoria']);

    if ($stmt->execute()) {
        $success = ["success" => true];
        echo json_encode($success);
    }else{
        $error = ["error" => $e->getMessage()];
        echo json_encode($error);
    }
} catch (PDOException $e) {
    $error = ["error" => $e->getMessage()];
    echo json_encode($error);
}
