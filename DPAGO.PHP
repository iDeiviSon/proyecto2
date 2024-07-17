<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PRODUCCIONES PADRINO - PAGO</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
<div class="container mt-5 text-left">
    <button type="button" onclick="location.href='FORM_PAGO.php'" class="btn btn-primary">ATRAS</button>
    <h3 class="mb-5"></h3>

<?php
require 'database.php'; // Asegúrate de que este archivo contiene la clase Database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST['codigo'];
    $codcli = $_POST['codcli'];
    $nomserv = $_POST['nomserv'];
    $met = $_POST['met'];
    $fecha = $_POST['fecha'];
    $saldo = $_POST['saldo'];

    $action = $_POST['action']; // Usar 'action' como el nombre correcto de la variable
    try {
        $db = Database::connect();

        switch ($action) {
            case 'agregar':
                echo "<script>alert('Insertando en tabla PAGO!');</script>";
                $sqlInsert = "INSERT INTO PAGO (COD_CLI, NOM_CLI, APELLp_CLI, APELLm_CLI, CEL_CLI, NOM_SERV, METODO, FECHA, MONTO, SALDO) 
                VALUES (:codcli, :nomcli, :apellp, :apellm, :cel, :nomserv, :met, :fecha, :monto, :saldo)";
                $stmtInsert = $db->prepare($sqlInsert);
                
                // Consulta para obtener el nombre del cliente
                $querySelect = "SELECT * FROM persona WHERE cod = :codcli";
                $stmtSelect = $db->prepare($querySelect);
                $stmtSelect->bindParam(':codcli', $codcli, PDO::PARAM_STR);
                $stmtSelect->execute();

                // Obtener el resultado de la consulta
                $resultado = $stmtSelect->fetch(PDO::FETCH_ASSOC);
                if ($resultado) {
                    $nomcli = $resultado['nombre']; // Asignar el nombre del cliente obtenido de la consulta
                    $apellp = $resultado['apell_p'];
                    $apellm = $resultado['apell_m'];
                    $cel = $resultado['celular'];
                } else {
                    die("Error: No se encontró el cliente con el código $codcli");
                }

                // Consulta para obtener el monto del servicio
                $querySelect = "SELECT * FROM servicio WHERE nombre = :nomserv";
                $stmtSelect = $db->prepare($querySelect);
                $stmtSelect->bindParam(':nomserv', $nomserv, PDO::PARAM_STR);
                $stmtSelect->execute();

                // Obtener el resultado de la consulta
                $resultado = $stmtSelect->fetch(PDO::FETCH_ASSOC);
                if ($resultado) {
                    $nombserv = $resultado['nombre']; // Asignar el nombre del cliente obtenido de la consulta
                    $precio = $resultado['precio'];
                   
                } else {
                    die("Error: No se encontró el servicio con el nombre $nomserv");
                }

                // Asignación de parámetros para la inserción
                $stmtInsert->bindParam(':codcli', $codcli, PDO::PARAM_STR);
                $stmtInsert->bindParam(':nomcli', $nomcli, PDO::PARAM_STR);
                $stmtInsert->bindParam(':apellp', $apellp, PDO::PARAM_STR);
                $stmtInsert->bindParam(':apellm', $apellm, PDO::PARAM_STR);
                $stmtInsert->bindParam(':cel', $cel, PDO::PARAM_STR);
                $stmtInsert->bindParam(':nomserv', $nombserv, PDO::PARAM_STR);
                $stmtInsert->bindParam(':met', $met, PDO::PARAM_STR);
                $stmtInsert->bindParam(':fecha', $fecha, PDO::PARAM_STR);
                $stmtInsert->bindParam(':monto', $precio, PDO::PARAM_STR);
                $stmtInsert->bindParam(':saldo', $saldo, PDO::PARAM_STR);
                
                if ($stmtInsert->execute()) {
                    echo "<script>alert('Modificado CORRECTAMENTE!');</script>";
                    // Redirigir después de la actualización
                    header("Location: FORM_PAGO.php");
                    exit();
                } else {
                    // Obtener información sobre el error
                    $errorInfo = $stmtInsert->errorInfo();
                    die("Error al actualizar en la tabla PAGO: " . $errorInfo[2]);
                }
                break;

                case 'modificar':
                    echo "<script>alert('Modificando en tabla PAGO!');</script>";
                    
                    // Consulta para obtener el nombre del cliente
                    $querySelect = "SELECT * FROM persona WHERE cod = :codcli";
                    $stmtSelect = $db->prepare($querySelect);
                    $stmtSelect->bindParam(':codcli', $codcli, PDO::PARAM_STR);
                    $stmtSelect->execute();
                
                    // Obtener el resultado de la consulta
                    $resultado = $stmtSelect->fetch(PDO::FETCH_ASSOC);
                    if ($resultado) {
                        $nombcli = $resultado['nombre']; // Asignar el nombre del cliente obtenido de la consulta
                        $apellp = $resultado['apell_p'];
                        $apellm = $resultado['apell_m'];
                        $cel = $resultado['celular'];
                        //echo "Nombre: $nombcli, Apellido Paterno: $apellp, Apellido Materno: $apellm, Celular: $cel<br>";
                    } else {
                        die("Error: No se encontró el cliente con el código $codcli");
                    }
                
                    // Consulta para obtener el monto del servicio
                    $querySelect = "SELECT * FROM servicio WHERE nombre = :nomserv";
                    $stmtSelect = $db->prepare($querySelect);
                    $stmtSelect->bindParam(':nomserv', $nomserv, PDO::PARAM_STR);
                    $stmtSelect->execute();
                
                    // Obtener el resultado de la consulta
                    $resultado = $stmtSelect->fetch(PDO::FETCH_ASSOC);
                    if ($resultado) {
                        $monto = $resultado['precio']; // Asignar el monto del servicio obtenido de la consulta
                        $nombserv = $resultado['nombre'];
                        //echo "Nombre del Servicio: $nombserv, Precio: $monto<br>";
                    } else {
                        die("Error: No se encontró el servicio con el nombre $nomserv");
                    }
                
                    // Consulta para actualizar en la tabla PAGO
                    $sqlUpdate = "UPDATE PAGO SET cod_cli= :codcli, nom_cli = :nombcli, apellp_cli= :apellp, apellm_cli= :apellm, cel_cli= :cel, nom_serv= :nombserv, metodo= :met, fecha = :fecha, monto = :monto, saldo = :saldo WHERE cod = :codigo";
                    $stmtUpdate = $db->prepare($sqlUpdate);
                    
                    // Asignación de parámetros para la actualización
                    $stmtUpdate->bindParam(':codigo', $codigo, PDO::PARAM_STR);
                    $stmtUpdate->bindParam(':codcli', $codcli, PDO::PARAM_STR);
                    $stmtUpdate->bindParam(':nombcli', $nombcli, PDO::PARAM_STR);
                    $stmtUpdate->bindParam(':apellp', $apellp, PDO::PARAM_STR);
                    $stmtUpdate->bindParam(':apellm', $apellm, PDO::PARAM_STR);
                    $stmtUpdate->bindParam(':cel', $cel, PDO::PARAM_STR);
                    $stmtUpdate->bindParam(':nombserv', $nombserv, PDO::PARAM_STR);
                    $stmtUpdate->bindParam(':met', $met, PDO::PARAM_STR);
                    $stmtUpdate->bindParam(':fecha', $fecha, PDO::PARAM_STR);
                    $stmtUpdate->bindParam(':monto', $monto, PDO::PARAM_STR);
                    $stmtUpdate->bindParam(':saldo', $saldo, PDO::PARAM_STR);
                
                    // Ejecutar la consulta preparada y verificar si se ejecuta correctamente
                    if ($stmtUpdate->execute()) {
                        echo "<script>alert('Modificado CORRECTAMENTE!');</script>";
                        // Redirigir después de la actualización
                        header("Location: FORM_PAGO.php");
                        exit();
                    } else {
                        // Obtener información sobre el error
                        $errorInfo = $stmtUpdate->errorInfo();
                        die("Error al actualizar en la tabla PAGO: " . $errorInfo[2]);
                    }
                
                    break;
                

            case 'eliminar':
                echo "<script>alert('Eliminando en tabla PAGO!');</script>";
                $sqlDelete = "DELETE FROM PAGO WHERE cod = :codigo";
                $stmtDelete = $db->prepare($sqlDelete);
                       
                // Asignación de parámetros para la actualización
                $stmtDelete->bindParam(':codigo', $codigo, PDO::PARAM_STR);
                    
                if ($stmtDelete->execute()) {
                    echo "<script>alert('Elminado CORRECTAMENTE!');</script>";
                    // Redirigir después de la eliminacion
                    header("Location: FORM_PAGO.php");
                    exit();
                } else {
                    // Obtener información sobre el error
                    $errorInfo = $stmtDelete->errorInfo();
                    die("Error al eliminar en la tabla PAGO: " . $errorInfo[2]);
                }
                break;

            case 'ver':
                $db = Database::connect();
    
                try {
                // Realizar la consulta SELECT con el parámetro
                $querySelect = "SELECT * FROM PAGO WHERE cod = :codigo ORDER BY cod ASC";
                $stmtSelect = $db->prepare($querySelect);
                $stmtSelect->bindParam(':codigo', $codigo, PDO::PARAM_INT);
                $stmtSelect->execute();
                
                // Mostrar los resultados en una tabla HTML
                echo"PAGO DEL CODIGO CITADO:";
                echo "<table border='1'>
                <tr><th>COD</th><th>COD_CLI</th><th>NOMB_CLI</th><th>APELLIDO PAT. CLI.</th><th>APELLIDO MAT. CLI.</th><th>CEL. CLI.</th><th>NOM. SERV.</th><th>METODO</th><th>FECHA</th><th>MONTO</th><th>SALDO</th></tr>";
                while ($row = $stmtSelect->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>" . htmlspecialchars($row['cod']) . "</td>
                        <td>" . htmlspecialchars($row['cod_cli']) . "</td>
                        <td>" . htmlspecialchars($row['nom_cli']) . "</td>
                        <td>" . htmlspecialchars($row['apellp_cli']) . "</td>
                        <td>" . htmlspecialchars($row['apellm_cli']) . "</td>
                        <td>" . htmlspecialchars($row['cel_cli']) . "</td>
                        <td>" . htmlspecialchars($row['nom_serv']) . "</td>
                        <td>" . htmlspecialchars($row['metodo']) . "</td>
                        <td>" . htmlspecialchars($row['fecha']) . "</td>
                        <td>" . htmlspecialchars($row['monto']) . "</td>
                        <td>" . htmlspecialchars($row['saldo']) . "</td></tr>";
                    }
                echo "</table>";
                echo "Conexión exitosa";
            
                } catch (PDOException $e) {
                // Manejar errores de la base de datos
                    echo "Error al ejecutar la consulta: " . $e->getMessage();
                } finally {
                    // Desconectar de la base de datos
                    Database::disconnect();
                }exit();
                break;

            case 'listar':
                $db = Database::connect();
    
                try {
                // Realizar la consulta SELECT con el parámetro
                $querySelect = "SELECT * FROM PAGO ORDER BY cod ASC";
                $stmtSelect = $db->prepare($querySelect);
                
                $stmtSelect->execute();
                
                // Mostrar los resultados en una tabla HTML
                echo"LISTA DE PAGOS:";
                echo "<table border='1'>
                <tr><th>COD</th><th>COD_CLI</th><th>NOMB_CLI</th><th>APELLIDO PAT. CLI.</th><th>APELLIDO MAT. CLI.</th><th>CEL. CLI.</th><th>NOM. SERV.</th><th>METODO</th><th>FECHA</th><th>MONTO</th><th>SALDO</th></tr>";
                while ($row = $stmtSelect->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>" . htmlspecialchars($row['cod']) . "</td>
                        <td>" . htmlspecialchars($row['cod_cli']) . "</td>
                        <td>" . htmlspecialchars($row['nom_cli']) . "</td>
                        <td>" . htmlspecialchars($row['apellp_cli']) . "</td>
                        <td>" . htmlspecialchars($row['apellm_cli']) . "</td>
                        <td>" . htmlspecialchars($row['cel_cli']) . "</td>
                        <td>" . htmlspecialchars($row['nom_serv']) . "</td>
                        <td>" . htmlspecialchars($row['metodo']) . "</td>
                        <td>" . htmlspecialchars($row['fecha']) . "</td>
                        <td>" . htmlspecialchars($row['monto']) . "</td>
                        <td>" . htmlspecialchars($row['saldo']) . "</td></tr>";
                    }
                echo "</table>";
                echo "Conexión exitosa";
            
                } catch (PDOException $e) {
                // Manejar errores de la base de datos
                    echo "Error al ejecutar la consulta: " . $e->getMessage();
                } finally {
                    // Desconectar de la base de datos
                    Database::disconnect();
                }exit();break;
            
    
            default:
                throw new Exception("Acción no válida seleccionada.");
            }
            } catch (Exception $e) {
            echo "<script>alert('Error: " . $e->getMessage() . "'); window.history.back();</script>";
            } finally {
            Database::disconnect();
            }
}
?>
</div>
</body>
</html>