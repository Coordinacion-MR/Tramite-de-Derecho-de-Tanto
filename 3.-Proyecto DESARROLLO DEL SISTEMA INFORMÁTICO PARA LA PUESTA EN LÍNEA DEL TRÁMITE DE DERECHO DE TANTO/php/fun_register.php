<?php
// Incluye el archivo que contiene la conexión a la base de datos
require_once('../database/database.php');

// Verifica si el método de la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos del formulario
    $username = $_POST["username"];
    $password = $_POST["password"];
    $Nombre = $_POST["Nombre"];
    $ApellidoP = $_POST["ApellidoP"];
    $ApellidoM = $_POST["ApellidoM"];
    $CURP = $_POST["CURP"];
    $Correo = $_POST["Correo"];
    $recover_word = $_POST["recover_word"];

    // Verificar si el usuario ya existe en la base de datos por su username
    $query = $conn->prepare("SELECT * FROM usuarios WHERE username = ?");
    $query->bind_param("s", $username);
    $query->execute();
    $result = $query->get_result();

    // Si el nombre de usuario ya está registrado
    if ($result->num_rows > 0) {
        echo "El nombre de usuario ya está registrado.";
        $Log = "user";
        header("Location: registro.php?Log=" . urlencode($Log) . "&from=register");
        exit();
    }

    // Verificar si el usuario ya existe en la base de datos por su correo
    $query = $conn->prepare("SELECT * FROM usuarios WHERE correo = ?");
    $query->bind_param("s", $Correo);
    $query->execute();
    $result = $query->get_result();

    // Si el correo electrónico ya está registrado
    if ($result->num_rows > 0) {
        echo "El correo electronico ya está registrado.";
        $Log = "email";
        header("Location: registro.php?Log=" . urlencode($Log) . "&from=register");
        exit();
    } else {
        // Si el usuario y el correo no están registrados, se procede a registrar al nuevo usuario
        // Hashea la contraseña y la palabra de recuperación para almacenarlas de forma segura
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $hashed_recover_word = password_hash($recover_word, PASSWORD_DEFAULT);

        // Prepara la consulta para insertar el nuevo usuario en la base de datos
        $sql = $conn->prepare("INSERT INTO usuarios (username, password, nombre, apellido_P, apellido_M, curp, correo, recover_word) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param("ssssssss", $username, $hashed_password, $Nombre, $ApellidoP, $ApellidoM, $CURP, $Correo, $hashed_recover_word);

        // Ejecuta la consulta y verifica si se realizó con éxito
        if ($sql->execute()) {
            // Si la inserción es exitosa, redirige a la página principal
            header("Location: ../index.php");
            exit();
        } else {
            // Si hay un error en la inserción, muestra un mensaje de error
            echo "Error: " . $sql->error;
        }
    }

    // Cierra la conexión a la base de datos
    $conn->close();
}
?>