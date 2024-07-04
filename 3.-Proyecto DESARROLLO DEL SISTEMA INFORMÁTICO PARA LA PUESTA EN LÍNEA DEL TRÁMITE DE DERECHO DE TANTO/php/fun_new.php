<?php
session_start();
require_once('../database/database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["popup_user"];
    $usermail = $_POST["popup_email"];
    $password_actual = $_POST["password_actual"];
    $nueva_password = $_POST["new_password"];
    $confirmar_password = $_POST["same_password"];
    echo $username;
    echo $usermail;
    
    // Obtener la contraseña actual del usuario
    $sql = "SELECT * FROM usuarios WHERE username = '$username'";
    $email = "SELECT * FROM usuarios WHERE correo ='$usermail'";
    if($username != ""){
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
                if ($nueva_password == $confirmar_password) {
                    // Encriptar la nueva contraseña
                    $hashed_nueva_password = password_hash($nueva_password, PASSWORD_DEFAULT);
    
                    // Actualizar la contraseña en la base de datos
                    $sql_update = "UPDATE usuarios SET password = '$hashed_nueva_password' WHERE username = '$username'";
                    if ($conn->query($sql_update) === TRUE) {
                        echo "Contraseña cambiada correctamente.";
                        $Log="Exito";
                        header("Location: ../index.php?Log=" . urlencode($Log) . "&from=login");
                        exit(); 
                    } else {
                        echo "Error al cambiar la contraseña: " . $conn->error;
                    }
        $conn->close();
            }
            else{$Log="ErrorC";
                header("Location: recover_word.php?Log=" . urlencode($Log) . "&from=recover");
                exit();
            }
        }
    }

    else if ($usermail !=""){
        $result = $conn->query($email);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
                if ($nueva_password == $confirmar_password) {
                    // Encriptar la nueva contraseña
                    $hashed_nueva_password = password_hash($nueva_password, PASSWORD_DEFAULT);
    
                    // Actualizar la contraseña en la base de datos
                    $sql_update = "UPDATE usuarios SET password = '$hashed_nueva_password' WHERE correo = '$usermail'";
                    if ($conn->query($sql_update) === TRUE) {
                        echo "Contraseña cambiada correctamente.";
                        $Log="Exito";
                        header("Location: ../index.php?Log=" . urlencode($Log) . "&from=login");
                        exit(); 
                    } else {
                        echo "Error al cambiar la contraseña: " . $conn->error;
                    }
        $conn->close();
            }
            else{
                $Log="ErrorC";
                header("Location: recover_word.php?Log=" . urlencode($Log) . "&from=recover");
                exit();
            }
        }
    }

    
}
?>
