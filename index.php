<?php 
session_start();
if(isset($_GET['sign'])){
    session_destroy();
}elseif($_SESSION){
    header("Location: views/adminSite.php");
}

?>
<!DOCTYPE html>
<html lang="en" class="border-l">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/divjax/libs/font-awesome/5.15.4/css/divll.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        *{
            overflow: hidden;
            text-decoration: none;
        }
        .custom-container {
            width: 80%;
            margin: auto;
            margin-top: 50px;
        }

        .custom-card {
            border: 0;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
        }

        .card-body-log {
            padding: 50px;
        }

        .custom-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .error-message {
            color: #dc3545;
            margin-top: 5px;
        }
    </style>
    <title>Iniciar Sesión</title>
</head>
<body>

<div class="container custom-container">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-12 col-md-12 col-lg-6">
            <div class="card custom-card">

                <div class="card-body card-body-log p-5 text-center mt-3">

                    <form id="loginForm">
                        <div class="mb-md-5 mt-md-4">
                            admin: manolo@gmail.com 
                            pass: admin
                            <h2 class=" mb-2 ">Iniciar Sesión</h2>
                            <p class="text-muted mb-5">Introduzca su usuario y contraseña</p>

                            <div class="mb-4 mail-cont">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" id="email" class="form-control form-control-lg" />
                                <div class="error-message" id="emailError"></div>
                            </div>

                            <div class="mb-3 pass-cont">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" id="password" class="form-control form-control-lg" />
                                <div class="error-message" id="passwordError"></div>
                            </div>

                            <br>
                            <button class="btn btn-primary btn-lg px-5" type="button" onclick="validarYEnviar()">Iniciar Sesión</button><br><br>
                            <a href="views/register.php">No tienes cuenta? Registrate aquí</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="js/LogInController.js"></script>
</body>

</html>