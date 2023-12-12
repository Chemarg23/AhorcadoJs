<?php
$categoryArray = array();
$pdo = new PDO("mysql:host=localhost;dbname=josemariaramirez", 'josemariaramirez', "yKb!n224");
if ($_GET) {
    $sql = 'SELECt category_id as catId, categoria FROM categorias c WHERE (SELECT COUNT(*) FROM words w WHERE w.category_id =c.category_id) > 0;';
    $res = $pdo->query($sql);
    while ($category = $res->fetch(PDO::FETCH_ASSOC)) {
        $categoryArray[] = $category;
    }
} else {

    $sql = "SELECt category_id as catId, categoria FROM categorias ";
    $res = $pdo->query($sql);
    while ($category = $res->fetch(PDO::FETCH_ASSOC)) {
        $categoryArray[] = $category;
    }
}
echo json_encode($categoryArray);
