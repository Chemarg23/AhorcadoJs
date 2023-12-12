const container = document.querySelector("#button-container");
const palabraOcultaElement = document.querySelector("#palabraOculta");
const intentosRestantesElement = document.querySelector("#intentosRestantes");
const imgElement = document.querySelector("img");
const puntuacionDiv = document.querySelector(".puntuacion");
const rondasDiv = document.querySelector(".rondas");
const fallosDiv = document.querySelector(".fallos");
const aciertosDiv = document.querySelector(".aciertos");
const category = document.querySelector(".categoria");
document.querySelector("#finish").addEventListener("click",finish)

let puntuacion;
let iniPuntuation;
let rondas = 1;
let fallos = 0;
let aciertos = 0;
let intentos = 6;
let palabraOculta = [];
let palabra = "";

fetch("../Models/getUsers.php?val=1")
  .then((response) => response.json())
  .then((data) => {
    puntuacion = data[0].puntuacion;
  });

// Obtener categorías mediante fetch
fetch("../Models/getCategories.php?get=2")
  .then((response) => response.json())
  .then((categories) => {
    console.log(categories);
    const selectElement = document.getElementById("categories");

    categories.forEach((category) => {
      const option = document.createElement("option");
      option.value = category.catId;
      option.textContent = category.categoria;
      selectElement.appendChild(option);
    });
  })
  .catch((error) => console.error("Error fetching categories:", error));

function startGame() {
  iniPuntuation = puntuacion;
  aciertos = 0
  fallos = 0
  const selectElement = document.getElementById("categories");
  const categoryId = selectElement.options[selectElement.selectedIndex].value;
  category.innerHTML =
    "Categoria: " + selectElement.options[selectElement.selectedIndex].text;
  fetch(`../Models/getWordsByCat.php?categoria=${categoryId}`)
    .then((response) => response.json())
    .then((words) => {
      palabra =
        words[Math.floor(Math.random() * words.length)].word.toUpperCase();
      palabraOculta = Array(palabra.length).fill("_");
      intentos = 6;

      container.innerHTML = "";
      rondasDiv.innerHTML = `Rondas: ${rondas}`;
      fallosDiv.innerHTML = `Fallos: ${fallos}`;
      aciertosDiv.innerHTML = `Aciertos: ${aciertos}`;
      puntuacionDiv.innerHTML = `Puntuación: ${puntuacion}`;
      for (let letra = 65; letra <= 90; letra++) {
        if (letra == 75 || letra == 85) {
          const p = document.createElement("p");
          container.appendChild(p);
        }
        let boton = document.createElement("button");
        boton.textContent = String.fromCharCode(letra);
        boton.className = "letraBoton";
        boton.addEventListener("click", function () {
          checkLetter(this);
          this.disabled = true;
        });
        container.appendChild(boton);
      }
      let boton = document.createElement("button");
      boton.textContent = String.fromCharCode(209);
      boton.className = "letraBoton";
      boton.addEventListener("click", function () {
        checkLetter(this);
        this.disabled = true;
      });
      container.appendChild(boton);
      updateInterface();
      document.querySelector("#game").style.display = "block";
      document.querySelector(".select").style.display = "none";
    })
    .catch((error) => console.error("Error fetching words:", error));
}

function checkLetter(letra) {
  if (palabra.includes(letra.textContent)) {
    for (let i = 0; i < palabra.length; i++) {
      if (palabra[i] === letra.textContent) {
        palabraOculta[i] = letra.textContent;
        letra.style.backgroundColor = "green";
        puntuacion += 2;
        aciertosDiv.innerHTML = `Aciertos: ${++aciertos}`;
        puntuacionDiv.innerHTML = `Puntuación: ${++puntuacion}`;
      }
    }
  } else {
    puntuacion -= 1;
    intentos--;
    letra.style.backgroundColor = "red";
    fallosDiv.innerHTML = `Fallos: ${++fallos}`;
    puntuacionDiv.innerHTML = `Puntuación: ${puntuacion}`;
  }
  console.log(puntuacion);
  updateInterface();

  if (intentos == 0) {
    gameOver();
  } else if (!palabraOculta.includes("_")) {
    win();
  }
}

function updateInterface() {
  palabraOcultaElement.textContent = palabraOculta.join(" ");
  intentosRestantesElement.textContent = `Intentos restantes: ${intentos}`;
  imgElement.src = `img/${intentos}.jpg`;
}

function win() {
  document.querySelector("#mensajeResultado").textContent =
    "¡Ganaste! La palabra era '" + palabra + "'.";
  disableButton('w');
  puntuacion += 10;
  addMatch('w')
  puntuacionDiv.innerHTML = `Puntuación: ${++puntuacion}`;
  updatePuntuation(puntuacion);
  replay();
}

function gameOver() {
  document.querySelector("#mensajeResultado").textContent =
    "¡Perdiste! La palabra era '" + palabra + "'.";
  disableButton();
  puntuacion -= 5;
  addMatch('l')
  puntuacionDiv.innerHTML = `Puntuación: ${++puntuacion}`;
  updatePuntuation(puntuacion);
  replay();
}

function replay() {
  const replayButton = document.createElement("button");
  const replayDiv = document.querySelector("#replay");
  replayButton.innerText = "Otra partida";
  replayButton.id = "replaybutton";
  replayButton.addEventListener("click", () => restartGame());
  replayDiv.appendChild(replayButton);
  rondas++;
}

function disableButton() {
  const botones = document.querySelectorAll(".letraBoton");

  for (let i = 0; i < botones.length; i++) {
    botones[i].disabled = true;
  }
}

function updatePuntuation(value) {
  fetch(`../Models/updatePuntuation.php?valor=${value}`)
    .then((response) => response.json())
    .then();
}

function restartGame() {
  clearWordContainer();
  clearButtons();
  startGame(); // Iniciar el juego nuevamente con la misma categoría
}

// Función para limpiar el contenedor de palabras
function clearWordContainer() {
  document.querySelector("#mensajeResultado").textContent = "";
  palabraOcultaElement.textContent = "";
  intentosRestantesElement.textContent = "";
  imgElement.src = "img/6.jpg";
}

function clearButtons() {
  const botones = document.querySelectorAll(".letraBoton");
  document.querySelector("#replaybutton").remove();
  for (let i = 0; i < botones.length; i++) {
    botones[i].disabled = false;
    botones[i].style.backgroundColor = "";
  }

  container.innerHTML = "";
}

function addMatch(result) {
  console.log(puntuacion +" "+ iniPuntuation)
  const intentos = fallos + aciertos;
  const variacion = puntuacion - iniPuntuation;
  fetch(
    `../Models/addMatch.php?palabra=${palabra}&intentos=${intentos}&variacion=${variacion}&result=${result}`
  )
    .then((response) => response.json())
    .then(data => console.log(data));
}

function finish() {
  palabraOcultaElement.textContent = palabra;

  document.querySelector("#mensajeResultado").textContent =
    " La palabra era '" + palabra + "'.";

  disableButton();

  puntuacion -= 5;
  updatePuntuation(puntuacion)
  addMatch('l')
  puntuacionDiv.innerHTML = `Puntuación: ${++puntuacion}`;

  replay();
}
