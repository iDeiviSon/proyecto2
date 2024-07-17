<?php
class Database {
    private static $dbName = 'BD_PRODPAD'; // Nombre de la base de datos
    private static $dbHost = 'produccionespadrino.site'; // Host de la base de datos
    private static $dbUsername = 'ADMIN'; // Usuario de la base de datos
    private static $dbUserPassword = 'ADMINADMIN'; // Contraseña de la base de datos
    private static $cont = null;

    public function __construct() {
        die('Init function is not allowed');
    }

    public static function connect() {
        // Una conexión para toda la aplicación
        if (null == self::$cont) {
            try {
                self::$cont =  new PDO("pgsql:host=" . self::$dbHost . ";" . "dbname=" . self::$dbName, self::$dbUsername, self::$dbUserPassword);
                self::$cont->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Configuración de manejo de errores
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$cont;
    }

    public static function disconnect() {
        self::$cont = null;
    }
}

/*try {
    $db = Database::connect();

    // Ejemplo de inserción
    $sqlInsert = "INSERT INTO cita (motivo, fecha, hora, cel, nom_cli) VALUES (:motivo, :fecha, :hora, :celular, :nom_cli)";
	$stmtInsert = $db->prepare($sqlInsert);

	// Variables a insertar
	$motivo = 'bye';
	$fecha = '2035-12-31'; // Fecha en formato 'YYYY-MM-DD'
	$hora = '11:30:00'; // Hora en formato 'HH:MM:SS'
	$celular = '75896458'; // Celular como cadena de caracteres
	// Consulta para obtener el nombre del cliente
	$querySelect = "SELECT NOMBRE FROM PERSONA WHERE CELULAR = :celular";
	$stmtSelect = $db->prepare($querySelect);
	$stmtSelect->bindParam(':celular', $celular, PDO::PARAM_STR);
	$stmtSelect->execute();

	// Obtener el resultado de la consulta
	$resultado = $stmtSelect->fetch(PDO::FETCH_ASSOC);
	$nom_cli = $resultado['nombre']; // Asignar el nombre del cliente obtenido de la consulta

	// Asignación de parámetros para la inserción	
	$stmtInsert->bindParam(':motivo', $motivo, PDO::PARAM_STR);
	$stmtInsert->bindParam(':fecha', $fecha, PDO::PARAM_STR);
	$stmtInsert->bindParam(':hora', $hora, PDO::PARAM_STR);
	$stmtInsert->bindParam(':celular', $celular, PDO::PARAM_STR);
	$stmtInsert->bindParam(':nom_cli', $nom_cli, PDO::PARAM_STR);

	// Ejecutar la consulta preparada
	$stmtInsert->execute();

    // Ejemplo de consulta SELECT para mostrar resultados
    $querySelect = "SELECT * FROM cita";
    $stmtSelect = $db->query($querySelect);

    // Mostrar los resultados en una tabla HTML
    echo "<table border='1'>
            <tr><th>COD</th><th>MOTIVO</th><th>FECHA</th><th>HORA</th><th>CELULAR</th><th>NOMBRE CLIENTE</th></tr>";
    while ($row = $stmtSelect->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>{$row['cod']}</td><td>{$row['motivo']}</td><td>{$row['fecha']}</td><td>{$row['hora']}</td><td>{$row['cel']}</td><td>{$row['nom_cli']}</td></tr>";
    }
    echo "</table>";
    echo "Conexión exitosa";

    // Desconectar de la base de datos
    Database::disconnect();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}*/
?>