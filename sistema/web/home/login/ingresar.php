<?php
$fecha = $_POST['fecha'];
$mag = $_POST['mag'];
$lat = $_POST['lat'];
$long = $_POST['long'];
$pro = $_POST['pro'];
$ub = $_POST['ubc'];
$reg = $_POST['region'];
$time = $_POST['time'];
			
$file = fopen("../../dataAccess/markers.txt", "a");
fwrite($file, PHP_EOL);
fwrite($file,"$lat;$long;$mag;$pro;$ub;$reg;$fecha". " "."$time;");
fclose($file);
header('Location: registro.php');



?>