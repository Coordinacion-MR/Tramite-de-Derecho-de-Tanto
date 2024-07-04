<?php
// Inicia la sesión
session_start();
// Incluye el archivo de conexión a la base de datos
require_once('../database/database.php');

// Inicializa el mensaje de error en la sesión
$_SESSION["error_message"] = "";

// Verifica si el método de la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos del formulario
    $eleccion = $_POST["boton"];
    $numerofolio = $_POST["numfolio"];
    $username = $_POST["username"];
    $selectdoc = "";
    $link = "";
    $rev = "";

    // Determina el tipo de documento y la redirección según la elección
    if ($eleccion == "1") {
        $selectdoc = "formato";
        $link = "../vistas/Usuario.php";
    } elseif ($eleccion == "2") {
        $selectdoc = "doc_federal";
        $rev = "rev_federal";
        $link = "../vistas/entidad_vista.php";
    } elseif ($eleccion == "3") {
        $selectdoc = "doc_estatal";
        $rev = "rev_estatal";
        $link = "../vistas/entidad_vista.php";
    } elseif ($eleccion == "4") {
        $selectdoc = "doc_municipal";
        $rev = "rev_municipal";
        $link = "../vistas/entidad_vista.php";
    }

    // Verifica si no hubo errores al subir el archivo
    if ($_FILES["archivo"]["error"] == UPLOAD_ERR_OK) {
        // Obtiene el nombre y el contenido del archivo subido
        $nombreArchivo = basename($_FILES["archivo"]["name"]);
        $archivoTemporal = $_FILES["archivo"]["tmp_name"];
        $contenidoArchivo = file_get_contents($archivoTemporal);

        // Consulta para verificar la existencia del folio en la base de datos
        $sql = "SELECT * FROM solicitudes WHERE folio = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $numerofolio);
        $stmt->execute();
        $result = $stmt->get_result();

        // Si se encuentra el folio, actualiza el registro con el archivo subido
        if ($result->num_rows > 0) {
            $sql_update = "UPDATE solicitudes SET $selectdoc = ? WHERE folio = ?";
            $stmt_update = $conn->prepare($sql_update);
            if ($stmt_update) {
                $stmt_update->bind_param("si", $contenidoArchivo, $numerofolio);
                if ($stmt_update->execute()) {
                    echo "Archivo subido exitosamente.";

                    // Actualiza la fecha de revisión si corresponde
                    $sql_update_fecha = "UPDATE solicitudes SET $rev = NOW() WHERE folio = ?";
                    $stmt_update_fecha = $conn->prepare($sql_update_fecha);
                    if ($stmt_update_fecha) {
                        $stmt_update_fecha->bind_param("i", $numerofolio);
                        if ($stmt_update_fecha->execute()) {
                            echo "Fecha de apartado actualizada exitosamente.";
                        } else {
                            echo "Error al actualizar la fecha de apartado: " . $stmt_update_fecha->error;
                        }
                        $stmt_update_fecha->close();
                    } else {
                        echo "Error en la preparación de la consulta de fecha: " . $conn->error;
                    }
                } else {
                    echo "Error al subir el archivo: " . $stmt_update->error;
                }
                $stmt_update->close();
            } else {
                echo "Error en la preparación de la consulta: " . $conn->error;
            }
        } else {
            echo "No se encontró ningún registro para el número de folio proporcionado.";
        }
        $stmt->close();
    } else {
        echo "Error al subir el archivo: " . $_FILES["archivo"]["error"];
    }
    // Cierra la conexión a la base de datos
    $conn->close();
    // Redirige a la página correspondiente
    header("Location: $link");
}
?>