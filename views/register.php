<?php
session_start();
if (isset($_GET['sign'])) {
    session_destroy();
} elseif ($_SESSION) {
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
    <link rel="stylesheet" href="../css/style.css">
    <style>

        h2{overflow: hidden;}
    .custom-container {
        width: 40%;
        margin: auto;
        margin-top: 50px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        border-radius: 10px;
        text-align: center;
    }

    .custom-title {
        font-size: 24px;
        text-align: center;
        margin-bottom: 20px;
    }

    
    button {
      
        margin-right: auto; /* Centra el botón */
        margin-top: 20px; /* Añade un margen superior */
        display: block; /* Asegura que el botón esté en una línea separada */
    }</style>
    <title>Registro de Usuarios</title>
</head>

<body>

    <div class="custom-container">
        <form id="registrationForm">
            <div class="mb-md-5 ">
                <h2 class="custom-title fw-bold mb-2 text-uppercase">Registrarse</h2>
                <p class="custom-title">Introduzca sus datos</p>
                

                <div class="mb-4">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" id="nombre" class="form-control form-control-lg" required />
                    <div class="invalid-feedback" id="nombreFeedback"></div>
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" class="form-control form-control-lg" required />
                    <div class="invalid-feedback" id="emailFeedback"></div>
                </div>

                <div class="mb-4">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" id="telefono" class="form-control form-control-lg" required />
                    <div class="invalid-feedback" id="telefonoFeedback"></div>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" id="password" class="form-control form-control-lg" required />
                    <div class="invalid-feedback" id="passwordFeedback"></div>
                </div>

                <br>
                <button class="btn btn-primary btn-lg px-5 ml-5" type="button" onclick="validarYRegistrar()">Registrarse</button><br><br>
            </div>
        </form>
    </div>

    </section>
</body>
<script src="../js/register.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>

</html>