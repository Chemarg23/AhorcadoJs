function mostrarMensaje(idCampo, mensaje) {
    const campo = $(`#${idCampo}`);
    const feedback = $(`#${idCampo}Feedback`);

    campo.removeClass('is-valid is-invalid');
    feedback.text(mensaje);

    if (mensaje) {
        campo.addClass('is-invalid');
    } else {
        campo.addClass('is-valid');
    }
}

function validarYRegistrar() {
    const nombre = $('#nombre').val().trim();
    const email = $('#email').val().trim();
    const telefono = $('#telefono').val().trim();
    const password = $('#password').val().trim();

    // Realiza la validación en el frontend
    mostrarMensaje('nombre', nombre ? '' : 'Por favor, completa este campo.');
    mostrarMensaje('email', validarEmail(email) ? '' : 'Por favor, introduce un correo electrónico válido.');
    mostrarMensaje('telefono', telefono ? '' : 'Por favor, completa este campo.');
    mostrarMensaje('password', password ? '' : 'Por favor, completa este campo.');

    if (nombre && validarEmail(email) && telefono && password) {
        // Continuar con el registro
        realizarRegistro(nombre, email, telefono, password);
    }
}

function validarEmail(email) {
    
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function realizarRegistro(nombre, email, telefono, password) {
    const formData = new FormData();
    formData.append('nombre', nombre);
    formData.append('email', email);
    formData.append('telefono', telefono);
    formData.append('password', password);

    fetch('../Models/register.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
       if(data.success == true){
        window.location.href = "adminSite.php";
       }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
