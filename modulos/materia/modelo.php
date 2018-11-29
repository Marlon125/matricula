<?php

// ********************** MODULO MATERIA **********************

require_once('../../servicios/accesoDatos.php');

date_default_timezone_set('America/Bogota');

class Materia extends AccesoDatos {

    public function getMaterias($filtro = '') {
        $this->consulta = "SELECT materia.idmateria,
                                  materia.nombre
                                  FROM materia";
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
        $consultas[] = "INSERT INTO materia (nombre)
                                VALUES('$nombre')";
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
        $consultas[] = "UPDATE materia SET 
                               nombre = '$nombre'
                               
                                 WHERE idmateria = $idmateria";

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
        $consultas[] = "DELETE FROM materia WHERE idmateria = $idmateria";

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
