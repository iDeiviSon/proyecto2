<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PRODPAD GRUPO 9</title>

  <!-- Agrega los estilos CSS "BOOTSTRAP" -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
<style>
    body {
		background-color: #BDFFFD;
        transition: background-color 0.5s, background-image 0.5s;
    }
</style>

<div class="container text-center mt-5">
  <h1 class="mb-5">PRODUCCIONES PADRINO - GRUPO 9</h1>
  <div class="container text-center mb-5">
    <!-- <img src="FICCT.png" alt="FICCT" class="img-fluid mb-4" width="20%" height="20%> -->
  </div>

  <!-- BOTONES NORMALES CASOS DE USO-->
  <div class="container mb-5 text-center">
    <button class="btn btn-danger" onclick="location.href='FORM_CITA.PHP'">CITA</button>
    <button class="btn btn-warning text-white" onclick="location.href='FORM_COMPRA.PHP'">COMPRA</button>
    <button class="btn btn-primary" onclick="location.href='FORM_DETALLE.PHP'">DETALLE</button>
    <button class="btn btn-info" onclick="location.href='FORM_METODOPAGO.PHP'">METODO DE PAGO</button>
    <button class="btn btn-white" onclick="location.href='FORM_PAGO.PHP'">PAGO</button>
    <button class="btn btn-danger" onclick="location.href='FORM_PERSONA.PHP'">PERSONA</button>
    <button class="btn btn-warning text-white" onclick="location.href='FORM_RESERVA.PHP'">RESERVA</button>
    <button class="btn btn-primary" onclick="location.href='FORM_SERVICIO.PHP'">SERVICIO</button>
    <button class="btn btn-info" onclick="location.href='FORM_USUARIOS.PHP'">USUARIOS</button>
  </div>

</div>
<h3 class="mt-5"></h3>

<!-- BOTONES NORMALES COLOR DE FONDO -->
<div class="container mb-5 text-center">
      <button class="btn btn-danger" type="button" onclick="cambiarColor('#C20000', 'rojo')">Fondo Rojo</button>
      <button class="btn btn-warning text-white" type="button" onclick="cambiarColor('#DADE00','amarillo')">Fondo Amarillo</button>
      <button class="btn btn-primary" type="button" onclick="cambiarColor('#3357FF', 'azul')">Fondo Azul</button>
      <button class="btn btn-info" type="button" onclick="cambiarColor('#BDFFFD', 'original')">ORIGINAL</button>
      <button class="btn btn-white" type="button" onclick="activarFondo()">Activar Fondo con Imagen</button>
    </div>
</div>

<div class="container mt-5">
    <button type="button" onclick="location.href='login.php'" class="btn btn-primary">ATRAS</button>
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

    function cambiarColor(color, nombre) {
    document.body.style.backgroundImage = "none";
    document.body.style.backgroundColor = color;
    var labels = document.querySelectorAll('label');
    var title = document.querySelector('h1');
    var tittle = document.querySelector('h3');
    if (nombre === 'rojo' || nombre === 'azul') {
        labels.forEach(function(label) {
            label.classList.add('text-white');
            label.classList.remove('text-dark');
        });
        title.classList.add('text-white');
        title.classList.remove('text-dark');
        tittle.classList.add('text-white');
        tittle.classList.remove('text-dark');
    } else {
        labels.forEach(function(label) {
            label.classList.add('text-dark');
            label.classList.remove('text-white');
        });
        title.classList.add('text-dark');
        title.classList.remove('text-white');
        tittle.classList.add('text-dark');
        tittle.classList.remove('text-white');
    }
}

function activarFondo() {
      document.body.style.backgroundImage = "url('FondoKVN.jpg')";
      document.body.style.backgroundPosition = "center";
      document.body.style.backgroundRepeat = "no-repeat";
      document.body.style.backgroundSize = "cover";
      document.body.style.backgroundAttachment = "fixed";
      var labels = document.querySelectorAll('label');
      labels.forEach(function(label) {
        label.classList.remove('text-dark');
        label.classList.add('text-white');
      });
      var title = document.querySelector('h1');
      title.classList.remove('text-dark');
      title.classList.add('text-white');
      var title = document.querySelector('h3');
      title.classList.remove('text-dark');
      title.classList.add('text-white');
    }

</script>

</body>
</html>
