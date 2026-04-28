<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Ciudad {
    private $longitud;
    private $latitud;
    private $profundidad;
    private $magnitud;
    private $ubicacion;
    private $region;
	private $fecha;
	
        
    public function __construct($latitud, $longitud, $magnitud, $profundidad,  $ubicacion, $region, $fecha) {
        $this->longitud = (double) $longitud;
        $this->latitud = (double) $latitud;
        $this->profundidad = (double) $profundidad;
        $this->magnitud = (double) $magnitud;
        $this->ubicacion = $ubicacion;
        $this->region = $region;
		$this->fecha = $fecha;
    }

    public function getLongitud() {
            return $this->longitud;
        }

        public function getLatitud() {
            return $this->latitud;
        }

        public function getProfundidad() {
            return $this->profundidad;
        }

        public function getMagnitud() {
            return $this->magnitud;
        }

        public function getUbicacion() {
            return $this->ubicacion;
        }
        
        public function getRegion() {
            return $this->region;
        }
	
		public function getFecha()
		{
			return $this->fecha;
		}
        
        public function toString() {
            return "El sismo fue de: ". $this->magnitud ." grados en la escala de Richter en ". $this->ubicacion ." a una profundidad de ". $this->profundidad ." Km. el dia ". $this->fecha;
        }

}

?>


