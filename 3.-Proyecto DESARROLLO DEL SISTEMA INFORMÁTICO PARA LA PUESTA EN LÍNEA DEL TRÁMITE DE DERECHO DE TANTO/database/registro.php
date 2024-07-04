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
        session_start();   
     
    ?>

    <script>
        // Se carga las funciones para las alertas referentes al registro sobre todo en caso de errores.
        document.addEventListener("DOMContentLoaded", function() {
            RegisterAlert();
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
            <button onclick="window.location.href = '../index.php'" class="button white-button round-button" title="Notificaciones">
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
        <div class="container">
        <h2>Registro</h2> 
        <br>
        <form action="../php/fun_register.php" method="POST">
            <div class="form-group">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" required onkeydown="return letrasynumeros(event);" minlength="8" maxlength="80">
            </div>
            <div class="password-container">
                <label for="password">Contraseña:</label>
                <input class="contraseña" type="password" id="password" name="password"  required onkeydown="return letrasynumeros(event);" minlength="8" maxlength="80">
                <i class="bi bi-eye-slash toggle-password" onclick="togglePassword()"></i>
            </div>
            <div class="form-group">
                <label for="recover_word">Palabra de recuperación:</label>
                <input type="text" id="recover_word" name="recover_word"  required onkeydown="return letras(event);" minlength="8" maxlength="80">
            </div>
            <div class="form-group">
                <label for="Nombre">Nombre:</label>
                <input type="text" id="Nombre" name="Nombre" required onkeydown="return letras(event);" maxlength="80">
            </div>
            <div class="form-group">
                <label for="ApellidoP">Apellido Paterno:</label>
                <input type="text" id="ApellidoP" name="ApellidoP" required onkeydown="return letras(event);" maxlength="80"> 
            </div>
            <div class="form-group">
                <label for="ApellidoM">Apellido Materno:</label>
                <input type="text" id="ApellidoM" name="ApellidoM" required onkeydown="return letras(event);" maxlength="80">
            </div>
            <div class="form-group">
                <label for="CURP">CURP:</label>
                <input type="text" id="CURP" name="CURP" required 
                oninput="this.setCustomValidity('')" minlength="18" maxlength="18">
            </div>
            <div class="form-group">
                <label for="Correo">Correo Institucional:</label>
                <input type="text" id="Correo" name="Correo" required 
                    oninput="this.setCustomValidity('')" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" minlength="11" maxlength="80">
            </div>
            <br>
            <button id="Registrarse" type="submit" class="btn center_button btn-outline-primary btn-lg btn-block">Registrarse</button>
        </form>
        <br>
        <p style="margin-top: 20px;">¿Ya tienes una cuenta?</p>     
        <a class="btn btn-link rounded-pill px-3" style="display: inline-block"  href="../index.php">Iniciar Sesion</a>
    </div>
</body>