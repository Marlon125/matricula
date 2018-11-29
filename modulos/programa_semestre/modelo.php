<?php

// ********************** MODULO PROGRAMA SEMESTRE **********************

require_once('../../servicios/accesoDatos.php');

date_default_timezone_set('America/Bogota');

class ProgramaSemestre extends AccesoDatos {

    public function getProgramaSemestres($filtro = '') {
        $this->consulta = "SELECT programa.idprograma,
                                  programa.nombre,
                                  semestre.idsemestre,
                                  semestre.numero
                                  FROM programa_semestre
                                  INNER JOIN programa ON programa.idprograma = programa_semestre.idprograma
                                  INNER JOIN semestre ON semestre.idsemestre = programa_semestre.idsemestre";
        if ($filtro != '') {
            $this->consulta .= " $filtro";
        }
        // echo"$this->consulta";
        if ($this->consultarBD() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getProgramas(){
        $this->consulta = "SELECT programa.idprograma,
                                     programa.nombre
                                     FROM programa";
        
        if($this->consultarBD() > 0){
          return true;
        }else{
          return false;
        }
      }

      public function getSemestres(){
        $this->consulta = "SELECT semestre.idsemestre,
                                     semestre.numero
                                     FROM semestre";
        
        if($this->consultarBD() > 0){
          return true;
        }else{
          return false;
        }
      }

    public function insertar($datos = array()) {
        foreach ($datos as $campo => $vlr) {
            $$campo = $vlr;
        }

        $consultas = array();
        $consultas[] = "INSERT INTO programa_semestre (idprograma, idsemestre)
                                VALUES($idprograma, $idsemestre)";
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
