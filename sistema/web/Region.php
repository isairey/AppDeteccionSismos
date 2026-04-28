<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Region{
	private $listaCiudades = array();
    private $totalSis = 0.0;
	private $nombre;
        
    public function __construct($listaCiudadesP, $nombre) {
            $this->listaCiudades = $listaCiudadesP;
		$this->nombre = $nombre;
        }

	public function addCiudad($ciudad) {
		array_push($this->listaCiudades,$ciudad);
	}
		
	function getListaCiudades() {
            return $this->listaCiudades;
        }

        		
	function sacarPromedio(){
            for ($i=0;$i < count($this->listaCiudades);$i++){
                $tmp = $this->listaCiudades[$i];
                $this->totalSis += $tmp->getMagnitud();
            }
        return number_format($this->totalSis / count($this->listaCiudades),2);
    }
	
	public function crearMapa(){
		$name = "../../dataAccess/".$this->nombre.".txt";
		$file = fopen($name, "w");
		for ($i=0;$i < count($this->listaCiudades); $i++){
			$nombre = "Sismo #".$i;
			$descrip = $this->listaCiudades[$i]->toString();
			$lat = $this->listaCiudades[$i]->getLatitud();
			$long = $this->listaCiudades[$i]->getLongitud();
			fwrite($file, "$nombre;$descrip;$lat;$long" . PHP_EOL);
		}
		fclose($file);
	}
	
	public function crearEstadisticas(){
		$name = "../../dataAccess/datos".$this->nombre.".txt";
		$file = fopen($name,"w");
		for ($i=0;$i < count($this->listaCiudades); $i++){
			fwrite($file,$this->listaCiudades[$i]->getMagnitud().",");
		}
		fclose($file);
	}
	
	public function contarSismos(){
		return(count($this->listaCiudades));
	}
	
	public function maxSismo(){
		$retorno = array();
		for ($i=0;$i < count($this->listaCiudades);$i++){
			array_push($retorno,$this->listaCiudades[$i]->getMagnitud());
		}
		return(max($retorno));
	}
	
	public function minSismo(){
		$retorno = array();
		for ($i=0;$i < count($this->listaCiudades);$i++){
			array_push($retorno,$this->listaCiudades[$i]->getMagnitud());
		}
		return(min($retorno));
	}
	
        
}

?>


