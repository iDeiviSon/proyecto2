<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PRODUCCIONES PADRINO - LOGIN</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container text-center mt-5">
  <h1 class="mb-1">PRODUCCIONES PADRINO</h1>
  <h3 class="mb-5">Inicio de Sesión</h3>

  <form id="contact-form-bootstrap" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="form-group">
      <label for="user">Usuario:</label>
      <input type="text" class="form-control" id="user" name="user" required>
    </div>
    <div class="form-group">
      <label for="password">Contraseña:</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
  </form>

  <div class="container mt-5">
    <h3 class="mb-4">BOTON ATRAS</h3>
    <button type="button" onclick="location.href='BIENVENIDA.php'" class="btn btn-primary">ATRAS</button>
  </div>


  <?php
  // Procesar el formulario cuando se envíe
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['user'];
    $password = $_POST['password'];

    // Realizar la validación en la base de datos
    require_once('database.php'); // Asegúrate de tener tu archivo de conexión aquí

    try {
      $db = Database::connect(); // Conexión a la base de datos

      // Preparar la consulta SQL para buscar el usuario y contraseña
      $query = "SELECT * FROM users WHERE nombre = :username AND pass = :password";
      $stmt = $db->prepare($query);
      $stmt->bindParam(':username', $username);
      $stmt->bindParam(':password', $password);
      $stmt->execute();

      // Contar el número de filas que coinciden
      $count = $stmt->rowCount();
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($count == 1) {
        // Credenciales válidas
        if ($user['rol'] == 'A') {
          //echo '<script>';
          //echo 'irALogin(\'A\');'; 
          //echo '</script>';
          header("Location: ADMI.php");
          exit(); // Detener la ejecución después de redirigir
        } else if ($user['rol'] == 'C') {
          header("Location: CLIEN.php"); // Redirigir a CLIEN.php si el rol es 'C'
          exit(); // Detener la ejecución después de redirigir
        }
      } else {
        // Credenciales inválidas
        echo '<div class="alert alert-danger mt-3">Credenciales inválidas. Por favor, inténtalo de nuevo.</div>';
      }
    

      Database::disconnect(); // Cerrar la conexión a la base de datos
    } catch (Exception $e) {
      echo "Error: " . $e->getMessage();
    }
  }
  ?>
</div>

<!-- Scripts de Bootstrap y otros -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Script para aplicar el color de fondo -->
<script>
    // Función para obtener parámetros de la URL
    function obtenerParametro(nombre) {
        var urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(nombre);
    }

    document.addEventListener('DOMContentLoaded', function() {
        var colorFondo = obtenerParametro('color');
        if (colorFondo) {
            document.body.style.backgroundImage = "none";
            document.body.style.backgroundColor = colorFondo;
        }
    });

    // Función de redirección con parámetro de color
    function irALogin(tipo) {
        // Obtener el color actual del fondo
        var colorFondo = document.body.style.backgroundColor;

        // Determinar la página a la que redirigir según el tipo
        var pagina = tipo === 'A' ? 'ADMI.php' : 'CLIEN.php';

        // Redirigir con el color como parámetro en la URL
        window.location.href = pagina + '?color=' + encodeURIComponent(colorFondo);
    }
</script>

</body>
</html>
