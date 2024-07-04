$(document).ready(function() {
    $("#IniciaSesion").click(function(event) {
        // Obtener los valores de los campos de usuario y contraseña
        var usuario = $("#UsuarioIng").val();
        var contrasena = $("#ContrasenaIng").val();

        // Verificar si alguno de los campos está vacío
        if (usuario === "" || contrasena === "") {
            event.preventDefault(); // Evitar el envío del formulario

            // Mostrar alerta de error utilizando SweetAlert2
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Por favor completa todos los campos',
            });
        }
    });
});

function LoginAlert(){
    var params = new URLSearchParams(window.location.search);
    var fromLoginPage = params.get('from') === 'login';
    var Log = params.get('Log');
    
    // Verifica si estamos en la página de inicio de sesión y si hay un error de inicio de sesión
    if (fromLoginPage && Log) {
        if (Log === "Error") {
            Swal.fire({
                icon: 'error',
                title: 'Usuario o Contraseña Incorrecta',
            });
        }
        else if (Log === "Exito"){
            Swal.fire({
                icon: 'success',
                title: 'Se cambio correctamente la contraseña',
            });
        } 
    }
}

function RegisterAlert(){
    var params = new URLSearchParams(window.location.search);
    var fromLoginPage = params.get('from') === 'register';
    var Log = params.get('Log');
    
    // Verifica si estamos en la página de inicio de sesión y si hay un error de inicio de sesión
    if (fromLoginPage && Log) {
        if (Log === "user") {
            Swal.fire({
                icon: 'error',
                title: 'Ya existe un usuario con el mismo nombre de Usuario',
            });
        } 
        else if (Log === "email") {
            Swal.fire({
                icon: 'error',
                title: 'Ya existe un usuario con el mismo correo electronico',
            });
        } 
    }
}

function ChangeAlert(){
    var params = new URLSearchParams(window.location.search);
    var fromChangePage = params.get('from') === 'change';
    var Chg = params.get('Chg');
    
    // Verifica si estamos en la página de inicio de sesión y si hay un error de inicio de sesión
    if (fromChangePage && Chg) {
        if (Chg === "ErrorC") {
            Swal.fire({
                icon: 'error',
                title: 'Contraseña Incorrecta',
            });
        } 
        else if (Chg === "ErrorN") {
            Swal.fire({
                icon: 'error',
                title: 'Contraseñas no coinciden',
            });
        } 
        else if (Chg === "ErrorX") {
            Swal.fire({
                icon: 'error',
                title: 'Usuario no existe',
            });
        } 
    }
}

$(document).ready(function() {
    $("#CrearFolio").click(function(event) {
        // Obtener los valores de los campos de usuario y contraseña
        var numfolio = $("#numfolio").val();
        // Verificar si alguno de los campos está vacío
        if (numfolio.length < 8 ) {
            event.preventDefault(); // Evitar el envío del formulario

            // Mostrar alerta de error utilizando SweetAlert2
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El folio deben ser 8 caracteres',
            });
        }
        else if (/[@.]/.test(numfolio)){
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El folio no puede contener caracteres especiales',
            });
        }
    });
});
$(document).ready(function() {
    $("#BuscarFolio").click(function(event) {
        // Obtener los valores de los campos de usuario y contraseña
        var numfolio = $("#numfolio").val();
        // Verificar si alguno de los campos está vacío
        if (numfolio.length < 8 ) {
            event.preventDefault(); // Evitar el envío del formulario

            // Mostrar alerta de error utilizando SweetAlert2
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El folio deben ser 8 caracteres',
            });
        }
        else if (/[@.]/.test(numfolio)){
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El folio no puede contener caracteres especiales',
            });
        }
    });
});
/*function abrirFormulario() {
    Swal.fire({
        title: 'Crear nuevo folio',
        html: `
            <form id="formularioFolio" action="../solicitud/folio_creacion.php" method="POST">
                <div class="form-group">
                    <input type="hidden" id="username" name="username" value="<?php echo $username; ?>">
                    <input type="hidden" id="ID_usuario" name="ID_usuario" value="<?php echo $ID_usuario; ?>">
                    <label for="numfolio">Numero de Folio:</label>
                    <input type="text" id="numfolio" name="numfolio" required>
                </div>
            </form>
        `,
        showCancelButton: true,
        confirmButtonText: 'Crear Folio',
        cancelButtonText: 'Cancelar',
        focusConfirm: false,
        preConfirm: () => {
            // Aquí puedes añadir la lógica para enviar el formulario si es necesario
            document.getElementById('formularioFolio').submit();
        }
    });
}*/

$(document).ready(function( ) {
    $("#Registrarse").click(function(event) {
        // Obtener los valores de los campos de usuario y contraseña
        var username= $("#username").val();
        var password = $("#password").val();
        var recover_word = $("#recover_word").val();
        var Nombre = $("#Nombre").val();
        var ApellidoP = $("#ApellidoP").val();
        var ApellidoM = $("#ApellidoM").val();
        var CURP = $("#CURP").val();
        var Correo =$("#Correo").val();
        var validacion = 0;

        // Verificar si alguno de los campos está vacío
        if (username === "" || password === "" || recover_word==="" || Nombre === "" || ApellidoP === "" || ApellidoM === "" || CURP === "" || Correo === "") {
            event.preventDefault(); // Evitar el envío del formulario
            // Mostrar alerta de error utilizando SweetAlert2
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Por favor completa todos los campos',
            });
        }
        else { 
            if (username.length < 8){
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El nombre de usuario debe ser mayor a 8 caracteres',
                });
            }
            else if (/[@.]/.test(username)){
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ingresa un nombre de usaurio sin caracteres especiales',
                });
            }
            else if (password.length < 8){
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'La contraseña debe ser mayor a 8 caracteres',
                });
            }
            else if (/[@.]/.test(password)){
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ingresa una contraseña sin caracteres especiales',
                });
            }
            else if (recover_word.length < 8){
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'La palabra de recuperacion debe ser mayor a 8 caracteres',
                });
            }
            else if (Nombre.length < 3){
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El nombre debe ser mayor a 3 caracteres',
                });
            }
            else if (/[@.]/.test(Nombre)){
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ingresa un nombre valido',
                });
            }
            else if (ApellidoP.length < 3){
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El Apellido Paterno debe ser mayor a 3 caracteres',
                });
            }
            else if (/[@.]/.test(ApellidoP)){
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ingresa un Apellido Paterno valido',
                });
            }
            else if (ApellidoM.length < 3){
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El Apellido Materno debe ser mayor a 3 caracteres',
                });
            }
            else if (/[@.]/.test(ApellidoM)){
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ingresa un Apellido Materno valido',
                });
            }
            else if (CURP.length < 18){
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'La CURP debe ser de 18 caracteres',
                });
            }
            else if (/[@.]/.test(CURP)){
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ingresa una CURP valida',
                });
            }
            else if (Correo.length < 13){
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El correo debe de tener por lo menos 13 caracteres',
                });
            }
            else if (!Correo.includes('@') || !Correo.includes('.') ){
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'El correo ingresado no es valido',
                });
            }
       }
        
    });
});