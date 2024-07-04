<?php
require_once('../database/database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $boton = $_POST['boton'];
    $numerofolio= $_POST["numfolio"];
    $solname = "";

$sql = "SELECT * FROM solicitudes WHERE folio = '$numerofolio'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Obtener los datos del registro
    $row = $result->fetch_assoc();
    $folio = strval($row["folio"]); // Convertir el folio a string
    $fecha = date("d-m-Y", strtotime($row["fecha"])); // Formatear la fecha


    // creamos variables para obtener luego poder descargar los documentos
    $docsol= $row["formato"];
    $doc1 = $row['doc_federal'];
    $doc2 = $row['doc_estatal'];
    $doc3 = $row['doc_municipal'];

    if($boton==1){
        $solname .= "Solicitud_";
        $solname .= $folio;
        $solname .= "_Fecha_";
        $solname .= $fecha;
        $solname .= ".pdf";
        // Establecer los encabezados para descargar el archivo como PDF
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $solname . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . strlen($docsol));
         // Salida del contenido del archivo
        echo $docsol;
    }
    elseif($boton==2){
        $solname .= "Respuesta_Federal_";
        $solname .= $folio;
        $solname .= "_Fecha_";
        $solname .= $fecha;
        $solname .= ".pdf";
         // Establecer los encabezados para descargar el archivo como PDF
         header('Content-Description: File Transfer');
         header('Content-Type: application/pdf');
         header('Content-Disposition: attachment; filename="'.$solname.'"');
         header('Expires: 0');
         header('Cache-Control: must-revalidate');
         header('Pragma: public');
         header('Content-Length: ' . strlen($doc1));
          // Salida del contenido del archivo
         echo $doc1;
    }
    elseif($boton==3){
        $solname .= "Respuesta_Estatal_";
        $solname .= $folio;
        $solname .= "_Fecha_";
        $solname .= $fecha;
        $solname .= ".pdf";
        // Establecer los encabezados para descargar el archivo como PDF
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="'.$solname.'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . strlen($doc2));
         // Salida del contenido del archivo
        echo $doc2;
   }
   elseif($boton==4){
    $solname .= "Respuesta_Municipal_";
    $solname .= $folio;
    $solname .= "_Fecha_";
    $solname .= $fecha;
    $solname .= ".pdf";
    // Establecer los encabezados para descargar el archivo como PDF
    header('Content-Description: File Transfer');
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="'.$solname.'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . strlen($doc3));
     // Salida del contenido del archivo
    echo $doc3;
}

} else {
    echo "No se encontraron registros para el ID especificado.";
}

// Cerrar la conexión
$conn->close();
}