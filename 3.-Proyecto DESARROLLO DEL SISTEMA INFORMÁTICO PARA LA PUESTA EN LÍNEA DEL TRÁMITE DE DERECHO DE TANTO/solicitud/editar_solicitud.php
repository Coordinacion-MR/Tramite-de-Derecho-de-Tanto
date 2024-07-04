<?php
require_once('../database/database.php');

function editar($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $link = "../vistas/Usuario.php";
        if ($_FILES["archivo"]["size"] == 0) {
            header("Location: $link");
            exit();
        }

        // Primero se crea el folio
        $numfolio = $_POST["folio"];

        $sql = "UPDATE solicitudes 
                SET fecha = NOW(), 
                    doc_federal = '', 
                    doc_estatal = '', 
                    doc_municipal = '',
                    fecha_reporte = '0',
                    rev_federal = '0',
                    rev_estatal = '0',
                    rev_municipal = '0',
                    estatus = '0'
                WHERE folio = $numfolio";

        if ($conn->query($sql) === TRUE) {
            // Si el folio se crea correctamente, se procede a adjuntar el archivo
            $selectdoc = "formato"; // Este valor se puede cambiar según la lógica de tu aplicación
            $archivoTemporal = $_FILES["archivo"]["tmp_name"];
            $contenidoArchivo = file_get_contents($archivoTemporal);

            $sql_update = "UPDATE solicitudes SET $selectdoc = ? WHERE folio = ?";
            $stmt_update = $conn->prepare($sql_update);

            if ($stmt_update) {
                $stmt_update->bind_param("si", $contenidoArchivo, $numfolio);
                if ($stmt_update->execute()) {
                    echo "Folio creado y archivo adjuntado exitosamente.";
                } else {
                    echo "Error al adjuntar el archivo al folio: " . $stmt_update->error;
                }
                $stmt_update->close();
            } else {
                echo "Error en la preparación de la consulta: " . $conn->error;
            }

            // Eliminar la fila de la tabla alertas donde el folio coincida con $numfolio
            $sql_delete = "DELETE FROM alertas WHERE folio = ?";
            $stmt_delete = $conn->prepare($sql_delete);

            if ($stmt_delete) {
                $stmt_delete->bind_param("i", $numfolio);
                if ($stmt_delete->execute()) {
                    echo "Fila eliminada exitosamente de la tabla alertas.";
                } else {
                    echo "Error al eliminar la fila de la tabla alertas: " . $stmt_delete->error;
                }
                $stmt_delete->close();
            } else {
                echo "Error en la preparación de la consulta de eliminación: " . $conn->error;
            }

            header("Location: $link"); // Redirige a la página de inicio después del registro exitoso
            exit();
        } else {
            echo "Error al crear el folio: " . $conn->error;
        }

        $conn->close();
    }
}

function borrar($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $link = "../vistas/Usuario.php";
        $entidad = $_POST["user"];
        if($entidad == 5){
            $link = "../vistas/MantenimientoT.php";
        }
        // Primero se crea el folio
        $numfolio = $_POST["folio"];

        $sql = "DELETE FROM solicitudes WHERE folio = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $numfolio);
            $stmt->execute();
            
            if ($stmt->affected_rows > 0) {
                echo "La fila con el folio $numfolio ha sido eliminada.";
            } else {
                echo "No se encontró ninguna fila con el folio $numfolio.";
            }

            // Eliminar la fila de la tabla alertas donde el folio coincida con $numfolio
            $sql_delete = "DELETE FROM alertas WHERE folio = ?";
            $stmt_delete = $conn->prepare($sql_delete);

            if ($stmt_delete) {
                $stmt_delete->bind_param("i", $numfolio);
                if ($stmt_delete->execute()) {
                    echo "Fila eliminada exitosamente de la tabla alertas.";
                } else {
                    echo "Error al eliminar la fila de la tabla alertas: " . $stmt_delete->error;
                }
                $stmt_delete->close();
            } else {
                echo "Error en la preparación de la consulta de eliminación: " . $conn->error;
            }

            header("Location: $link"); // Redirige a la página de inicio después de la eliminacion exitosa
            exit();
        } else {
            echo "Error al crear el folio: " . $conn->error;
        }

        $conn->close();
    }

    function eliminar($conn) {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $link = "../vistas/Mantenimiento.php";
    
            // Primero se crea el folio
            $id = $_POST["folio"];
    
            $sql = "DELETE FROM usuarios WHERE ID = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $id);
                $stmt->execute();
                
                if ($stmt->affected_rows > 0) {
                    echo "El usuario con id:  $id ha sido eliminada.";
                } else {
                    echo "No se encontró ninguna fila con el folio $id.";
                }

                $sql = "DELETE FROM solicitudes WHERE ID_usuario = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $id);
                $stmt->execute();
                
                if ($stmt->affected_rows > 0) {
                    echo "El usuario con id:  $id ha sido eliminada.";
                } else {
                    echo "No se encontró ninguna fila con el folio $id.";
                }
                // Eliminar la fila de la tabla alertas donde el folio coincida con $numfolio
                $sql_delete = "DELETE FROM alertas WHERE username = ?";
                $stmt_delete = $conn->prepare($sql_delete);

                if ($stmt_delete) {
                    $stmt_delete->bind_param("i", $id);
                    if ($stmt_delete->execute()) {
                        echo "Fila eliminada exitosamente de la tabla alertas.";
                    } else {
                        echo "Error al eliminar la fila de la tabla alertas: " . $stmt_delete->error;
                    }
                    $stmt_delete->close();
                } else {
                    echo "Error en la preparación de la consulta de eliminación: " . $conn->error;
                }

                header("Location: $link"); // Redirige a la página de inicio después de la eliminacion exitosa
                exit();
            } 
            $conn->close();
        }

// Llamar a la función correspondiente basada en el valor del campo 'action'
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    if ($action == 'editar') {
        editar($conn);
    } elseif ($action == 'borrar') {
        borrar($conn);
    } 
    else if ($action == 'eliminar'){
        eliminar($conn);
    }
    else {
        echo "Acción no válida.";
    }
}
?>

