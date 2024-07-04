<?php 
if (basename($_SERVER['SCRIPT_FILENAME']) === 'index.php') {
    require_once('database/database.php'); // Si el archivo que incluye es index.php
    include 'config.php';
} else {
    require_once('../database/database.php'); // Si el archivo que incluye no es index.php
    include '../config.php';
}
global $admin1, $admin2, $admin3;


            function BotonSubir($documento, $numfolio, $value, $username) {
                if ($documento == "") {
                    // Si no hay documento, mostrar un botón para subir
                    return "<form action='../vistas/entidad_vista.php' method='post'>
                                <input type='hidden' name='username' value='$username'>
                                <input type='hidden' name='numfolio' value='$numfolio'>
                                <input type='hidden' name='boton' value='$value'>
                                <button class='button ewindow-button option-button' type='submit'   >
                                <i class='bi bi-cloud-arrow-up-fill'></i>
                                </button>
                            </form>";
                } else {
                    // Si hay documento, mostrar un botón para descargar
                    return "Respondido";
                }
            }
        
            function BotonDesplegable($folio,$formato,$documento1,$documento2,$documento3,$username) {
                global $admin1, $admin2, $admin3;
                if($username!=$admin2 && $username!=$admin3 && $username!=$admin1){
                $output= "<div class='dropdown'>
                         <button class='button window-button option-button dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                         <i class='bi bi-cloud-arrow-down-fill'></i>
                         </button>
                         <div class='dropdown-menu additional-buttons-container' aria-labelledby='dropdownMenuButton'>";
                         global $conn;
                
                         // Consulta SQL para obtener el mensaje estatal de la tabla alertas
                         $sql = "SELECT * FROM alertas WHERE folio = '$folio'";
                         $result = $conn->query($sql);
                     
                         // Verificar si se encontró un mensaje estatal
                         if ($result->num_rows > 0) {
                             $row = $result->fetch_assoc();
                             $msg_federal = $row['msg_federal'];
                             $msg_estatal = $row['msg_estatal'];
                             $msg_municipal = $row['msg_municipal'];
                             $msg_opcion = $row['razon'];
                             $output="<div class='dropdown'>
                                  <button class='button window-button option-button dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                  <i class='bi bi-exclamation-triangle-fill' style='color: orange;'></i>
                                  </button>
                                  <div class='dropdown-menu additional-buttons-container' aria-labelledby='dropdownMenuButton'>";
                             
                             if($msg_federal!=""){
                                 $output.= "<button type='button' class='dropdown-item awindow-button' data-msg-entidad='$msg_federal' data-msg-opcion='$msg_opcion'>Ver reporte</button>";
                             }
                             if($msg_estatal!=""){
                                 $output.= "<button type='button' class='dropdown-item awindow-button' data-msg-entidad='$msg_estatal' data-msg-opcion='$msg_opcion'>Ver reporte</button>";
                             }
                             if($msg_municipal!=""){
                                $output .= "<button type='button' class='dropdown-item awindow-button' data-msg-entidad='$msg_municipal ' data-msg-opcion='$msg_opcion'>Ver reporte</button>";
                             }
                             return $output;}
                             else{
             if($documento1 != ""){
                  $output.= "<form action='../solicitud/descargar_folio.php' method='post'>
                             <input type='hidden' name='numfolio' value='$folio'>
                             <input type='hidden' name='boton' value='2'>
                             <button type='submit' class='dropdown-item'>Respuesta Federal</button>
                             </form>";}
             if($documento2 != ""){
                  $output.= "<form action='../solicitud/descargar_folio.php' method='post'>
                             <input type='hidden' name='numfolio' value='$folio'>
                             <input type='hidden' name='boton' value='3'>
                             <button type='submit' class='dropdown-item'>Respuesta Estatal</button>
                             </form>";}
             if($documento3 != ""){
                  $output.= "<form action='../solicitud/descargar_folio.php' method='post'>
                             <input type='hidden' name='numfolio' value='$folio'>
                             <input type='hidden' name='boton' value='4'>
                             <button type='submit' class='dropdown-item'>Respuesta Municipal</button>
                             </form>";}
              $output.= "</div>
                        </div>";
                        }
                    }

                        else {
                            $output= 
                            "<div class='dropdown'>
                            <button class='button window-button option-button dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='bi bi-cloud-arrow-down-fill'></i>
                            </button>";
                            if($formato != ""){
                                $output.= "<div class='dropdown-menu additional-buttons-container' aria-labelledby='dropdownMenuButton'>
                                <form action='../solicitud/descargar_folio.php' method='post'>
                                <input type='hidden' name='numfolio' value='$folio'>
                                <input type='hidden' name='boton' value='1'>
                                <button type='submit' class='dropdown-item'>Descargar Solicitud</button>
                                </form>
                                ";}
                            $output.=    "</div>
                            </div>";}
                     return $output;
         }
         function BotonOptions($folio, $entidad) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $folio = $_POST["folio"];
                $entidad = $_POST["entidad"];
            }
            $output = "<div class='dropdown'>
                            <button class='button window-button option-button dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                <i class='bi bi-caret-down-square'></i>
                            </button>
                            <div class='dropdown-menu additional-buttons-container' aria-labelledby='dropdownMenuButton'>
                                <button class='dropdown-item short-button bwindow-button btn-orange-hover' data-folio='$folio' data-user='$entidad' title='Editar Solicitud' type='button'>
                                Editar
                                </button>
                                <button class='dropdown-item short-button cwindow-button btn-red-hover' data-folio='$folio' data-user='$entidad' title='Eliminar Solicitud' type='button'>
                                    Borrar
                                </button>
                            </div>
                        </div>";
            return $output;
        }
        function BotonOptionsM($ID, $entidad) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $ID = $_POST["ID"];
            }
            $output = "<div class='dropdown'>
                            <button class='button window-button option-button dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                <i class='bi bi-caret-down-square'></i>
                            </button>
                            <div class='dropdown-menu additional-buttons-container' aria-labelledby='dropdownMenuButton'>
                                <button class='dropdown-item short-button cwindow-button btn-red-hover' data-folio='$ID' title='Eliminar Solicitud' type='button'>
                                    Borrar
                                </button>
                            </div>
                        </div>";
            return $output;
        }
    
        

        
        // Verificar si se ha enviado el formulario para editar
        if (isset($_POST['editar'])) {
            // Llamar a la función editar

            editar($_POST['folio'], $_POST['entidad']);
        }
        
        // Verificar si se ha enviado el formulario para eliminar
        if (isset($_POST['eliminar'])) {
            // Llamar a la función eliminar
            eliminar($_POST['folio'], $_POST['entidad']);
        }
        
        function eliminar($folio,$entidad) {
            global $conn;
            $sql = "DELETE FROM solicitudes WHERE folio = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $folio);
            $stmt->execute();
            
            if ($stmt->affected_rows > 0) {
                echo "La fila con el folio $folio ha sido eliminada.";
            } else {
                echo "No se encontró ninguna fila con el folio $folio.";
            }
        }
        
        function editar($folio,$entidad) {
            global $conn;
            if($entidad==3 || $entidad==2 ||$entidad==1 ){
                $link="Location: ../vistas/entidad_vista.php";
                
            }
            
            $sql = "UPDATE solicitudes SET formato = '' WHERE folio = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $folio);
            $stmt->execute();
            
            if ($stmt->affected_rows > 0) {
                header($link); // Redirige a la página de inicio después del registro exitoso
                exit();
            } else {
                echo "No se encontró ninguna fila con el folio 
                $folio.";header($link); // Redirige a la página de inicio después del registro exitoso
                exit();
            }
        }
        
    
            
            function obtenerPaginaDestino() {
                global $admin1, $admin2, $admin3, $admin4;
                // Verifica si el nombre de usuario está establecido y no es una cadena vacía
                if (isset($_SESSION["username"]) && $_SESSION["username"] !== "") {
                    // Si el usuario ha iniciado sesión y el nombre de usuario no está vacío, procede con la redirección
                        if($_SESSION["username"]  == $admin1 || $_SESSION["username"]  == $admin2 || $_SESSION["username"]  == $admin3){
                            return "../vistas/entidad_vista.php";
                        }
                        else if ($_SESSION["username"]  == $admin4)
                        {
                            return "../vistas/Mantenimiento.php";
                        }
                     
                    else {
                        return "../vistas/Usuario.php";
                    }
                }
                } 
            
            function Estatus_usuario($folio,$documento,$entidad){
                global $conn;
                
                // Consulta SQL para obtener el mensaje estatal de la tabla alertas
                $sql = "SELECT * FROM alertas WHERE folio = '$folio'";
                $result = $conn->query($sql);
            
                // Verificar si se encontró un mensaje estatal
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    if ($entidad==3){
                        $estatus = $row['msg_federal']; 
                    }
                    else if ($entidad==2){
                        $estatus = $row['msg_estatal']; 
                    }
                    else if($entidad==1){
                        $estatus = $row['msg_municipal'];
                    }
                   
                    if ($estatus==""){
                        return "<i class='bi bi-circle-fill'style='color: grey;'></i>";}
                    else {
                        // Si hay documento, mostrar un botón para descargar
                        return "<i class='bi bi-exclamation-circle-fill'title='Reportado'style='color: orange;'></i>";
                            
                        }
                    }
                if ($documento == "") {
                    // Si no hay documento, mostrar un botón para subir
                    return "<i class='bi bi-x-circle-fill text-danger'></i>";
                } 
                else {
                // Si hay documento, mostrar un botón para descargar
                return "<i class='bi bi-check-circle-fill text-success'></i>";
                       
            }
            }

            function Estatus_entidad($documento,$folio){
                global $conn;
                
                // Consulta SQL para obtener el mensaje estatal de la tabla alertas
                $sql = "SELECT * FROM alertas WHERE folio = '$folio'";
                $result = $conn->query($sql);
            
                // Verificar si se encontró un mensaje estatal
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                        $estatus1 = $row['msg_federal']; 
                        $estatus2 = $row['msg_estatal']; 
                        $estatus3 = $row['msg_municipal'];
                    
                   
                    if ($estatus1!="" || $estatus2!="" || $estatus3!=""){
                        return "<i class='bi bi-exclamation-circle-fill'title='Reportado'style='color: orange;'></i>";}
                    }
                if ($documento == "") {
                    // Si no hay documento, mostrar un botón para subir
                    return "<i class='bi bi-x-circle-fill text-danger'></i>";
                } 
                else {
                // Si hay documento, mostrar un botón para descargar
                return "<i class='bi bi-check-circle-fill text-success'></i>";
                       
            }
            }
           
            function btn_reportar($folio,$ID_usuario){
                global $conn;
               
                
                // Consulta SQL para obtener el mensaje estatal de la tabla alertas
                $sql = "SELECT * FROM alertas WHERE folio = '$folio'";
                $result = $conn->query($sql);
            
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                } else {
                    
                    return "<button type='button' class='dropdown-item awindow-button option-button s-button' data-id='$ID_usuario' data-folio='$folio'>
                    <i class='bi bi-exclamation-triangle-fill report-i' style='color:orange'></i>
                    </button>";
                }
            
            }
            function creacion_reporte($conn) {
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Obtener los datos del formulario
                    $folio = $_POST["folio"];
                    $id = $_POST["id"];
                    $opcion = $_POST["opcion"];
                    $msg = $_POST["mensaje"];
                    $entidad = $_POST["entidad"]; // Establecer el valor de entidad según sea necesario
                    
                    if($entidad==2){
                        $link="Location: ../vistas/entidad_vista.php";
                        $entidad_msg="msg_federal";
                    }
                    else if($entidad==3){
                        $link="Location: ../vistas/entidad_vista.php";
                        $entidad_msg="msg_estatal";
                    }
                    else if($entidad==4){
                        $link="Location: ../vistas/entidad_vista.php";
                        $entidad_msg="msg_municipal";
                    }
                    $stmt_folio = $conn->prepare("UPDATE solicitudes SET fecha_reporte = NOW() WHERE folio = $folio");

                    // Ejecutar la consulta
                    $stmt_folio->execute();

                    // Verificar si la inserción fue exitosa
                    if ($stmt_folio->affected_rows > 0) {
                        echo "Fecha de reporte insertada correctamente.";
                    } else {
                        echo "Error al insertar la fecha de reporte.";
                    }

                    // Cerrar la declaración
                    $stmt_folio->close();
                    // Preparar la consulta SQL para inserción en la tabla alertas
                    $sql_alertas = "INSERT INTO alertas (folio, $entidad_msg, razon, username) VALUES (?, ?, ?, ?)";
                    
                    // Preparar y ejecutar la consulta para inserción en la tabla alertas
                    $stmt_alertas = $conn->prepare($sql_alertas);
                    $stmt_alertas->bind_param("isss", $folio, $msg, $opcion, $id);
                    $stmt_alertas->execute();
            
                    // Verificar si la inserción fue exitosa en la tabla alertas
                    if ($stmt_alertas->affected_rows > 0) {
                        // Preparar la consulta SQL para actualización en la tabla solicitudes
                        $sql_actualizar_estatus = "UPDATE solicitudes SET estatus = ? WHERE folio = ?";
                        
                        // Preparar y ejecutar la consulta para actualización en la tabla solicitudes
                        $stmt_seguimiento = $conn->prepare($sql_actualizar_estatus);
                        $estatus = $entidad; // Usar $entidad como nuevo estatus
                        $stmt_seguimiento->bind_param("si", $entidad, $folio);
                        $stmt_seguimiento->execute();
                        
                        // Verificar si la actualización fue exitosa en la tabla solicitudes
                        if ($stmt_seguimiento->affected_rows > 0) {
                            header($link); // Redirige a la página de inicio después del registro exitoso
                            exit();
                        } else {
                            echo "Error al actualizar el estatus en la tabla de seguimiento.";
                        }
                    } else {
                        echo "Error al insertar datos en la tabla alertas.";
                    }
            
                    // Cerrar las declaraciones y la conexión
                    $stmt_alertas->close();
                    $stmt_seguimiento->close();
                    $conn->close();
                }
            }
            
            // Llamada a la función con el objeto de conexión como argumento
            creacion_reporte($conn);

            function alert_rev($folio){
                global $conn;
                
                // Consulta SQL para obtener el mensaje estatal de la tabla alertas
                $sql = "SELECT * FROM alertas WHERE folio = '$folio'";
                $result = $conn->query($sql);
            
                // Verificar si se encontró un mensaje estatal
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $msg_federal = $row['msg_federal'];
                    $msg_estatal = $row['msg_estatal'];
                    $msg_municipal = $row['msg_municipal'];
                    $output="<div class='dropdown'>
                         <button class='button window-button option-button dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                         <i class='bi bi-exclamation-triangle-fill' style='color: orange;'></i>
                         </button>
                         <div class='dropdown-menu additional-buttons-container' aria-labelledby='dropdownMenuButton'>";
                    
                    if($msg_federal!=""){
                        $output.= "<button type='button' class='dropdown-item awindow-button' data-msg='$msg_federal'>Ver reporte federal</button>";
                    }
                    if($msg_estatal!=""){
                        $output.= "<button type='button' class='dropdown-item awindow-button' data-msg='$msg_estatal'>Ver reporte estatal</button>";
                    }
                    if($msg_municipal!=""){
                        $output.= "<button type='button' class='dropdown-item awindow-button' data-msg='$msg_municipal'>Ver reporte municipal</button>";
                    }
                    return $output;
                } else {
                    // Si no hay mensaje estatal, devolver una cadena vacía
                    return "";
                }
            }
            