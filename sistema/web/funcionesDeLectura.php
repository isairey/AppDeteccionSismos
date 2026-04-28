<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function leerArchivo($ruta){
	$archivoUsuarios = fopen($ruta,"r");
	$usuarios = array();
        $arrayRetorno = array();
	$linea = fgets($archivoUsuarios);
	while ($linea != ""){
		$claves = explode(";", $linea);
                $ciudad = new Ciudad($claves[0], $claves[1], $claves[2], $claves[3], $claves[4], $claves[5],$claves[6]);
		array_push($arrayRetorno, $ciudad);
                $linea = fgets($archivoUsuarios);
        }
	fclose($archivoUsuarios);
	return($arrayRetorno);
}

?>

