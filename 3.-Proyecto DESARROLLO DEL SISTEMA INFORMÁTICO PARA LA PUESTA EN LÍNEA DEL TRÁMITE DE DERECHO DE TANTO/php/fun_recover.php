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
    $User_mail = $_POST["user_email"];
    $Recover_word = $_POST["recover_word"];

    // Consulta para verificar el username en la tabla usuarios
    $sql = "SELECT * FROM usuarios WHERE username='$User_mail'";
    // Consulta para verificar el correo en la tabla usuarios
    $email = "SELECT * FROM usuarios WHERE correo ='$User_mail'";
    // Ejecuta la consulta del username
    $result = $conn->query($sql);

    // Si se encuentra un registro con el username proporcionado
    if ($result->num_rows > 0) {
        // Obtiene la fila de resultados
        $row = $result->fetch_assoc();
        // Verifica la palabra de recuperación utilizando password_verify
        if (password_verify($Recover_word, $row['recover_word'])) {
            // Si la verificación es correcta, genera un Log y redirige
            $Log = "u1";
            $Log .= $User_mail;
            header("Location: ../database/recover_word.php?Log=" . urlencode($Log) . "&from=recover");
            exit();
        } else {
            // Si la verificación falla, redirige con un Log de error
            $Log = "Error";
            header("Location: ../database/recover_word.php?Log=" . urlencode($Log) . "&from=recover");
            exit();
        }
    }  
    // Ejecuta la consulta del correo
    $result = $conn->query($email);

    // Si se encuentra un registro con el correo proporcionado
    if ($result->num_rows > 0) {
        // Obtiene la fila de resultados
        $row = $result->fetch_assoc();
        // Verifica la palabra de recuperación utilizando password_verify
        if (password_verify($Recover_word, $row['recover_word'])) {
            // Si la verificación es correcta, genera un Log y redirige
            $Log = "e2";
            $Log .= $User_mail;
            header("Location: ../database/recover_word.php?Log=" . urlencode($Log) . "&from=recover");
            exit();
        } else {
            // Si la verificación falla, redirige con un Log de error
            $Log = "Error";
            header("Location: ../database/recover_word.php?Log=" . urlencode($Log) . "&from=recover");
            exit();
        }
    } else {
        // Si no se encuentra ningún registro para el correo proporcionado, redirige con un Log de error
        $Log = "Errorue";
        header("Location: ../database/recover_word.php?Log=" . urlencode($Log) . "&from=recover");
        exit();
    } 
}
?>