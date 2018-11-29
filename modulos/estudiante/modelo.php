<?php

// ********************** MODULO ESTUDIANTE **********************

require_once('../../servicios/accesoDatos.php');

date_default_timezone_set('America/Bogota');

class Estudiante extends AccesoDatos {

    public function getEstudiantes($filtro = '') {
        $this->consulta = "SELECT estudiante.idestudiante,
                                  estudiante.nombre,
                                  estudiante.identificacion
                                  FROM estudiante";
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
        $consultas[] = "INSERT INTO estudiante (nombre,identificacion)
                                VALUES('$nombre', '$identificacion')";
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
        $consultas[] = "UPDATE estudiante SET 
                               nombre = '$nombre',
                               identificacion = '$identificacion',
                                 WHERE idestudiante = $idestudiante";

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
        $consultas[] = "DELETE FROM estudiante WHERE idestudiante = $idestudiante";

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
