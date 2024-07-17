<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PRODUCCIONES PADRINO - DETALLE</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
<div class="container mt-5 text-left">
    <button type="button" onclick="location.href='FORM_DETALLE.php'" class="btn btn-primary">ATRAS</button>
    <h3 class="mb-5"></h3>

<?php
require 'database.php'; // Asegúrate de que este archivo contiene la clase Database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST['codigo'];
    $codcom = $_POST['codcom'];
    $codserv = $_POST['codserv'];
    $cantidad = $_POST['cantidad'];
    $action = $_POST['action']; // Usar 'action' como el nombre correcto de la variable
    try {
        $db = Database::connect();

        switch ($action) {
            case 'agregar':
                echo "<script>alert('Insertando en tabla compra!');</script>";
                $sqlInsert = "INSERT INTO DETALLE (COD_COMP, COD_SERV, NOM_SERV,CANTIDAD,PRECIO) VALUES (:codcom, :codserv, :nomserv, :cantidad, :monto)";
                $stmtInsert = $db->prepare($sqlInsert);

                // Consulta para obtener el nombre del cliente
                $querySelect = "SELECT nombre FROM SERVICIO WHERE cod = :codserv";
                $stmtSelect = $db->prepare($querySelect);
                $stmtSelect->bindParam(':codserv', $codserv, PDO::PARAM_STR);
                $stmtSelect->execute();

                // Obtener el resultado de la consulta
                $resultado = $stmtSelect->fetch(PDO::FETCH_ASSOC);
                if ($resultado) {
                    $nomserv = $resultado['nombre']; // Asignar el nombre del cliente obtenido de la consulta
                } else {
                    die("Error: No se encontró la compra con el código $codserv");
                }

                // Consulta para obtener el monto del servicio
                $querySelect = "SELECT precio FROM servicio WHERE cod = :codserv";
                $stmtSelect = $db->prepare($querySelect);
                $stmtSelect->bindParam(':codserv', $codserv, PDO::PARAM_STR);
                $stmtSelect->execute();

                // Obtener el resultado de la consulta
                $resultado = $stmtSelect->fetch(PDO::FETCH_ASSOC);
                if ($resultado) {
                    $monto = $resultado['precio']; // Asignar el monto del servicio obtenido de la consulta
                } else {
                    die("Error: No se encontró el servicio con el código $codserv");
                }
                $montoTotal = $monto * $cantidad;
                // Asignación de parámetros para la inserción
                $stmtInsert->bindParam(':codcom', $codcom, PDO::PARAM_STR);
                $stmtInsert->bindParam(':codserv', $codserv, PDO::PARAM_STR);
                $stmtInsert->bindParam(':nomserv', $nomserv, PDO::PARAM_STR);
                $stmtInsert->bindParam(':cantidad', $cantidad, PDO::PARAM_STR);
                $stmtInsert->bindParam(':monto', $montoTotal, PDO::PARAM_STR);
                
                if ($stmtInsert->execute()) {
                    echo "<script>alert('Agregado CORRECTAMENTE!');</script>";
                    // Redirigir después de la actualización
                    header("Location: FORM_DETALLE.php");
                    exit();
                } else {
                    // Obtener información sobre el error
                    $errorInfo = $stmtInsert->errorInfo();
                    die("Error al actualizar en la tabla DETALLE: " . $errorInfo[2]);
                }
                break;

            case 'modificar':
                echo "<script>alert('Modificando en tabla compra!');</script>";
                
                // Consulta para obtener el nombre del cliente
                $querySelect = "SELECT nombre FROM SERVICIO WHERE cod = :codserv";
                $stmtSelect = $db->prepare($querySelect);
                $stmtSelect->bindParam(':codserv', $codserv, PDO::PARAM_STR);
                $stmtSelect->execute();

                // Obtener el resultado de la consulta
                $resultado = $stmtSelect->fetch(PDO::FETCH_ASSOC);
                if ($resultado) {
                    $nomserv = $resultado['nombre']; // Asignar el nombre del cliente obtenido de la consulta
                } else {
                    die("Error: No se encontró la compra con el código $codserv");
                }

                // Consulta para obtener el monto del servicio
                $querySelect = "SELECT precio FROM servicio WHERE cod = :codserv";
                $stmtSelect = $db->prepare($querySelect);
                $stmtSelect->bindParam(':codserv', $codserv, PDO::PARAM_STR);
                $stmtSelect->execute();

                // Obtener el resultado de la consulta
                $resultado = $stmtSelect->fetch(PDO::FETCH_ASSOC);
                if ($resultado) {
                    $monto = $resultado['precio']; // Asignar el monto del servicio obtenido de la consulta
                } else {
                    die("Error: No se encontró el servicio con el código $codserv");
                }
                $montoTotal = $monto * $cantidad;

                // Consulta para actualizar en la tabla DETALLE
                $sqlUpdate = "UPDATE DETALLE SET cod_comp= :codcom, cod_serv = :codserv, nom_serv = :nomserv, cantidad = :cantidad, precio = :monto WHERE cod = :codigo";
                $stmtUpdate = $db->prepare($sqlUpdate);

                // Asignación de parámetros para la actualización
                $stmtUpdate->bindParam(':codigo', $codigo, PDO::PARAM_STR);
                $stmtUpdate->bindParam(':codcom', $codcom, PDO::PARAM_STR);
                $stmtUpdate->bindParam(':codserv', $codserv, PDO::PARAM_STR);
                $stmtUpdate->bindParam(':nomserv', $nomserv, PDO::PARAM_STR);
                $stmtUpdate->bindParam(':cantidad', $cantidad, PDO::PARAM_STR);
                $stmtUpdate->bindParam(':monto', $montoTotal, PDO::PARAM_STR);
                
                // Ejecutar la consulta preparada y verificar si se ejecuta correctamente
                if ($stmtUpdate->execute()) {
                    echo "<script>alert('Modificado CORRECTAMENTE!');</script>";
                    // Redirigir después de la actualización
                    header("Location: FORM_DETALLE.php");
                    exit();
                } else {
                    // Obtener información sobre el error
                    $errorInfo = $stmtUpdate->errorInfo();
                    die("Error al actualizar en la tabla DETALLE: " . $errorInfo[2]);
                }

                break;
            case 'eliminar':
                echo "<script>alert('Eliminando en tabla DETALLE!');</script>";
                $sqlDelete = "DELETE FROM DETALLE WHERE cod = :codigo";
                $stmtDelete = $db->prepare($sqlDelete);
                       
                // Asignación de parámetros para la actualización
                $stmtDelete->bindParam(':codigo', $codigo, PDO::PARAM_STR);
                    
                if ($stmtDelete->execute()) {
                    echo "<script>alert('Elminado CORRECTAMENTE!');</script>";
                    // Redirigir después de la eliminacion
                    header("Location: FORM_DETALLE.php");
                    exit();
                } else {
                    // Obtener información sobre el error
                    $errorInfo = $stmtDelete->errorInfo();
                    die("Error al eliminar en la tabla DETALLE: " . $errorInfo[2]);
                }
                break;

            case 'ver':
                $db = Database::connect();
    
                try {
                // Realizar la consulta SELECT con el parámetro
                $querySelect = "SELECT * FROM DETALLE WHERE cod = :codigo ORDER BY cod ASC ";
                $stmtSelect = $db->prepare($querySelect);
                $stmtSelect->bindParam(':codigo', $codigo, PDO::PARAM_INT);
                $stmtSelect->execute();
                
                // Mostrar los resultados en una tabla HTML
                echo"DETALLE DEL CODIGO CITADO:";
                echo "<table border='1'>
                <tr><th>COD</th><th>COD. COMP.</th><th>COD. SERV.</th><th>NOMB. SERV.</th><th>CANTIDAD.</th><th>PRECIO</th></tr>";
                while ($row = $stmtSelect->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>" . htmlspecialchars($row['cod']) . "</td>
                        <td>" . htmlspecialchars($row['cod_comp']) . "</td>
                        <td>" . htmlspecialchars($row['cod_serv']) . "</td>
                        <td>" . htmlspecialchars($row['nom_serv']) . "</td>
                        <td>" . htmlspecialchars($row['cantidad']) . "</td>
                        <td>" . htmlspecialchars($row['precio']) . "</td></tr>";
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
                $querySelect = "SELECT * FROM DETALLE ORDER BY cod ASC ";
                $stmtSelect = $db->prepare($querySelect);
                
                $stmtSelect->execute();
                
                // Mostrar los resultados en una tabla HTML
                echo"LISTA DE DETALLES:";
                echo "<table border='1'>
                <tr><th>COD</th><th>COD. COMP.</th><th>COD. SERV.</th><th>NOMB. SERV.</th><th>CANTIDAD.</th><th>PRECIO</th></tr>";
                while ($row = $stmtSelect->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr><td>" . htmlspecialchars($row['cod']) . "</td>
                            <td>" . htmlspecialchars($row['cod_comp']) . "</td>
                            <td>" . htmlspecialchars($row['cod_serv']) . "</td>
                            <td>" . htmlspecialchars($row['nom_serv']) . "</td>
                            <td>" . htmlspecialchars($row['cantidad']) . "</td>
                            <td>" . htmlspecialchars($row['precio']) . "</td></tr>";
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