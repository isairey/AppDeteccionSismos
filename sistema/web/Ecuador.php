<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Ecuador {
    private $sismos = array();
	private $totalSis = 0.0;
    
    function __construct($sismos) {
        $this->sismos = $sismos;
    }
    
    function getSismos() {
        return $this->sismos;
    }
    
    public function sacarPromedio(){
            for ($i=0;$i < count($this->sismos);$i++){
                $tmp = $this->sismos[$i];
                $this->totalSis += $tmp->getMagnitud();
            }
            return number_format($this->totalSis / count($this->sismos),2);
    }
    
    private function construirR($region){
        $aRetorno = array();
        for($i=0;$i < count($this->sismos);$i++){
            $ciudad = $this->sismos[$i];
            if ($ciudad->getRegion() == $region){
                array_push($aRetorno, $ciudad);
            }
        }
        return new Region($aRetorno, $region);
    }


    public function crearRegion($param) {
        if ($param == "costa"){
            return $this->construirR("costa");
        }
        elseif ($param == "sierra") {
            return $this->construirR("sierra");   
        }
        else {
            return $this->construirR("amazonia");
       }     
    }
	
	public function crearMapa($ruta){
		$file = fopen($ruta, "w");
		for ($i=0;$i < count($this->sismos); $i++){
			$nombre = "Sismo #".$i;
			$descrip = $this->sismos[$i]->toString();
			$lat = $this->sismos[$i]->getLatitud();
			$long = $this->sismos[$i]->getLongitud();
			fwrite($file, "$nombre;$descrip;$lat;$long" . PHP_EOL);
		}
		fclose($file);
	}
	
	public function crearEstadisticas($ruta){
		$file = fopen($ruta,"w");
		for ($i=0;$i < count($this->sismos); $i++){
			fwrite($file,$this->sismos[$i]->getMagnitud().",");
		}
		fclose($file);
	}
	
	public function contarSismos(){
		return(count($this->sismos));
	}
	
	public function maxSismo(){
		$retorno = array();
		for ($i=0;$i < count($this->sismos);$i++){
			array_push($retorno,$this->sismos[$i]->getMagnitud());
		}
		return(max($retorno));
	}
	
	public function minSismo(){
		$retorno = array();
		for ($i=0;$i < count($this->sismos);$i++){
			array_push($retorno,$this->sismos[$i]->getMagnitud());
		}
		return(min($retorno));
	}



}
?>