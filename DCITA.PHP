<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PRODUCCIONES PADRINO - CITA</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
<div class="container mt-5 text-left">
    <button type="button" onclick="location.href='FORM_CITA.php'" class="btn btn-primary">ATRAS</button>
    <h3 class="mb-5"></h3>

<?php
require 'database.php'; // Asegúrate de que este archivo contiene la clase Database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST['codigo'];
    $motivo = $_POST['motivo'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $celular = $_POST['celular'];
    $action = $_POST['action']; // Usar 'action' como el nombre correcto de la variable

    try {
        $db = Database::connect();

        switch ($action) {
            case 'agregar':
                echo "<script>alert('Insertando en tabla cita!');</script>";
                $sqlInsert = "INSERT INTO cita (motivo, fecha, hora, cel, nom_cli) VALUES (:motivo, :fecha, :hora, :celular, :nom_cli)";
                $stmtInsert = $db->prepare($sqlInsert);

                // Consulta para obtener el nombre del cliente
                $querySelect = "SELECT nombre FROM persona WHERE celular = :celular";
                $stmtSelect = $db->prepare($querySelect);
                $stmtSelect->bindParam(':celular', $celular, PDO::PARAM_STR);
                $stmtSelect->execute();

                // Obtener el resultado de la consulta
                $resultado = $stmtSelect->fetch(PDO::FETCH_ASSOC);
                if ($resultado) {
                    $nomcli = $resultado['nombre']; // Asignar el nombre del cliente obtenido de la consulta
                } else {
                    die("Error: No se encontró el cliente con el celular $celular");
                }

                // Asignación de parámetros para la inserción
                $stmtInsert->bindParam(':motivo', $motivo, PDO::PARAM_STR);
                $stmtInsert->bindParam(':fecha', $fecha, PDO::PARAM_STR);
                $stmtInsert->bindParam(':hora', $hora, PDO::PARAM_STR);
                $stmtInsert->bindParam(':celular', $celular, PDO::PARAM_STR);
                $stmtInsert->bindParam(':nom_cli', $nomcli, PDO::PARAM_STR);

                if ($stmtInsert->execute()) {
                    echo "<script>alert('Modificado CORRECTAMENTE!');</script>";
                    // Redirigir después de la actualización
                    header("Location: FORM_CITA.php");
                    exit();
                } else {
                    // Obtener información sobre el error
                    $errorInfo = $stmtInsert->errorInfo();
                    die("Error al actualizar en la tabla CITA: " . $errorInfo[2]);
                }break;

            case 'modificar':
                echo "<script>alert('Modificando en tabla cita!');</script>";
                $sqlUpdate = "UPDATE cita SET motivo= :motivo, fecha = :fecha, hora = :hora, cel = :celular, nom_cli = :nomcli WHERE cod = :codigo";
                $stmtUpdate = $db->prepare($sqlUpdate);

                // Consulta para obtener el nombre del cliente
                $querySelect = "SELECT nombre FROM persona WHERE celular = :celular";
                $stmtSelect = $db->prepare($querySelect);
                $stmtSelect->bindParam(':celular', $celular, PDO::PARAM_STR);
                $stmtSelect->execute();
                
                // Obtener el resultado de la consulta
                $resultado = $stmtSelect->fetch(PDO::FETCH_ASSOC);
                if ($resultado) {
                    $nomcli = $resultado['nombre']; // Asignar el nombre del cliente obtenido de la consulta
                } else {
                    die("Error: No se encontró el cliente con el código $codcli");
                }
                
                // Asignación de parámetros para la actualización
                $stmtUpdate->bindParam(':codigo', $codigo, PDO::PARAM_STR);
                $stmtUpdate->bindParam(':motivo', $motivo, PDO::PARAM_STR);
                $stmtUpdate->bindParam(':fecha', $fecha, PDO::PARAM_STR);
                $stmtUpdate->bindParam(':hora', $hora, PDO::PARAM_STR);
                $stmtUpdate->bindParam(':celular', $celular, PDO::PARAM_STR);
                $stmtUpdate->bindParam(':nomcli', $nomcli, PDO::PARAM_STR);

                // Ejecutar la consulta preparada
                if ($stmtUpdate->execute()) {
                    echo "<script>alert('Modificado CORRECTAMENTE!');</script>";
                    // Redirigir después de la actualización
                    header("Location: FORM_CITA.php");
                    exit();
                } else {
                    // Obtener información sobre el error
                    $errorInfo = $stmtUpdate->errorInfo();
                    die("Error al actualizar en la tabla CITA: " . $errorInfo[2]);
                }
                exit();
                break;
            case 'eliminar':
                echo "<script>alert('Eliminando en tabla cita!');</script>";
                $sqlDelete = "DELETE FROM cita WHERE cod = :codigo";
                $stmtDelete = $db->prepare($sqlDelete);
                       
                // Asignación de parámetros para la actualización
                $stmtDelete->bindParam(':codigo', $codigo, PDO::PARAM_STR);
                    
                // Ejecutar la consulta preparada
                $stmtDelete->execute();
                echo "<script>alert('Modificado EXITOSAMENTE!');</script>";
                // Redirigir después de la actualización
                header("Location: FORM_CITA.php");
                exit();
                break;
            case 'ver':
                $db = Database::connect();
    
                try {
                // Realizar la consulta SELECT con el parámetro
                $querySelect = "SELECT * FROM cita WHERE cod = :codigo ORDER BY cod ASC";
                $stmtSelect = $db->prepare($querySelect);
                $stmtSelect->bindParam(':codigo', $codigo, PDO::PARAM_INT);
                $stmtSelect->execute();
                
                // Mostrar los resultados en una tabla HTML
                echo"CITA DEL CODIGO CITADO:";
                echo" ";
                echo "<table border='1'>
                <tr><th>COD</th><th>MOTIVO</th><th>FECHA</th><th>HORA</th><th>CELULAR</th><th>NOMBRE CLIENTE</th></tr>";
                while ($row = $stmtSelect->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>" . htmlspecialchars($row['cod']) . "</td>
                        <td>" . htmlspecialchars($row['motivo']) . "</td>
                        <td>" . htmlspecialchars($row['fecha']) . "</td>
                        <td>" . htmlspecialchars($row['hora']) . "</td>
                        <td>" . htmlspecialchars($row['cel']) . "</td>
                        <td>" . htmlspecialchars($row['nom_cli']) . "</td></tr>";
                    }
                echo "</table>";
                echo" ";
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
                // Realizar la consulta SELECT sin el parámetro
                $querySelect = "SELECT * FROM cita ORDER BY cod ASC" ;
                $stmtSelect = $db->query($querySelect);
                // Mostrar los resultados en una tabla HTML
                echo"LISTA DE CITAS:";
                echo "<table border='1'>
                    <tr><th>COD</th><th>MOTIVO</th><th>FECHA</th><th>HORA</th><th>CELULAR</th><th>NOMBRE CLIENTE</th></tr>";
                while ($row = $stmtSelect->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>" . htmlspecialchars($row['cod']) . "</td>
                    <td>" . htmlspecialchars($row['motivo']) . "</td>
                    <td>" . htmlspecialchars($row['fecha']) . "</td>
                    <td>" . htmlspecialchars($row['hora']) . "</td>
                    <td>" . htmlspecialchars($row['cel']) . "</td>
                    <td>" . htmlspecialchars($row['nom_cli']) . "</td></tr>";
                }
                echo "</table>";
                echo "Conexión exitosa";

                } catch (PDOException $e) {
                // Manejar errores de la base de datos
                echo "Error al ejecutar la consulta: " . $e->getMessage();
                } finally {
                // Desconectar de la base de datos
                Database::disconnect();
                }
                exit();
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