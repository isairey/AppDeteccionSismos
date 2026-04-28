<!DOCTYPE html >
<html>
<head>
	<title>Formulario</title>
	<link rel="stylesheet" href="estilo.css">
</head>
<body>
	<?php
		function txt(){
			$nombre = $_POST['nombre'];
			$descrip = $_POST['descripcion'];
			$lat = $_POST['lat'];
			$long = $_POST['long'];
			
			$file = fopen("eventos.txt", "a");
			fwrite($file, "$nombre,$descrip,$lat,$long" . PHP_EOL);
			fclose($file);
			//header('Location: maps.php');
		}

		if(isset($_POST['boton'])){
		   txt();
		}
	?>
	<h1>Formulario</h1>
	<form class="form" action="" method="POST">
	  <input class="input" type="text" name="nombre" value="" placeholder="Evento"/><br><br>
	  <input type="text" name="descripcion" value="" placeholder="Descripcion"/><br><br>
	  <input type="text" name="lat" value="" placeholder="Latitud"/><br><br>
	  <input type="text" name="long" value="" placeholder="Longitud"/><br><br><br>
	  <input class="boton" type="submit" value="Crear" name="boton"/>
	</form>
	
</body>
</html>
