$(document).ready(() => {
  removeContent();

  $(".show-perfil").click(showPerfil);

  $(".alert").hide();
  $("#toChange").click(showChangePass);
  $("#changePassBtn").click(changePass);
  showPerfil();
});

function createTable(containerId, headers) {
  let container = $(`#${containerId}`);
  container.html(
    `<table class="table table-bordered table-striped table table-bordered table-hover">
        <thead class="bg-gray-50">
          <tr>${headers
            .map(
              (header) =>
                `<th scope="col" class="py-3.5 px-4 text-sm font-normal text-gray-500">${header}</th>`
            )
            .join("")}</tr>
        </thead>
        <tbody class="bg-white"></tbody>
      </table>`
  );

  return container.find("table");
}

function populateTable(table, data, rowHtmlCallback) {
  const tbody = $("<tbody></tbody>");
  data.forEach((item) => {
    let tr = $("<tr>").html(rowHtmlCallback(item));
    tbody.append(tr);
  });

  table.find("tbody").replaceWith(tbody);
  const dataTable = table.DataTable({
    lengthMenu: [5, 10, 15, 20, 50],
    pageLength: 10, // Número de filas por página
    order: [[1, "desc"]], // Ordenar por fecha de forma descendente
    language: {
      lengthMenu: "Mostrar _MENU_ partidas por página",
      zeroRecords: "No se encontraron partidas",
      info: "Mostrando _PAGE_ de _PAGES_ páginas",
      infoEmpty: "No hay partidas disponibles",
      infoFiltered: "(filtrado de _MAX_ total partidas)",
      search: "Buscar:",
      paginate: {
        first: "Primero",
        last: "Último",
        next: "Siguiente",
        previous: "Anterior",
      },
    },
  });
  table.on("click", ".delUser", deleteUser);
  table.on("click", ".delWord", deleteWord);
  return dataTable;
}

async function listUsers() {
  removeContent();
  $(".list-users").addClass("active");
  let userTable = createTable("userTable", [
    "Nombre",
    "Correo Electrónico",
    "Puntuación",
    "Acciones",
  ]);

  await fetch("../Models/getUsers.php")
    .then((response) => response.json())
    .then((data) =>
      populateTable(
        userTable,
        data,
        (item) =>
          `<td>${item.nombre}</td><td>${item.email}</td><td>${item.puntuacion}</td><td><button class="btn btn-danger delete delUser" value="${item.id}">Eliminar</button></td>`
      )
    )
    .catch((error) => console.error("Error al cargar los usuarios:", error));
}

async function showAddWord() {
  $("#palabra").val("");
  removeContent();
  $(".add-word").addClass("active");
  await fetch("../Models/getCategories.php")
    .then((response) => response.json())
    .then((data) => fillCategorySelect($("#categorySelect"), data));
  $("#addForm").show().addClass("col-md-8 mt-5 p-3 mb-5");
}

async function listWords() {
  removeContent();
  $(".list-words").addClass("active");
  let wordTable = createTable("wordTable", [
    "Categoria",
    "Palabras",
    "Acciones",
  ]);

  await fetch("../Models/getWords.php")
    .then((response) => response.json())
    .then((data) =>
      populateTable(
        wordTable,
        data,
        (item) =>
          `<td>${item.categoria}</td><td>${item.word}</td><td><button class="btn btn-danger delete delWord" value="${item.id}">Eliminar</button></td>`
      )
    )
    .catch((error) => console.error("Error al cargar las palabras:", error));
}

