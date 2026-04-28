<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Registro de Sismos</title>
</head>

<body>

	<center><form id="lg2" action="ingresar.php" method="POST" >
  		<h1>Ingrese los datos del sismo</h1>
	  <input type="text" name="pro" value="" placeholder="Profundidad" required/><br><br>
	  <input type="text" name="mag" value="" placeholder="Magnitud" required/><br><br>
	  <input type="text" name="lat" value="" placeholder="Latitud" required/><br><br>
	  <input type="text" name="long" value="" placeholder="Longitud" required/><br><br>
	  <input type="text" name="ubc" value="" placeholder="Ubicacion" required/><br><br>
	  <input type="text" name="region" value="" placeholder="Region" required/><br><br>
	  <input type="date" name="fecha" value="" placeholder="Fecha" required/><br><br>
	  <input type="time" name="time" value="" placeholder="time" required/><br><br>
	  <input id="log" type="submit" value="Crear" name="boton"/><br><br>
		</form></center>
</body>
</html>