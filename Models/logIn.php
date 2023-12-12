<?php

$errors = [];
$rol = 0;

if (isset($_GET['mail']) && isset($_GET['pass'])) {
    $mail = $_GET['mail'];
    $password = $_GET['pass'];
    
    if (validarCredenciales($mail, $password)) {
        $response = ['status' => 'success', 'rol' => $rol];
    } else {
        $errors["pass"] = "Contraseña incorrecta";
        $response = ['status' => 'failure', "errores" => $errors, 'password' => $password];
    }
    echo json_encode($response);
} else {
    $response = ['status' => 'error'];
    echo json_encode($response);
}
function validarCredenciales($mail, $password)
{
    global $errors;
    global $rol;

    $pdo = new PDO("mysql:host=localhost;dbname=josemariaramirez", 'josemariaramirez', "yKb!n224");
    $sql = "SELEcT nombre, user_id,email, contraseña, rol FROM usuarios WHERE email = '$mail'";
    $res = $pdo->query($sql);


    if ($res) {
        $row = $res->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            $errors["email"] = "No se ha encontrado su usuario";
            return false;
        }

        $rol = $row['rol'];
        $result = ($mail === $row['email'] && password_verify($password, $row['contraseña']));
        if($result){
            session_start();
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['mail'] = $mail;
            $_SESSION['rol'] = $rol;
            $_SESSION['nombre'] = $row['nombre'];
        }
        return $result;
    } else {

        $errors["email"] = "Error en la consulta";
        return false;
    }
}
