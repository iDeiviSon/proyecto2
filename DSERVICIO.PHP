<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PRODUCCIONES PADRINO - SERVICIO</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
<div class="container mt-5 text-left">
    <button type="button" onclick="location.href='FORM_SERVICIO.php'" class="btn btn-primary">ATRAS</button>
    <h3 class="mb-5"></h3>

<?php
require 'database.php'; // Asegúrate de que este archivo contiene la clase Database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $action = $_POST['action']; // Usar 'action' como el nombre correcto de la variable
    try {
        $db = Database::connect();

        switch ($action) {
            case 'agregar':
                echo "<script>alert('Insertando en tabla servicio!');</script>";
                $sqlInsert = "INSERT INTO SERVICIO (NOMBRE, PRECIO) VALUES (:nombre, :precio)";
                $stmtInsert = $db->prepare($sqlInsert);

                // Asignación de parámetros para la inserción
                $stmtInsert->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $stmtInsert->bindParam(':precio', $precio, PDO::PARAM_STR);
                
                if ($stmtInsert->execute()) {
                    echo "<script>alert('Modificado CORRECTAMENTE!');</script>";
                    // Redirigir después de la actualización
                    header("Location: FORM_SERVICIO.php");
                    exit();
                } else {
                    // Obtener información sobre el error
                    $errorInfo = $stmtInsert->errorInfo();
                    die("Error al actualizar en la tabla SERVICIO: " . $errorInfo[2]);
                }
                break;

            case 'modificar':
                echo "<script>alert('Modificando en tabla SERVICIO!');</script>";
                
                // Consulta para actualizar en la tabla COMPRA
                $sqlUpdate = "UPDATE SERVICIO SET nombre= :nombre, precio = :precio WHERE cod = :codigo";
                $stmtUpdate = $db->prepare($sqlUpdate);

                // Asignación de parámetros para la actualización
                $stmtUpdate->bindParam(':codigo', $codigo, PDO::PARAM_STR);
                $stmtUpdate->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $stmtUpdate->bindParam(':precio', $precio, PDO::PARAM_STR);
                
                // Ejecutar la consulta preparada y verificar si se ejecuta correctamente
                if ($stmtUpdate->execute()) {
                    echo "<script>alert('Modificado CORRECTAMENTE!');</script>";
                    // Redirigir después de la actualización
                    header("Location: FORM_SERVICIO.php");
                    exit();
                } else {
                    // Obtener información sobre el error
                    $errorInfo = $stmtUpdate->errorInfo();
                    die("Error al actualizar en la tabla SERVICIO: " . $errorInfo[2]);
                }

                break;
            case 'eliminar':
                echo "<script>alert('Eliminando en tabla SERVICIO!');</script>";
                $sqlDelete = "DELETE FROM SERVICIO WHERE cod = :codigo";
                $stmtDelete = $db->prepare($sqlDelete);
                       
                // Asignación de parámetros para la actualización
                $stmtDelete->bindParam(':codigo', $codigo, PDO::PARAM_STR);
                    
                if ($stmtDelete->execute()) {
                    echo "<script>alert('Elminado CORRECTAMENTE!');</script>";
                    // Redirigir después de la eliminacion
                    header("Location: FORM_SERVICIO.php");
                    exit();
                } else {
                    // Obtener información sobre el error
                    $errorInfo = $stmtDelete->errorInfo();
                    die("Error al eliminar en la tabla SERVICIO: " . $errorInfo[2]);
                }
                break;

            case 'ver':
                $db = Database::connect();
    
                try {
                // Realizar la consulta SELECT con el parámetro
                $querySelect = "SELECT * FROM SERVICIO WHERE cod = :codigo ORDER BY cod ASC";
                $stmtSelect = $db->prepare($querySelect);
                $stmtSelect->bindParam(':codigo', $codigo, PDO::PARAM_INT);
                $stmtSelect->execute();
                
                // Mostrar los resultados en una tabla HTML
                echo"SERVICIO DEL CODIGO CITADO:";
                echo "<table border='1'>
                <tr><th>COD</th><th>NOMBRE</th><th>PRECIO</th></tr>";
                while ($row = $stmtSelect->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>" . htmlspecialchars($row['cod']) . "</td>
                        <td>" . htmlspecialchars($row['nombre']) . "</td>
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
                    $querySelect = "SELECT * FROM SERVICIO ORDER BY cod ASC";
                    $stmtSelect = $db->prepare($querySelect);
                    
                    $stmtSelect->execute();
                    
                    // Mostrar los resultados en una tabla HTML
                    echo"LISTA DE SERVICIOS:";
                    echo "<table border='1'>
                    <tr><th>COD</th><th>NOMBRE</th><th>PRECIO</th></tr>";
                    while ($row = $stmtSelect->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr><td>" . htmlspecialchars($row['cod']) . "</td>
                            <td>" . htmlspecialchars($row['nombre']) . "</td>
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