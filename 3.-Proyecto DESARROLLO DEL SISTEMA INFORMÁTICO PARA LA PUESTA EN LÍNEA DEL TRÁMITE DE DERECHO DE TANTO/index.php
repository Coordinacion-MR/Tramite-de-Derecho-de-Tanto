<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.11.1/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/menu.css">  

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.11.1/sweetalert2.all.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/jquery.dataTables.min.js"></script>
    <script src="js/fun_visuales.js"></script>
    <script src="js/fun_inputs.js"></script>
    <script src="js/fun_errores.js"></script>
    
    <?php
        require_once('php/fun_tables.php'); //extrae funciones generales del archivo fun_tables que lo utilizaremos para mandar la informacion de cada celda de la tabla a ventanas emergentes o a guardar en la base de datos
        $pagina_destino = obtenerPaginaDestino();
        session_start();   
     
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            LoginAlert();//aqui cargamos las  alertas que apareceran al trata de iniciar secion y se cometan errores como contrasenas incorrectas, etc.
        });
    </script>

</head>
<body>
    <div class="sidebar">
    <br>
        <h2 class="title">Sistema de Trámites</h2>
        <br>
        <div class="button-container"><!-- estos botones lo que hacen es trabajar con la funcion obtenerPaginaDestino que lo que hace es verificar el inicio de seccion para evitar errores-->
        <button onclick="window.location.href = '<?php echo $pagina_destino; ?>'" class="button white-button round-button" title="Inicio">
            <i class="bi bi-house"></i> 
        </button>
            <button onclick="window.location.href = '<?php echo $pagina_destino; ?>'" class="button white-button round-button" title="Notificaciones">
                <i class="bi bi-envelope"></i> 
            </button>
            <div class="dropdown emergente">
                <button class="button window-button dropdown-toggle" title="Cuenta" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-person"></i> 
                </button>

                <div class="dropdown-menu additional-buttons-container " aria-labelledby="dropdownMenuButton">
                    <button class="dropdown-item btn-blue-hover" onclick="window.location.href = '<?php echo $pagina_destino; ?>'">Mi informacion</button>
                    <div class="dropdown-divider"></div>
                    <button class="dropdown-item btn-red-hover" onclick="window.location.href = '<?php echo $pagina_destino; ?>'">Cerrar Sesion</button>
                </div>
                
            </div>
            
    </div>
    </div>
        <div class="container">
        <h2 style="text-align: center;">Iniciar sesión</h2>
        <div class="logo" style="text-align: center;">
        <br>
        <br>
        <br>
        </div> <!-- aqui tenemos un pequeno formulario que nos enviara la informacion que le ingresemos a nuestra funcion de login que verificara que exista una cuneta con el usuario que se ingreso y que coincida con la contrasena-->
        <form id="loginForm" action="database/login.php" method="POST">
            <div class="form-group" style="text-align: center; margin-right: 20px;">
                <label for="UsuarioIng">Nombre de usuario:</label>
                <input type="text" id="UsuarioIng" name="UsuarioIng" required onkeydown="return letrasynumeros(event);" maxlength="80">
            </div>
            <div class="password-container" style="text-align: center; margin-right: 20px;">
                <label for="password">Contraseña:</label> <!-- tambien se puede notar como los inputs son forzosamente necesarios de llenar con un maximo de 80 caracteres ademas de que se trabaja con la funcion letrasynuemreos que lo que hace es solo permitir caractreres normales letras y numeros-->
                <input class="contraseña"  type="password" id="password" name="password" required onkeydown="return letrasynumeros(event);" maxlength="80">
                <i class="bi bi-eye-slash toggle-password" onclick="togglePassword()"></i>
            </div>
            <br>
            <button id="IniciaSesion" type="submit" class="btn center_button btn-outline-primary btn-lg btn-block">Iniciar sesión</button>
            <br>
            <br><!-- tambien se tiene otros href que lo que haran sera redirigirnos ya sea a tratar de recuperar la contrasena o a registrarnos-->
            <p style="display: inline-block;">¿Olvidaste tu contraseña?</p>
            <a class="btn btn-link rounded-pill px-3" href="database/recover_word.php" style="display: inline-block;">Recuperar contraseña</a>
            <br> 
            <br>    
            <div style="text-align: center;">
                <p style="display: inline-block;">¿No tienes una cuenta?</p>
                <br>
                <a class="btn btn-link rounded-pill px-3" href="database/registro.php" style="display: inline-block;">Regístrate desde aquí</a>
            </div>        
        </form>
    </div>
</body>