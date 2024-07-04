<?php
include '../config.php';
session_start();
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["username"])) {
    header("Location: ../index.php");
    exit();
}
require_once('../database/database.php');

// Obtener el nombre de usuario de la sesión

$sql = "SELECT * FROM usuarios WHERE username NOT IN ('$admin1', '$admin2', '$admin3', '$admin4')";
$result = $conn->query($sql);// Ejecutar la consulta y almacenar el resultado
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Incluir archivos CSS necesarios -->

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
    

    <!-- Incluir archivo PHP con funciones de tablas -->
    <?php
        require_once('../php/fun_tables.php');
        require_once('../solicitud/crear_solicitud.php');
        $pagina_destino = obtenerPaginaDestino();  // Obtener la página de destino para redireccionar
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() { });

        LoginAlert(); // Llamar a la función LoginAlert cuando el contenido del documento esté completamente cargado

        $(document).ready(function() {
            $('#table_id').DataTable({
                "language": {
                    url: '../plugins/tables_es-ES.json',
                }
            });
        });

    </script>

</head>
<body>
    <div class="sidebar">
    <br>
        <h2 class="title">Sistema de Trámites</h2>
        <br>
        <!-- Botones de navegación -->
        <div class="button-container">
            <button onclick="window.location.href = '<?php echo $pagina_destino; ?>'" class="button white-button round-button" title="Inicio">
                <i class="bi bi-house"></i> 
            </button>
             <button onclick="window.location.href = 'MantenimientoT.php'" class="button white-button round-button" title="Tabla de Solicitudes">
                <i class="bi bi-journal-text"></i> 
            </button>
            <!-- Menú desplegable de cuenta -->
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
    </div>
        
    <div class="tabla">
        <h2>Tabla de Usuarios</h2>
        <table id="table_id" class="table">
            <thead class="table-dark">
                <!-- Crea la estructura de la tabla -->
                <tr>
                    <th>ID Usuario</th>
                    <th>Username</th>
                    <th>Correo</th>
                    <th>Opciones</th>

                </tr>
         
            <tbody>
            <!-- Generar filas de la tabla iterando sobre los resultados de la consulta -->
            <?php foreach($result as $row): ?>
                <tr>
                    <td><?php echo $row['ID'] ?>&nbsp;</td>
                    <td><?php echo $row['username'] ?>&nbsp;</td>
                    <td><?php echo $row['correo'] ?>&nbsp;</td>
                    <td><?php echo BotonOptionsM($row['ID'],5)?>&nbsp;</td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
         
    
        <!-- Popup para eliminar un usuario existente -->
        <div id="cpopup" class="cpopup">
            <div class="cpopup-content">
            <form action="../solicitud/editar_solicitud.php" method="POST" enctype="multipart/form-data">
                    <h2>Estas seguro de eliminar este usuario?</h2>
                    <div class="form-group" style="display: flex; flex-direction: column; align-items: center;">
                        <input type="hidden" name="action" value="eliminar">
                        <input type="text" id="folio" name="folio">
                        <button id="BorrarFolio" type="submit" class="btn btn-lg btn-red-hover btn-block" >Eliminar</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</body>
