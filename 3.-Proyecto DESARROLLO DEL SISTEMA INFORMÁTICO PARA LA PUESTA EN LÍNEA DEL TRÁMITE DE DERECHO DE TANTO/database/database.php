<?php
/*El apartado de "servername" es donde se colocara el nombre del servidor, que seria similar al apartado de MySQL Host Name
  El siguiente es "username es el nombre del usuario que tiene acceso al servidor, que seria simial a MySQL User Name
  Seguimos ahora con "password" esta es la contraseña del usuario, esto es similar a MySQL Password
  y por utlimo tenemos a "dbname" que es el nombre de la base de datos donde tengamos nuestras tablas, esto seria equivalente a MySQL DB Name.
  ---------------------------------------------------------------------------
  Ahorra mostrare un ejemplo de como estaria esto aplicado en un servidor real

  Datos: MySQL DB Name = "if0_36703455_pagina", MySQL User Name = "if0_36703455", MySQL Password = "12345678" y MySQL Host Name = "sql304.infinityfree.com"
  
  Variables del software:
    $servername = "sql304.infinityfree.com";
    $username = "if0_36703455";
    $password = "12345678";
    $dbname = "if0_36703455_pagina";

*/
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pagina";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);
$PDO=$conn;
// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
