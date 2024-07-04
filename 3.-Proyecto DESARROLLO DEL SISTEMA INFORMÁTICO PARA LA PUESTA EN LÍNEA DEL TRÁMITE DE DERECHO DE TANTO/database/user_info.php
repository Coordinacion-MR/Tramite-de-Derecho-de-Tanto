<?php
session_start();
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["username"])) {
    header("Location: ../index.php");
    exit();
}
require_once('database.php');

// Obtener el nombre de usuario de la sesión
$username = $_SESSION["username"];

$sql = "SELECT * FROM usuarios WHERE username ='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombre = $row["nombre"];
    $apellidoP = $row["apellido_P"];
    $apellidoM = $row["apellido_M"];
    $curp = $row["curp"];
    $correo = $row["correo"];
} else {
    echo "No se encontraron datos para el usuario $username";
    exit(); // Salir del script si no se encuentran datos
}
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
        //Se inclue una funcion para mostrar alertas de error sobre todo cuando hay errores en el ingreso de ciertos datos en los formularios.
        document.addEventListener("DOMContentLoaded", function() {
            ChangeAlert(); 
        });
    </script>

</head>
<body>
    <div class="sidebar">
        <h2 class="title">Sistema de Trámites</h2>
        <br><br><br>
        <div class="button-container">
        <button onclick="window.location.href = '<?php echo $pagina_destino; ?>'" class="button white-button round-button" title="Inicio">
            <i class="bi bi-house"></i> 
        </button>
            <div class="dropdown emergente">
                <button class="button window-button dropdown-toggle" title="Cuenta" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-person"></i> 
                </button>

                <div class="dropdown-menu additional-buttons-container" aria-labelledby="dropdownMenuButton">
                <button class="dropdown-item btn-blue-hover" onclick="window.location.href = '../database/user_info.php'">Mi informacion</button>
                    <div class="dropdown-divider"></div>
                    <button class="dropdown-item btn-red-hover" onclick="window.location.href = '../database/logout.php'">Cerrar Sesion</button>
                </div>            
            </div>
        </div>
        <br>
    </div>
        
    <div class="tabla"><br>
    <h2>Tu informacion</h2><br>
            <div class="form-group">
                <label for="user" style="margin-bottom: 10px; display: inline-block; width: 150px;">Nombre de Usuario:</label>  
                <input type="text" id="user" name="user" value="<?php echo $username ?>" readonly style="margin-bottom: 10px;">
            </div>
            <div class="form-group">
                <label for="nombre" style="margin-bottom: 10px; display: inline-block; width: 150px;">Nombre:</label> 
                <input type="text" id="nombre" name="nombre" value="<?php echo $nombre ?>" readonly style="margin-bottom: 10px;">
            </div>
            <div class="form-group">
                <label for="Apellido_P" style="margin-bottom: 10px; display: inline-block; width: 150px;">Apellido Paterno:</label> 
                <input type="text" id="Apellido_P" name="Apellido_P" value="<?php echo $apellidoP ?>" readonly style="margin-bottom: 10px;">
            </div>
            <div class="form-group">
                <label for="Apellido_M" style="margin-bottom: 10px; display: inline-block; width: 150px;">Apellido Materno:</label> 
                <input type="text" id="Apellido_M" name="Apellido_M" value="<?php echo $apellidoM ?>" readonly style="margin-bottom: 10px;">
            </div>
            <div class="form-group">
                <label for="CURP" style="margin-bottom: 10px; display: inline-block; width: 150px;">CURP:</label> 
                <input type="text" id="CURP" name="CURP" value="<?php echo $curp ?>" readonly style="margin-bottom: 10px;">
            </div>
            <div class="form-group">
                <label for="Correo" style="margin-bottom: 10px; display: inline-block; width: 150px;">Correo Electronico:</label> 
                <input type="text" id="Correo" name="Correo" value="<?php echo $correo ?>" readonly style="margin-bottom: 10px;">
        </div>
        <button class="button ewindow-button square-button" title="Crear Solicitud" type="button">Cambiar contraseña</button>
    </div>
    <div id="popup" class="popup">
    <div class="card-body">
                        <form action="../php/fun_info.php" method="POST">
                            <div class="form-group">
                                <label for="password_actual">Contraseña Actual</label>
                                <input type="password" class="form-control" id="password_actual" name="password_actual" required onkeydown="return letrasynumeros(event);" minlength="8" maxlength="80"
                                 oninvalid="this.setCustomValidity('La contraseña debe tener al menos 8 caracteres.')" oninput="setCustomValidity('')">
                            </div>
                            <div class="form-group">
                                <label fodr="nueva_password">Nueva Contraseña</label>
                                <input type="password" class="form-control" id="nueva_password" name="nueva_password" required onkeydown="return letrasynumeros(event);" minlength="8" maxlength="80"oninvalid="this.setCustomValidity('La contraseña debe tener al menos 8 caracteres.')"
                                 oninput="setCustomValidity('')">
                            </div>
                            <div class="form-group">
                                <label for="confirmar_password">Confirmar Nueva Contraseña</label>
                                <input type="password" class="form-control" id="confirmar_password" name="confirmar_password" required onkeydown="return letrasynumeros(event);" minlength="8" maxlength="80"oninvalid="this.setCustomValidity('La contraseña debe tener al menos 8 caracteres.')"
                                 oninput="setCustomValidity('')">
                            </div>
                            <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
                        </form>
                    </div>
    </div>
</body>
