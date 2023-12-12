function validarYEnviar() {
  // Obtiene los valores de los campos
  var email = $("#email").val();
  var password = $("#password").val();

  // Realiza la validación en el frontend
  validarEmail(email);
  validarPassword(password);

  // Si la validación es exitosa, puedes enviar los datos al servidor
  if (validarEmail(email) && validarPassword(password)) {
    $.ajax({
      url: `Models/logIn.php?mail=${email}&pass=${password}`,
      dataType: "json",
      success: function (response) {
        console.log(response);
        if (response.status === "success") {
          window.location.href = "views/adminSite.php";
        } else {
          if (response.errores.email != undefined) {
            $("#email").addClass("is-invalid");
            $("#emailError").text(response.errores.email);
          }
          if (response.errores.pass != undefined) {
            $("#password").addClass("is-invalid");
            $("#passwordError").text(response.errores.pass);
          }
        }
      },
      error: function (error) {
        console.log("Error en la solicitud AJAX:", error);
      },
    });
  }
}

function validarEmail(email) {
  var emailError = $("#emailError");
  // Validación simple de email (puedes mejorar según tus necesidades)
  $("#email").removeClass("is-valid is-invalid");
  if (!email || email.indexOf("@") === -1) {
    $("#email").addClass("is-invalid");
    emailError.text("Por favor, introduce un correo electrónico válido.");
    return false;
  } else {
    $("#email").addClass("is-valid");
    emailError.text("");
    return true;
  }
}

function validarPassword(password) {
  var passwordError = $("#passwordError");
  $("#password").removeClass("is-valid is-invalid");
  // Validación simple de contraseña (puedes mejorar según tus necesidades)
  if (!password || password.length < 0) {
    $("#password").addClass("is-invalid");
    passwordError.text("Debe introducir la contraseña");
    return false;
  } else {
    $("#email").addClass("is-valid");
    passwordError.text("");
    return true;
  }
}