async function addWord() {
  const formData = new FormData();
  $(".alert").html("");
  formData.append("categoria", $("#categorySelect").val());
  formData.append("palabra", $("#palabra").val());
  if ($("#categorySelect").val() == "") {
    $(".alert-category")
      .html(
        '<i class="bi bi-exclamation-circle p-2"></i>Este campo es obligatorio'
      )
      .show();
    return;
  }
  if ($("#palabra").val() == "") {
    $(".alert-word")
      .html(
        '<i class="bi bi-exclamation-circle p-2"></i>Este campo es obligatorio'
      )
      .show();
    return;
  }

  await fetch("../Models/addWord.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then(showAddWord)
    .catch((error) => console.error("Error:", error));
}

async function deleteUser(event) {
  const formData = new FormData();
  formData.append("user", "user");
  formData.append("id", event.target.value);

  await fetch("../Models/delete.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then(listUsers)
    .catch((error) => console.error("Error:", error));
}

async function deleteWord(event) {
  const formData = new FormData();
  formData.append("word", "word");
  formData.append("id", event.target.value);

  await fetch("../Models/delete.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then(listWords)
    .catch((error) => console.error("Error:", error));
}

function fillCategorySelect(select, json) {
  select.empty();
  let option = $(`<option value ="">Seleccione una categoria</option>`);
  select.append(option);
  for (let i = 0; i < json.length; i++) {
    let option = $(
      `<option value ="${json[i].catId}">${json[i].categoria}</option>`
    );
    select.append(option);
  }
}
function removeContent() {
  $(".list-words").removeClass("active");
  $(".list-users").removeClass("active");
  $(".add-word").removeClass("active");
  $(".show-perfil").removeClass("active");
  $(".add-category").removeClass("active");
  $("#addForm").hide().removeClass("col-md-8 mt-5 p-3 mb-5");
  $(".user").hide();
  $("#changepass").hide();
  $("#addCategory").hide().removeClass("col-md-8 mt-5 p-3 mb-5");
  $("#userTable").empty();
  $("#wordTable").empty();
}

function showChangePass() {
  removeContent();
  $("#changepass").show();
}

function changePass() {
  const currentPassword = $("#pass").val();
  const newPassword = $("#newPass").val();
  const confirmPassword = $("#confirmpass").val();
  $("#confirmpass").removeClass("is-invalid");
  $("#pass").removeClass("is-invalid");
  $("#newPass").removeClass("is-invalid");

  $("#errorMessages").html("");

  if (currentPassword === "" || newPassword === "" || confirmPassword === "") {
    $("#confirmpass").addClass("is-invalid");
    $("#pass").addClass("is-invalid");
    $("#newPass").addClass("is-invalid");
    $("#errorMessages").html("<p>Todos los campos son obligatorios.</p>");
  } else if (newPassword !== confirmPassword) {
    $("#confirmpass").addClass("is-invalid");
    $("#errorMessages").html("<p>Las nuevas contraseñas no coinciden.</p>");
  } else {
    const formData = new FormData();
    formData.append("currentPassword", currentPassword);
    formData.append("newPassword", newPassword);
    $.ajax({
      url: "../Models/updatePass.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function (data) {
        if (data.success == false) {
          $("#pass").addClass("is-invalid");

          $("#errorMessages").html("<p>La contraseña es incorrecta</p>");
        }
        console.log(data);
      },
      error: function (error) {
        console.error("Error:", error);
      },
    });
  }
}

async function showPerfil() {
  removeContent();
  $(".show-perfil").addClass("active");
  $(".user").show();
  let matchesTable = createTable("matchesTable", [
    "Palabra",
    "Intentos",
    "Resultados",
    "Variacion de puntuacion",
  ]);

  await fetch("../Models/getProfile.php")
    .then((response) => response.json())
    .then(function (data) {
      $("#nombreUsuario").html(`Nombre: ${data[0].nombre}`);
      $("#usuarioEmail").html(`Email: ${data[0].email}`);
      $("#usuarioPuntuacion").html(`Puntuacion: ${data[0].puntuacion}`);
      $("#usuarioRol").html(
        `Rol: ${data[0].rol ? "Administrador" : "Usuario"}`
      );
      data.splice(0, 1);
      populateTable(
        matchesTable,
        data,
        (item) =>
          `<td>${item.palabra}</td><td>${item.intentos}</td><td>${
            item.resultado == "w" ? "Victoria" : "Derrota"
          }</td><td>${item.var_puntuacion}</td>`
      );
    })

    .catch((error) => console.error("Error al cargar las palabras:", error));
}

async function showAddCategory() {
  $("#category").val("");
  removeContent();
  $("#addForm").hide().removeClass("col-md-8 mt-5 p-3 mb-5");
  $(".add-category").addClass("active");
  $("#showCategory").addClass("dummy-class").removeClass("dummy-class");
  $("#addCategory").show().addClass("col-md-7 mt-5 p-3 mb-5");
  await fetch("../Models/getCategories.php")
    .then((response) => response.json())
    .then((data) => fillCategorySelect($("#showCategory"), data))
    .catch((error) => console.log(error));
}

function addCategory() {
  const formData = new FormData();
  $(".alert").html("");

  formData.append("categoria", $("#category").val());

  if ($("#category").val() == "") {
    $("#category").addClass("is-invalid");
    $(".alert-word")
      .html(
        '<i class="bi bi-exclamation-circle p-2"></i>Este campo es obligatorio'
      )
      .show();
    return;
  }

  fetch("../Models/addCategory.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then(showAddCategory)
    .catch((error) => console.error("Error:", error));
}
