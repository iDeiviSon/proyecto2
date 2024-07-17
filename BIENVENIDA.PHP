<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PRODPAD GRUPO 9</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body >
<style>
    body {
		background-color: #BDFFFD;
        transition: background-color 0.5s, background-image 0.5s;
    }
  </style>
	  <div class="container text-center mt-5">
	  <h1 class="mb-1" style="font-family: 'arial', sans-serif; font-size: 20px; font-weight: bold; color: #6C0101;">Hola, un saludo de:</h1> 
	  <h1 class="mb-1" style="font-family: 'arial', sans-serif; font-size: 50px; font-weight: bold; color: #6C0101;">PRODUCCIONES PADRINO</h1>
	  <h1 class="mb-5" style="font-family: 'arial', sans-serif; font-size: 30px; font-weight: thin; color: #6C0101;"> GRUPO 9</h1>
	  <div class="container text-center mb-5">
  	<!--	<img src="FICCT.png" alt="FICCT" class="img-fluid mb-4" width="20%" height="20%> -->
  	</div>

  	<!-- BOTONES NORMALES-->
		<div class="container mb-5 text-center">
		    	<button class="btn btn-danger" onclick="cambiarColor('#C20000')">Fondo Rojo</button>
	    		<button class="btn btn-warning text-white" onclick="cambiarColor('#DADE00')">Fondo Amarillo</button>
				<button class="btn btn-primary" onclick="cambiarColor('#3357FF')">Fondo Azul</button>
	    		<button class="btn btn-info" onclick="cambiarColor('#BDFFFD')">ORIGINAL</button>
			<button class="btn btn-white" onclick="activarFondo()">Activar Fondo con Imagen</button>
		</div>
	
		<div class="container mb-5 text-center">			
    		<button type="button" onclick="irALogin()" class="btn btn-primary">INICIAR</button>			
    		<button type="button" onclick="window.location.href='https://www.google.com'" class="btn btn-danger" >ATRAS</button>	    	
		</div>
	
  <!-- Agrega los scripts de BootStrap y el script de validación -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
  <script>
    $(document).ready(function () {	$('#contact-form').validate();	});
  </script>

<script>
    function irALogin() {
        // Obtener el color actual del fondo
        var colorFondo = document.body.style.backgroundColor;
        
        // Redirigir a LOGIN.html con el color como parámetro en la URL
        window.location.href = 'LOGIN.php?color=' + encodeURIComponent(colorFondo);
    }
</script>


<script>
        function cambiarColor(color) {
            document.body.style.backgroundImage = "none";
            var titles = document.querySelectorAll('h1');

            if (color === '#BDFFFD') {
                document.body.style.backgroundColor = "#BDFFFD"; 
                titles.forEach(function(title) {
                    title.classList.remove('text-white', 'text-dark'); 
                    title.style.color = '#6C0101'; 
                    title.classList.add('custom-font'); 
                });
            } else {
                document.body.style.backgroundColor = color;

                titles.forEach(function(title) {
                    title.classList.remove('text-white', 'text-dark'); 
                    title.classList.add('text-white'); 
                    title.classList.add('custom-font'); 

                    if (color === '#DADE00') {
                        title.classList.remove('text-white');
                        title.classList.add('text-dark'); 
                    }
                });
            }

            var labels = document.querySelectorAll('label');
            labels.forEach(function(label) {
                label.classList.remove('text-white');
                label.classList.add('text-dark');
            });
        }
    </script>
		
	<script>
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
			  var titles = document.querySelectorAll('h1');
            for (var i = 0; i < 3; i++) {
                if (titles[i]) {
                    titles[i].classList.remove('text-dark');
                    titles[i].classList.add('text-white');
                    titles[i].classList.add('custom-font');
                }
            }}
 	</script>

</body>

</html>