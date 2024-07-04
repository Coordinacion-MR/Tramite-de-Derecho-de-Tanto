<?php

require_once('database.php');

// Obtener el nombre de usuario de la sesión
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.11.1/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/menu.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.11.1/sweetalert2.all.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
    <script src="../js/fun_visuales.js"></script>
    <script src="../js/fun_inputs.js"></script>
    <script src="../js/fun_errores.js"></script>
    
    
   <!-- Inclusión de archivo PHP para funciones de tablas -->
   <?php
        require_once('../php/fun_tables.php');
        $pagina_destino = obtenerPaginaDestino();  
    ?>

    <script>
        // Eventos a ejecutar cuando el contenido del DOM haya sido cargado, estas son funciones para las ventanas emergentes y de alertas personalizadas
        document.addEventListener("DOMContentLoaded", function() {
            ChangeAlert();
            Recover(); 
            openPopup();
        });
    </script>


</head>
<body>
    <div class="sidebar">
        <br>
        <h2 class="title">Sistema de Trámites</h2>
        <br>
        <div class="button-container">
        <button onclick="window.location.href = '../index.php'" class="button white-button round-button" title="Inicio">
            <i class="bi bi-house"></i> 
        </button>
            <button href="#" onclick="alert('Haz hecho clic en el segundo botón')" class="button white-button round-button" title="Notificaciones">
                <i class="bi bi-envelope"></i> 
            </button>
            <div class="dropdown emergente">
                <button class="button window-button dropdown-toggle" title="Cuenta" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-person"></i> 
                </button>
                <div class="dropdown-menu additional-buttons-container " aria-labelledby="dropdownMenuButton">
                    <button class="dropdown-item btn-blue-hover" onclick="window.location.href = '../index.php'">Mi informacion</button>
                    <div class="dropdown-divider"></div>
                    <button class="dropdown-item btn-red-hover" onclick="window.location.href = '../index.php'">Cerrar Sesion</button>
                </div>        
            </div>
        </div>
    </div>
        
    <div class="container"><br>
    <h2>Recupera tu contraseña</h2><br>
        <form id="mainForm" action="../php/fun_recover.php" method="POST">
            <div class="form-group row">
                <label for="user_email" style="margin-bottom: 10px; display: inline-block; width: 150px;">Usuario o Email:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="user_email" name="user_email" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="recover_word" class="col-sm-4 col-form-label">Palabra de Recuperación:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="recover_word" name="recover_word" required>
                </div>
            </div>
            <button class="btn btn-primary center_button" type="submit" title="Crear Solicitud">Enviar Solicitud</button>
        </form>
    </div>
    <div id="popup" class="popup">
        <div class="card-body">
            <form action="../php/fun_new.php" method="POST">
                    <div class="form-group">
                        <label for="nueva_password">Nueva Contraseña</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required onkeydown="return letrasynumeros(event);" minlength="8" maxlength="80"oninvalid="this.setCustomValidity('La contraseña debe tener al menos 8 caracteres.')"
                                 oninput="setCustomValidity('')">
                    </div>
                    <div class="form-group">
                        <label for="confirmar_password">Confirmar Nueva Contraseña</label>
                        <input type="password" class="form-control" id="same_password" name="same_password" required onkeydown="return letrasynumeros(event);" minlength="8" maxlength="80"oninvalid="this.setCustomValidity('La contraseña debe tener al menos 8 caracteres.')"
                                 oninput="setCustomValidity('')">
                    </div>
                        <input type="hidden" id="popup_user" name="popup_user"> 
                        <input type="hidden" id="popup_email" name="popup_email">
                        <button type="submit" class="btn btn-primary center_button">Cambiar Contraseña</button>              
            </form>
        </div>
    </div>
</body>
