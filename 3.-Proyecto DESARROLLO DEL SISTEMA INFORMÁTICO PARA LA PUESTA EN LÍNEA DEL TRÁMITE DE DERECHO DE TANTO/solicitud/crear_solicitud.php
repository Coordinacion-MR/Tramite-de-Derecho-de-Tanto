<?php
// Incluye el archivo de la base de datos
require_once('../database/database.php');

// Función para generar un número aleatorio único para el folio
function generarNumeroAleatorio() {
    // Accede a la conexión global de la base de datos
    global $conn;

    // Genera números aleatorios hasta encontrar uno que no esté en uso
    do {
        $numero = mt_rand(10000000, 99999999); // Genera un número aleatorio de 8 dígitos
        $query = "SELECT * FROM solicitudes WHERE folio = '$numero'"; // Consulta para verificar si el número ya existe
        $result = $conn->query($query); // Ejecuta la consulta
    } while ($result->num_rows > 0); // Repite mientras el número ya exista en la base de datos

    // Devuelve el número único generado
    return $numero;
}

// Verifica si el método de la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define la ruta de redirección en caso de error
    $link = "../vistas/Usuario.php";

    // Verifica si no se ha subido ningún archivo
    if ($_FILES["archivo"]["size"] == 0) {
        // Redirige a la página de usuario y termina el script si no hay archivo
        header("Location: $link");
        exit();
    }
    
    // Obtiene los datos del formulario POST
    $Username = $_POST["username"];
    $numfolio = $_POST["folio"];
    $ID_usuario = $_POST["ID_usuario"];

    // Consulta para insertar un nuevo registro en la tabla solicitudes
    $sql = "INSERT INTO solicitudes (username, folio, fecha, ID_usuario) VALUES ('$Username', '$numfolio', NOW(), '$ID_usuario')";

    // Ejecuta la consulta de inserción
    if ($conn->query($sql) === TRUE) {
        // Si la inserción es exitosa, procede a adjuntar el archivo
        $selectdoc = "formato"; // Nombre del campo donde se guardará el archivo (se puede cambiar según la lógica de la aplicación)
        $archivoTemporal = $_FILES["archivo"]["tmp_name"]; // Nombre temporal del archivo subido
        $contenidoArchivo = file_get_contents($archivoTemporal); // Lee el contenido del archivo

        // Consulta para actualizar el registro con el archivo adjunto
        $sql_update = "UPDATE solicitudes SET $selectdoc = ? WHERE folio = ?";
        $stmt_update = $conn->prepare($sql_update); // Prepara la consulta

        if ($stmt_update) {
            // Vincula los parámetros y ejecuta la consulta de actualización
            $stmt_update->bind_param("si", $contenidoArchivo, $numfolio);
            if ($stmt_update->execute()) {
                echo "Folio creado y archivo adjuntado exitosamente.";
            } else {
                echo "Error al adjuntar el archivo al folio: " . $stmt_update->error;
            }
            // Cierra la declaración preparada
            $stmt_update->close();
        } else {
            echo "Error en la preparación de la consulta: " . $conn->error;
        }

        // Redirige a la página de usuario después del registro exitoso
        header("Location: $link");
        exit();
    } else {
        echo "Error al crear el folio: " . $conn->error;
    }

    // Cierra la conexión a la base de datos
    $conn->close();
}
?>