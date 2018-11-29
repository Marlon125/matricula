<?php

// ********************** MODULO SEMESTRE **********************

require_once('../../servicios/accesoDatos.php');

date_default_timezone_set('America/Bogota');

class Semestre extends AccesoDatos {

    public function getSemestres($filtro = '') {
        $this->consulta = "SELECT semestre.idsemestre,
                                  semestre.numero
                                  FROM semestre";
        if ($filtro != '') {
            $this->consulta .= " $filtro";
        }
        if ($this->consultarBD() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insertar($datos = array()) {
        foreach ($datos as $campo => $vlr) {
            $$campo = $vlr;
        }

        $consultas = array();
        $consultas[] = "INSERT INTO semestre (numero)
                                VALUES($numero)";
    /*foreach ($consultas as $value) {
      echo "<br> $value <br>";
    }return;*/

    if($this->ejecutarTransaccion($consultas)){
      return 1;
    }else{
      return 0;
    }
        
    }
    
    public function editar($datos = array()){
        foreach ($datos as $campo => $vlr) {
            $$campo = $vlr;
        }
        $consultas = array();
        $consultas[] = "UPDATE semestre SET 
                               numero = '$numero'
                               
                                 WHERE idsemestre = $idsemestre";

//        foreach ($consultas as $value) {
//            echo "<br> $value <br>";
//        }return;

        if ($this->ejecutarTransaccion($consultas)) {
            return 2;
        } else {
            return 0;
        }
    }

    public function eliminar($datos = array()){
        foreach ($datos as $campo => $vlr) {
            $$campo = $vlr;
        }
        $consultas = array();
        $consultas[] = "DELETE FROM semestre WHERE idsemestre = $idsemestre";

        /*foreach ($consultas as $value) {
            echo "<br> $value <br>";
        }return;*/

        if ($this->ejecutarTransaccion($consultas)) {
            return 3;
        } else {
            return 0;
        }
    }

}
