<?php
session_start();
if (!$_SESSION) {
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ahorcado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/divjax/libs/font-awesome/5.15.4/css/divll.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" href="../css/style2.css">
</head>

<body class="">
    <div class="main mt-5">
        <h1>Ahorcado</h1>

        <div class="select">
            <h3>Seleccione la categoria</h3>
            <select id="categories" class="form-select">
                <option value="">Seleccione una categoria</option>
            </select><br>
            <button onclick="startGame()">Empezar</button>
        </div>

        <div style="display: none;" class="container mt-5" id="game">
            <div class="row mt-5">
                <div class="col-md-5">
                    <img src="img/6.jpg" width="170%" height="90%">
                </div>
                <div class="col-md-2 data mt-5">
                    <br>
                    <p class="puntuacion"></p>
                    <p class="aciertos"></p>
                    <p class="fallos"></p>
                    <p class="rondas"></p>
                </div>
                <div class="col-md-4 letters mr-3">
                    <p class="categoria mb-3"></p>
                    <p id="palabraOculta"></p>
                    <p id="intentosRestantes"></p>
                    <p id="mensajeResultado"></p>
                    <div id="replay"> </div>
                    <p>Introduce una letra:</p>
                    <div id="button-container"> </div>
                </div>
            </div><button class="" id="finish">Terminar</button>
            <a href="adminSite.php" class="" style="position: absolute; left:100px; background-color: lightgray; border-radius:20px"><button class="btn btn-secundary">Volver</button></a>
        </div>

    </div>
    <script src="../js/ahorcado.js"></script>
</body>

</html>