<?php


session_start();

if (isset($_POST['currentPassword']) && isset($_POST['newPassword'])) {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];

    // Tu conexión PDO aquí (asegúrate de configurar correctamente tu conexión)
    $pdo = new PDO("mysql:host=localhost;dbname=josemariaramirez", 'josemariaramirez', "yKb!n224");
    
    // Obtén el ID de usuario de la sesión
    $userId = $_SESSION['user_id'];

    // Verifica la contraseña actual
    $stmt = $pdo->prepare("SELECt contraseña FROM usuarios WHERE user_id = :userId");
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();

    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($userData && password_verify($currentPassword, $userData['contraseña'])) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updateStmt = $pdo->prepare("UPDATe usuarios SEt contraseña = :newPassword WHERE user_id = :userId");
        $updateStmt->bindParam(':newPassword', $hashedPassword, PDO::PARAM_STR);
        $updateStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $updateStmt->execute();

        // Envía una respuesta exitosa al cliente
        $response = ['success' => true, 'message' => 'Contraseña actualizada correctamente'];
    } else {
        // La contraseña actual es incorrecta, envía un mensaje de error
        $response = ['success' => false, 'message' => 'Contraseña actual incorrecta'];
    }

    // Devuelve la respuesta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Si los datos no se enviaron correctamente, envía un mensaje de error
    $response = ['success' => false, 'message' => 'Datos incorrectos'];
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
