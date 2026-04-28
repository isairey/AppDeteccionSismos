<html>
<head>
<?php
	include "../../Ciudad.php";
	include ("../../Region.php");
	include ("../../funcionesDeLectura.php");
	include ("../../Ecuador.php");
	$array = leerArchivo("../../dataAccess/markers.txt");
	$ecuador = new Ecuador($array);
	$ecuador->crearEstadisticas("../../dataAccess/datosEcuador.txt");
	$ecuador->crearMapa("../../dataAccess/eventos.txt");
?>
<meta charset="utf-8">
<title>Prueba</title>
<link rel="stylesheet" type="text/css" href="../css/styleP.css" />
</head>

<body>
<div id="container">
<div class="divisiones" id="boton">

<center><h1 id="tagEstadisticas"> Sismos Reportados en Ecuador. </h1></center>
	<?php  include("../../mapa/mapsEcuador.php");
	
		
	?>
	</div>
<div class="divisiones">
<table width="98%" id="estadisticas">
  <tbody>
    <tr>
		<td><center>Sismos reportados</center></td>
      <td><center>Promedio de sismos</center></td>
      <td><center>Mayor magnitud</center></td>
      <td><center>Menor magnitud</center></td>
    </tr>
    <tr>
      <td><?php echo("<center>". $ecuador->contarSismos() ."</center>");  ?></td>
      <td><?php echo("<center>". $ecuador->sacarPromedio() ."</center>");  ?></td>
      <td><?php echo("<center>". $ecuador->maxSismo() ."</center>");  ?></td>
      <td><?php echo("<center>". $ecuador->minSismo() ."</center>");  ?></td>
    </tr>
  </tbody>
</table>

	</div>
<div class="divisiones">
<div id="estadisticasImg" >
	<center><h1 id="tagEstadisticas"> Grafico estadistico del país. </h1></center>
	<center><img src="../../esta/indexEcuador.php" alt="" border="0" id="grafica"></center>

	</div>
	</div>
</div>


</body>
</html>
