<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PRODUCCIONES PADRINO - RESERVA</title>
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
    <h1 class="mb-5">TABLA RESERVA - GRUPO 9</h1>
    <div class="container text-center mb-5">
      <img src="FICCT.png" alt="FICCT" class="img-fluid mb-4" width="20%" height="20%">
    </div>
	
    <form id="contact-form-bootstrap" action="DRESERVA.php" method="POST" onsubmit="return validarFormulario()" enctype="multipart/form-data">
      <input type="hidden" id="action" name="action" value="insertar">
      <div class="form-group">
        <label for="codigo" class="container text-left">CODIGO:</label>
        <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Ingrese codigo.">
      </div>
      <div class="form-group">
        <label for="fecha" class="container text-left">FECHA:</label>
        <input type="text" class="form-control" id="fecha" name="fecha" placeholder="Ingrese fecha (AÑO-MES-DIA).">
      </div>
      <div class="form-group">
        <label for="celcli" class="container text-left">CELULAR DEL CLIENTE :</label>
        <input type="text" class="form-control" id="celcli" name="celcli" placeholder="Ingrese celular del servicio.">
      </div>
      
      <div class="form-group">
        <label for="action" class="container text-left">ACCION:</label>
        <select class="form-control" id="action" name="action">
          <option value="agregar">agregar</option>
          <option value="modificar">modificar</option>
          <option value="eliminar">eliminar</option>
          <option value="listar">listar</option>
          <option value="ver">ver</option>
        </select>
      </div>

      <div class="text-left mb-3">
        <button type="submit" class="btn btn-primary">OK</button>
      </div>
    </form>

    <!-- BOTONES NORMALES -->
    <div class="container mb-5 text-center">
      <button class="btn btn-danger" type="button" onclick="cambiarColor('#C20000', 'rojo')">Fondo Rojo</button>
      <button class="btn btn-warning text-white" type="button" onclick="cambiarColor('#DADE00','amarillo')">Fondo Amarillo</button>
      <button class="btn btn-primary" type="button" onclick="cambiarColor('#3357FF', 'azul')">Fondo Azul</button>
      <button class="btn btn-info" type="button" onclick="cambiarColor('#BDFFFD', 'original')">ORIGINAL</button>
      <button class="btn btn-white" type="button" onclick="activarFondo()">Activar Fondo con Imagen</button>
    </div>
  </div>

  <div class="container mt-5">
    <h3 class="mb-4">BOTON ATRAS</h3>
    <button type="button" onclick="location.href='ADMI.php'" class="btn btn-primary">ATRAS</button>
  </div>

  <!-- Script para mostrar mensajes de sesión -->
  <script>
    // Verifica si hay un mensaje en sesión
    <?php if (isset($_SESSION['message']) && isset($_SESSION['message_type'])): ?>
      // Muestra el mensaje utilizando JavaScript
      alert('<?php echo $_SESSION['message']; ?>');
      <?php
        // Elimina el mensaje después de mostrarlo
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
      ?>
    <?php endif; ?>

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

    function setAction(action) {
      document.getElementById('action').value = action;
    }

    function validarFormulario() {
      const codigo = document.getElementById('codigo').value.trim();
      const fecha = document.getElementById('fecha').value.trim();
      const celcli = document.getElementById('celcli').value.trim();
      const action = document.getElementById('action').value; // Obtener el valor de acción correctamente

      if (codigo === '') {
          alert('Por favor ingresa código.');
          return false;
      }

      if (fecha === '') {
          alert('Por favor ingresa fecha.');
          return false;
      }

      if (celcli === '') {
          alert('Por favor ingrese celular del cliente.');
          return false;
      }

      // Resto de validaciones y envío del formulario
      return true;
    }
  </script>
</body>
</html>
