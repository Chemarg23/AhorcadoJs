<?php
session_start();
if (!$_SESSION) {
  header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/divjax/libs/font-awesome/5.15.4/css/divll.min.css">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="../css/adminstyles.css">
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
  <?php if ($_SESSION['rol']) { ?>
    <script src="../js/userTable.js"></script>
  <?php } else { ?>
    <script src="../js/normalUserTable.js"></script>
  <?php } ?>
  <title>AdminSite</title>
  <style>

  </style>
</head>

<body>

  <main class="min-vh-100 container">

    <div class="row">
      <aside class="min-vh-100 col-md-3 asid bg-dark" style="height: 100%,">
        <div class="flex-column flex-shrink-0 p-3 mr-2 bg-light min-vh-100 bg-dark text-white" style="width: 280px; height:100%">
          <div class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-light text-decoration-none">
            <span class="fs-4 text-white">Ahorcado</span>
          </div>

          <hr>
          <a href="ahorcado.php" class="btn"><button class="btn btn-primary" style="width: 230px;">Jugar</button></a>
          <hr>
          <ul class="nav nav-pills flex-column mb-auto">
            <?php if ($_SESSION['rol']) { ?>

              <li class="nav-item">
                <div class="nav-link cursor-pointer  text-white active list-users" aria-current="page">
                  <i class="bi bi-person"></i>
                  Usuarios
                </div>
              </li>
              <li class="nav-item">
                <div class="nav-link cursor-pointer link-light list-words">
                  <i class="bi bi-file-word-fill"></i>
                  Palabras
                </div>
              </li>
              <li class="nav-item">
                <div class="nav-link cursor-pointer link-light add-word">
                  <i class="bi bi-file-plus-fill"></i>
                  Añadir palabra
                </div>
              </li>
              <li class="nav-item">
                <a>
                  <div class="nav-link cursor-pointer link-light add-category">

                    <i class="bi bi-bookmark-check-fill"></i>
                    Categorias

                  </div>
                </a>
              </li>
              <hr>
            <?php } ?>
            <li class="nav-item active">
              <div class="nav-link cursor-pointer link-light show-perfil active">
                <i class="bi bi-bookmark-check-fill"></i>
                Perfil
              </div>
            </li>
            <div style="position: absolute; bottom:0;">
              <hr width="250px">
              <div class="dropdown user mb-4">
                <div class="d-flex align-items-center link-light text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                 
                  <strong><?= $_SESSION['nombre'] ?></strong>
                </div>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                  <li class="nav-item bg">
                    <div class="dropdown-item link-dark" style="text-decoration: none; " id="toChange">Cambiar contraseña</a></div>
                  </li>
                  <li class="nav-item bg">
                    <div class="dropdown-item"><a href="../index.php?sign=out" class="link-dark" style="text-decoration: none; ">Sign out</a></div>
                  </li>
                </ul>
              </div>
            </div>
        </div>
      </aside>
      <div class="col-md-8 mt-5 p-0 sect">
        <div class="table-responsive" id="userTable">
        </div>
        <div class="table-responsive container" id="wordTable">
        </div>
        <div class="container user">
          <div class="row">
            <h2 style="margin-left: 420px;margin-bottom: 25px;">Perfil</h2>

            <div class="col-md-3" id="userdata">

              <h4>Detalles de Usuario</h4><br>
              <p id="nombreUsuario"></p>
              <p id="usuarioEmail"></p>
              <p id="usuarioPuntuacion"></p>
              <p id="usuarioRol"></p>
            </div>

            <div class="col-md-9" id="matchesTable">
              <h4>Tus partidas</h4>
            </div>
          </div>
        </div>
        <div class="col-md-8 mt-5 p-3 mb-5" id="addForm" style="margin-left: 160px;">
          <div id="addForm">
            <h2 class="ml-5" style="margin-left: 180px;">Añadir una palabra</h2>
            <div class="form-group mb-3">
              <label for="selectOption">Seleccione una categoria:</label>
              <select class="form-select" id="categorySelect">
              </select> <i class="alert  alert-category " style="color: red;"></i>
            </div>

            <div class="form-group mb-3">
              <label for="palabra">Ingrese la palabra:</label>
              <input type="text" class="form-control" id="palabra" placeholder="Escriba aquí">
              <i class="alert alert-word" style="color: red;"></i>
            </div>

            <button type="submit" id="add" class="btn btn-primary">Añadir</button>
          </div>
        </div>
        <div id="addCategory" style="margin-left: 160px;">
          <h2 class="" style="margin-left:100px;">Añadir una categoria</h2>
          <div class="form-group mb-3">

            <label for="showCategory">Lista de categorias existentes:</label>
            <select class="form-select" id="showCategory">
            </select>
          </div>

          <div class="form-group mb-3">
            <label for="category">Ingrese la categoria:</label>
            <input type="text" class="form-control" id="category" placeholder="Escriba aquí">
            <i class="alert alert-word" style="color: red;"></i>
          </div>

          <button type="submit" id="addCategoryButton" class="btn btn-primary">Añadir</button>
        </div>

        <div id="changepass" style="margin-left: 160px;">
          <h2 class="" style="margin-left:170px;">Cambiar contraseña</h2>
          <div class="form-group mb-3">
          <label for="pass">Contraseña</label>
            <input type="password" class="form-control" id="pass" placeholder="Escriba aquí">
          </div>
          <div class="form-group mb-3">
            <label for="newpass">Nueva Contraseña</label>
            <input type="password" class="form-control" id="newPass" placeholder="Escriba aquí">
          </div>

          <div class="form-group mb-3">
            <label for="confirmpass">Confirme la contraseña</label>
            <input type="password" class="form-control" id="confirmpass" placeholder="Escriba aquí">
          </div>
          <div id="errorMessages" style="color: red;"></div>

          <button type="submit" id="changePassBtn" class="btn btn-primary">Añadir</button>
        </div>
      </div>
    </div>



  </main>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


</html>