<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PRODUCCIONES PADRINO - USUARIO</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
<div class="container mt-5 text-left">
    <button type="button" onclick="location.href='FORM_USUARIOS.php'" class="btn btn-primary">ATRAS</button>
    <h3 class="mb-5"></h3>


<?php
require 'database.php'; // Asegúrate de que este archivo contiene la clase Database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST['codigo'];
    $codcli = $_POST['codcli'];
    $nombre = $_POST['nombre'];
    $pass = $_POST['pass'];
    $action = $_POST['action']; // Usar 'action' como el nombre correcto de la variable
    try {
        $db = Database::connect();

        switch ($action) {
            case 'agregar':
                echo "<script>alert('Insertando en tabla USUARIOS!');</script>";
                $sqlInsert = "INSERT INTO USERS (COD_CLI, ROL, NOMBRE, PASS) VALUES (:codcli, :rol, :nombre, :pass)";
                $stmtInsert = $db->prepare($sqlInsert);

                // Consulta para obtener el nombre del cliente
                $querySelect = "SELECT rol FROM persona WHERE cod = :codcli";
                $stmtSelect = $db->prepare($querySelect);
                $stmtSelect->bindParam(':codcli', $codcli, PDO::PARAM_STR);
                $stmtSelect->execute();

                // Obtener el resultado de la consulta
                $resultado = $stmtSelect->fetch(PDO::FETCH_ASSOC);
                if ($resultado) {
                    $rol = $resultado['rol']; // Asignar el nombre del cliente obtenido de la consulta
                } else {
                    die("Error: No se encontró el cliente con el código $codcli");
                }

                // Asignación de parámetros para la inserción
                $stmtInsert->bindParam(':codcli', $codcli, PDO::PARAM_STR);
                $stmtInsert->bindParam(':rol', $rol, PDO::PARAM_STR);
                $stmtInsert->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $stmtInsert->bindParam(':pass', $pass, PDO::PARAM_STR);
                
                                
                if ($stmtInsert->execute()) {
                    echo "<script>alert('Agregado CORRECTAMENTE!');</script>";
                    // Redirigir después de la actualización
                    header("Location: FORM_USUARIOS.php");
                    exit();
                } else {
                    // Obtener información sobre el error
                    $errorInfo = $stmtInsert->errorInfo();
                    die("Error al actualizar en la tabla USUARIOS: " . $errorInfo[2]);
                }
                break;

            case 'modificar':
                echo "<script>alert('Modificando en tabla USUARIOS!');</script>";
                
                // Consulta para obtener el nombre del cliente
                $querySelect = "SELECT rol FROM persona WHERE cod = :codcli";
                $stmtSelect = $db->prepare($querySelect);
                $stmtSelect->bindParam(':codcli', $codcli, PDO::PARAM_STR);
                $stmtSelect->execute();

                // Obtener el resultado de la consulta
                $resultado = $stmtSelect->fetch(PDO::FETCH_ASSOC);
                $resultado = $stmtSelect->fetch(PDO::FETCH_ASSOC);
                if ($resultado) {
                    $rol = $resultado['rol']; // Asignar el nombre del cliente obtenido de la consulta
                } else {
                    die("Error: No se encontró el cliente con el código $codcli");
                }

                // Consulta para actualizar en la tabla COMPRA
                $sqlUpdate = "UPDATE USERS SET cod_cli= : codcli, rol=:rol, nombre= :nombre, pass= :pass WHERE cod = :codigo";
                $stmtUpdate = $db->prepare($sqlUpdate);

                // Asignación de parámetros para la actualización
                $stmtUpdate->bindParam(':codigo', $codigo, PDO::PARAM_STR);
                $stmtUpdate->bindParam(':codcli', $codcli, PDO::PARAM_STR);
                $stmtUpdate->bindParam(':rol', $rol, PDO::PARAM_STR);
                $stmtUpdate->bindParam(':nombre', $nombre, PDO::PARAM_STR);
                $stmtUpdate->bindParam(':pass', $pass, PDO::PARAM_STR);
                
                                
                // Ejecutar la consulta preparada y verificar si se ejecuta correctamente
                if ($stmtUpdate->execute()) {
                    echo "<script>alert('Modificado CORRECTAMENTE!');</script>";
                    // Redirigir después de la actualización
                    header("Location: FORM_USUARIOS.php");
                    exit();
                } else {
                    // Obtener información sobre el error
                    $errorInfo = $stmtUpdate->errorInfo();
                    die("Error al actualizar en la tabla USUARIOS: " . $errorInfo[2]);
                }

                break;
            case 'eliminar':
                echo "<script>alert('Eliminando en tabla USUARIO!');</script>";
                $sqlDelete = "DELETE FROM USERS WHERE cod = :codigo";
                $stmtDelete = $db->prepare($sqlDelete);
                       
                // Asignación de parámetros para la actualización
                $stmtDelete->bindParam(':codigo', $codigo, PDO::PARAM_STR);
                    
                if ($stmtDelete->execute()) {
                    echo "<script>alert('Elminado CORRECTAMENTE!');</script>";
                    // Redirigir después de la eliminacion
                    header("Location: FORM_USUARIOS.php");
                    exit();
                } else {
                    // Obtener información sobre el error
                    $errorInfo = $stmtDelete->errorInfo();
                    die("Error al eliminar en la tabla USUARIO: " . $errorInfo[2]);
                }
                break;

            case 'ver':
                $db = Database::connect();
    
                try {
                // Realizar la consulta SELECT con el parámetro
                $querySelect = "SELECT * FROM USERS WHERE cod = :codigo ORDER BY cod ASC";
                $stmtSelect = $db->prepare($querySelect);
                $stmtSelect->bindParam(':codigo', $codigo, PDO::PARAM_INT);
                $stmtSelect->execute();
                
                // Mostrar los resultados en una tabla HTML
                echo"USUARIO DEL CODIGO CITADO:";
                echo "<table border='1'>
                <tr><th>COD</th><th>COD. CLI.</th><th>ROL</th><th>NOMBRE</th></tr>";
                while ($row = $stmtSelect->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>" . htmlspecialchars($row['cod']) . "</td>
                        <td>" . htmlspecialchars($row['cod_cli']) . "</td>
                        <td>" . htmlspecialchars($row['rol']) . "</td>
                        <td>" . htmlspecialchars($row['nombre']) . "</td></tr>";
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
                    $querySelect = "SELECT * FROM USERS ORDER BY cod ASC";
                    $stmtSelect = $db->prepare($querySelect);
                    
                    $stmtSelect->execute();
                    
                    // Mostrar los resultados en una tabla HTML
                    echo"LISTA DE USUARIOS:";
                    echo "<table border='1'>
                    <tr><th>COD</th><th>COD. CLI.</th><th>ROL</th><th>NOMBRE</th></tr>";
                    while ($row = $stmtSelect->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr><td>" . htmlspecialchars($row['cod']) . "</td>
                            <td>" . htmlspecialchars($row['cod_cli']) . "</td>
                            <td>" . htmlspecialchars($row['rol']) . "</td>
                            <td>" . htmlspecialchars($row['nombre']) . "</td></tr>";
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