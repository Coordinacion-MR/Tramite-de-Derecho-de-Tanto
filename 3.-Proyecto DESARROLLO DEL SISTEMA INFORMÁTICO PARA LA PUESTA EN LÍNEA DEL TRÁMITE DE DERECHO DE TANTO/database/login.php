<?php
include '../config.php';
global $admin1, $admin2, $admin3, $admin4;
// Iniciar la sesión
session_start();

// Incluir el archivo de conexión a la base de datos
require_once('database.php');

// Inicializar el mensaje de error de sesión
$_SESSION["error_message"] ="";

// Verificar si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el nombre de usuario y la contraseña del formulario
    $UsernameLog = $_POST["UsuarioIng"];
    $PasswordLog = $_POST["password"];
    $Log="";

    // Consulta SQL para seleccionar al usuario de la base de datos
    $sql = "SELECT * FROM usuarios WHERE username='$UsernameLog'";
    // Ejecutar la consulta
    $result = $conn->query($sql);

    // Verificar si el usuario existe
    if ($result->num_rows > 0) { 
        // Obtener los datos del usuario
        $row = $result->fetch_assoc();
        // Verificar si la contraseña ingresada coincide con la almacenada en la base de datos
        if (password_verify($PasswordLog, $row['password'])) {
            // Iniciar sesión con el nombre de usuario
            $_SESSION["username"] = $UsernameLog;
            // Verificar el usuario sea alguna de las entidades y redirigir a la página correspondiente
            if($UsernameLog == $admin1 || $UsernameLog == $admin2 || $UsernameLog == $admin3){
                $Log="Exito";
                header("Location: ../vistas/entidad_vista.php");
                exit();
            } else if ($UsernameLog == $admin4){
                $Log="Exito";
                header("Location: ../vistas/Mantenimiento.php");
                exit();
            }
            else{  
                $Log="Exito";
                header("Location: ../vistas/Usuario.php");
                exit();
            }
        } else {
            // Si la contraseña no es correcta, redirigir con un mensaje de error
            $Log="Error";
            header("Location: ../index.php?Log=" . urlencode($Log) . "&from=login");
            exit();
        }
    } else {
        // Si el usuario no existe, redirigir con un mensaje de error
        $Log="Error";
        header("Location: ../index.php?Log=" . urlencode($Log) . "&from=login");
        exit();
    }
}
?>