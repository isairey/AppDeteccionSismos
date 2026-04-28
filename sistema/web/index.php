<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
        include "Ciudad.php";
		include ("Region.php");
		include ("funcionesDeLectura.php");
		include ("Ecuador.php");
		$ciudad = new Ciudad("1","2","3","4","5","6","7");
		echo($ciudad->getLatitud());
        $array = leerArchivo("dataAccess/markers.txt");
		echo("<br>". $array[1]->getLatitud());
		echo("<br>");
		$ecuador = new Ecuador($array);
		$ecuador->crearEstadisticas();
		echo("<br>");
		echo($ecuador->getSismos()[2]->getLatitud());
		echo("<br>");
		echo($ecuador->sacarPromedio());
		$costa = $ecuador->crearRegion("costa");
		$costa->crearMapa();
		$costa->crearEstadisticas();
		echo ("<br>");
		echo ($costa->contarSismos());
		echo($costa->sacarPromedio());
		echo ("<br>");
		echo ($costa->contarSismos());
		echo ("<br>");
		echo($costa->maxSismo());
		echo ("<br>");
		echo($costa->minSismo());
		echo ("<br>");
		echo ("<br>");
		echo ("<br>");
		echo ("<br>");
		$costa = $ecuador->crearRegion("sierra");
		$costa->crearMapa();
		$costa->crearEstadisticas();
		echo ("<br>");
		echo($costa->sacarPromedio());
		$costa = $ecuador->crearRegion("amazonia");
		$costa->crearMapa();
		$costa->crearEstadisticas();
		echo ("<br>");
		echo($costa->sacarPromedio());
		echo($costa->getListaCiudades()[1]->toString());
		$ecuador->crearMapa();
        ?>
    </body>
</html>
