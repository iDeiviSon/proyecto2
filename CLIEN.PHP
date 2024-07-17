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
        background-color: #BDFFFD; /* Color por defecto si no se encuentra el parámetro color */
        transition: background-color 0.5s, background-image 0.5s;
    }
</style>

<div class="container text-center mt-5">
    <h1 class="mb-5">PRODUCCIONES PADRINO - GRUPO 9</h1>
    <div class="container text-center mb-5">
        <!-- <img src="FICCT.png" alt="FICCT" class="img-fluid mb-4" width="20%" height="20%"> -->
    </div>

    <!-- Contenido de la página CLIEN.php -->
    <div class="container text-center mt-5">
        <h1 class="mb-5">PAGO POR QR</h1>
        <div class="container text-center mb-5">
            <img src="QR.png" alt="FICCT" class="img-fluid mb-4" width="20%" height="20%">
        </div>
    </div>
</div>

<div class="container mt-5">
    <button type="button" onclick="location.href='LOGIN.php'" class="btn btn-primary">ATRAS</button>
    <h3 class="mb-5"></h3>
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
</script>

</body>
</html>
