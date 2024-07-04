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
$username = $_SESSION["username"];
global $admin1, $admin2, $admin3;
// Asignar variables según el tipo de entidad
if ($username == $admin3) {
    $entidad = 'doc_municipal';
    $boton = 4;
} else if ($username == $admin2) {
    $entidad = 'doc_estatal';
    $boton = 3;
} else if ($username == $admin1){
    $entidad = 'doc_federal';
    $boton = 2;
}

// Consultar folios de seguimiento con estatus diferente a '0' lo que significa que ninguna entidad lo ha reportado
$sql = "SELECT * FROM solicitudes WHERE estatus != '0'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Inclusión de archivos CSS necesarios -->
    
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
        document.addEventListener("DOMContentLoaded", function() {});

        LoginAlert();

        $(document).ready(function() {
            // Inicializar DataTable con configuración en español
            $('#table_id').DataTable({
                "language": {
                    url: '../plugins/tables_es-ES.json',
                }
            });

            // Mostrar popup al hacer clic en botón
            $(".awindow-button").click(function() {
                var folio = $(this).data("folio");
                $("#folio").val(folio);
                $("#apopup").show();
            });

            // Mostrar popup para subir archivos al hacer clic en botón
            $(".subir-button").click(function(){
                var username = $(this).data('username');
                var numfolio = $(this).data('numfolio');
                var boton = $(this).data('boton');

                $("#popup #username").val(username);
                $("#popup #numfolio").val(numfolio);
                $("#popup #boton").val(boton);
                $("#popup").show();
            });
        });

        // Función para establecer contenido de mensaje estatal
        function setMsgEstatalContent() {
            var msgEstatalContent = document.querySelector('.msg_estatal_content').innerHTML;
            document.getElementById('msg_estatal_content_input').value = msgEstatalContent;
        }
    </script>

</head>
<body>
    <div class="sidebar">
        <br><br>
        <h2 class="title">Sistema de Trámites</h2>
        <div class="button-container">
            <button onclick="window.location.href = '<?php echo $pagina_destino; ?>'" class="button white-button round-button" title="Inicio">
                <i class="bi bi-house"></i> 
            </button>
            <button onclick="window.location.href = 'entidad_reportes.php'" class="button white-button round-button" title="Reportados">
                <i class="bi bi-exclamation-triangle"></i> 
            </button>
            <button onclick="window.location.href = 'entidad_revisados.php'" class="button white-button round-button" title="Revisados">
                <i class="bi bi-calendar2-check"></i> 
            </button>
            <!-- Dropdown para opciones de cuenta -->
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
        <h2>Tabla de Trámites</h2>
        <table id="table_id" class="table">
            <thead class="table-dark">
                <tr>
                    <th>Folio</th>
                    <th>Fecha de Solicitud</th>
                    <th>ID Usuario</th>
                    <th>Estatus</th>
                    <th>Fecha de Reporte</th>
                    <th>Descargar</th>
                </tr>
            </thead>
            <tbody>
            <!-- Iterar sobre los resultados de la consulta para generar filas de la tabla -->
            <?php foreach($result as $row): ?>
                <tr>
                    <td><?php echo $row['folio'] ?>&nbsp;</td>
                    <td><?php echo $row['fecha'] ?>&nbsp;</td>
                    <td><?php echo $row['ID_usuario'] ?>&nbsp;</td>
                    <td><?php echo Estatus_entidad($row[$entidad], $row['folio']) ?>&nbsp;</td>
                    <td><?php echo $row['fecha_reporte'] ?>&nbsp;</td>
                    <td><?php echo BotonDesplegable($row['folio'], $row['formato'], $row['doc_federal'], $row['doc_estatal'], $row['doc_municipal'], $username) ?>&nbsp;</td>
                </tr>
            <?php endforeach; ?>
            </tbody>    
        </table>

        <!-- Popup para agregar respuesta -->
        <div id="popup" class="popup">
            <div class="container">
                <form action="../solicitud/doc_agregar.php" method="POST" enctype="multipart/form-data">
                    <h2>Agregar Respuesta</h2>
                    <div class="form-group" style="display: flex; flex-direction: column; align-items: center;">
                        <input type="hidden" id="username" name="username">
                        <input type="text" id="numfolio" name="numfolio" readonly>
                        <input type="hidden" id="boton" name="boton">
                        <label for="archivo" style="display: block; margin-bottom: 30px;">Selecciona un archivo PDF:</label>
                        <input type="file" id="archivo" name="archivo" accept=".pdf" style="margin-bottom: 30px;">
                        <button id="CrearFolio" type="submit" class="btn btn-outline-primary btn-lg btn-block">Subir</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Popup alternativo -->
        <div id="apopup" class="apopup">
            <div class="apopup-content">
                <form action="../php/fun_tables.php" method="post">
                    <input type="hidden" id="msg_estatal_content_input" name="msg_estatal_content">
                    <input type="text" id="folio" name="folio" readonly>
                    <label for="opcion">Opción:</label>
                    <select id="opcion" name="opcion" required>
                        <option value="opcion1">Opción 1</option>
                        <option value="opcion2">Opción 2</option>
                        <option value="opcion3">Opción 3</option>
                        <option value="opcion4">Opción 4</option>
                    </select><br><br>
                    <label for="texto">Texto:</label>
                    <textarea id="mensaje" name="mensaje" rows="4" cols="50" required></textarea><br><br>
                    <input type="hidden" name="entidad" value="1">
                    <button type="submit">Enviar</button>
                </form>
            </div>  
        </div>
    </div>
</body>
</html>