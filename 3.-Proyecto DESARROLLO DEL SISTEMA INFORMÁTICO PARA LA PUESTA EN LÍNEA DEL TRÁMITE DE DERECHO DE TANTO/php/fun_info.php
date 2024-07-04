<?php
session_start();
require_once('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION["username"];
    $password_actual = $_POST["password_actual"];
    $nueva_password = $_POST["nueva_password"];
    $confirmar_password = $_POST["confirmar_password"];

    // Obtener la contraseña actual del usuario
    $sql = "SELECT password FROM usuarios WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row["password"];

        // Verificar si la contraseña actual coincide
        if (password_verify($password_actual, $hashed_password)) {
            // Verificar si la nueva contraseña y la confirmación coinciden
            if ($nueva_password == $confirmar_password) {
                // Encriptar la nueva contraseña
                $hashed_nueva_password = password_hash($nueva_password, PASSWORD_DEFAULT);

                // Actualizar la contraseña en la base de datos
                $sql_update = "UPDATE usuarios SET password = '$hashed_nueva_password' WHERE username = '$username'";
                if ($conn->query($sql_update) === TRUE) {
                    echo "Contraseña cambiada correctamente.";
                    header("Location: ../index.php"); // Redirige a la página de inicio
                    exit();
                } else {
                    echo "Error al cambiar la contraseña: " . $conn->error;
                }
            } else {
                $Chg="ErrorN";
            header("Location: user_info.php?Chg=" . urlencode($Chg) . "&from=change");
            }
        } else {
            $Chg="ErrorC";
            header("Location: user_info.php?Chg=" . urlencode($Chg) . "&from=change");
        }
    } else {
        $Chg="ErrorX";
        header("Location: user_info.php?Chg=" . urlencode($Chg) . "&from=change");
    }

    $conn->close();
}
?>
