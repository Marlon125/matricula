<?php

// ********************** MODULO MATRICULA **********************

require_once('../../servicios/accesoDatos.php');

date_default_timezone_set('America/Bogota');

class Matricula extends AccesoDatos {

    public function getProgramas($filtro = '') {
        $this->consulta = "SELECT programa.idprograma,
                                  programa.nombre
                                  FROM programa";
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
        $consultas[] = "INSERT INTO programa (nombre)
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
        $consultas[] = "UPDATE programa SET 
                               nombre = '$nombre'
                               
                                 WHERE idprograma = $idprograma";

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
        $consultas[] = "DELETE FROM programa WHERE idprograma = $idprograma";

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
