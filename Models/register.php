<?php

try {
    $pdo = new PDO("mysql:host=localhost;dbname=josemariaramirez", 'josemariaramirez', "yKb!n224");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERt INTO usuarios VALUES (null, ?, ?, ?, ?, 0, 0)");
    $stmt->bindParam(1, $nombre);
    $stmt->bindParam(2, $email);
    $stmt->bindParam(3, $password);
    $stmt->bindParam(4, $telefono);
    $stmt->execute();

    $response = ['success' => true, 'message' => 'Registro exitoso'];

    if ($stmt) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si se obtuvieron resultados antes de acceder a 'max_id'
        if ($result) {
            $maxId = $result['max_id'];
            // Evitar problemas con NULL
            $maxId = $maxId !== null ? $maxId + 1 : 1;

            // Iniciar la sesión
            session_start();
            $_SESSION['user_id'] = $maxId;
            $_SESSION['mail'] = $mail; // Asegúrate de tener $mail definido en algún lugar
            $_SESSION['rol'] = 0;
            $_SESSION['nombre'] = $nombre;
        }
    }
} catch (PDOException $e) {
    $response = ['success' => false, 'message' => 'Error en el registro: ' . $e->getMessage()];
}

// Enviar respuesta JSON al cliente
header('Content-Type: application/json');
echo json_encode($response);
