function cierre_inesperado() {
    $(document).ready(function(){
        // Detectar cuando el usuario está cerrando la ventana del navegador
        $(window).on('beforeunload', function(){
            // Realizar una solicitud AJAX para cerrar la sesión
            $.ajax({
                url: 'cerrar_sesion.php', // Ruta al script PHP que cierra la sesión
                type: 'POST',
                async: false, // Hacer la solicitud de forma sincrónica
                success: function(response){
                    // La sesión se cerró correctamente
                    console.log('La sesión se cerró automáticamente.');
                },
                error: function(){
                    // Ocurrió un error al cerrar la sesión
                    console.error('Error al cerrar la sesión automáticamente.');
                }
            });
        });
    });
}
function Recover() {
    var params = new URLSearchParams(window.location.search);
    var fromLoginPage = params.get('from') === 'recover';
    var Log = params.get('Log');
    var user = "";
    var email = "";

    // Verifica si estamos en la página de inicio de sesión y si hay un error de inicio de sesión
    if (fromLoginPage && Log) {
        if (Log != "") {
            if (Log.startsWith("u1")) {
                let user = Log.substring(2);
                openPopup(user, email);
            } 
            else if (Log.startsWith("e2")) {
                let email = Log.substring(2);
                openPopup(user, email);
            } 
            else if (Log === "Error") {
                Swal.fire({
                    icon: 'error',
                    title: 'Palabra de Recuperacion Incorrecta',
                });
            } 
            else if(Log ==="ErrorC"){
                Swal.fire({
                    icon: 'error',
                    title: 'Contraseñas no coinciden',
                });
            }
            else{
                Swal.fire({
                    icon: 'error',
                    title: 'Usuario o Email incorrectos',
                });
            }
        }
    }

    // Llamar a la función para abrir la ventana emergente automáticamente
    function openPopup(user, email) {
        // Aquí debes escribir el código para abrir la ventana emergente,
        // ya sea mediante una clase específica o mediante manipulación del DOM
        // Por ejemplo:
        var popup = $("#popup");
        popup.addClass("show");
        // También puedes llenar los campos del popup con los valores de usuario y correo si es necesario
        $("#popup_user").val(user);
        $("#popup_email").val(email);
    }
}