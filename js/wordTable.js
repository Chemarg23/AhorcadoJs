$(document).ready(() => {
    function listWords(){
    const tbody = $("tbody");
    $.ajax({
      url: "../Models/getWords.php",
      method: "GET",
      dataType: "json",
      success: function (data) {
        $.each(data, function (indice, item) {
          let tr = $("<tr>");
          tr.html(
            `<td>${item.category}</td><td>${item.word}</td><td><button class="btn btn-danger delete">Eliminar</button></td>`
          );
          tbody.append(tr);
        });
        let table = new DataTable("#userTable");
      },
      error: function (error) {
        console.error("Error al cargar los usuarios:", error);
      },
    })};
  });
  