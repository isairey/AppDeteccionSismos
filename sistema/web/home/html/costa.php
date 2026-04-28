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
	$costa = $ecuador->crearRegion("costa");
	$costa->crearMapa();
	$costa->crearEstadisticas();

?>
<meta charset="utf-8">
<title>Prueba</title>
<link rel="stylesheet" type="text/css" href="../css/styleP.css" />
</head>

<body>
<div id="container">
<div class="divisiones" id="boton">

<center><h1 id="tagEstadisticas"> Sismos Reportados en la costa Ecuatoriana. </h1></center>
	<?php  include("../../mapa/mapsCosta.php");
	
		
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
      <td><?php echo("<center>". $costa->contarSismos() ."</center>");  ?></td>
      <td><?php echo("<center>". $costa->sacarPromedio() ."</center>");  ?></td>
      <td><?php echo("<center>". $costa->maxSismo() ."</center>");  ?></td>
      <td><?php echo("<center>". $costa->minSismo() ."</center>");  ?></td>
    </tr>
  </tbody>
</table>

	</div>
<div class="divisiones">
<div id="estadisticasImg" >
	<center><h1 id="tagEstadisticas"> Grafico estadistico de la región. </h1></center>
	<center><img src="../../esta/indexCosta.php" alt="" border="0" id="grafica"></center>

	</div>
	</div>
</div>


</body>
</html>
