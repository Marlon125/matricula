<?php

// ********************** MODULO SEMESTRE MATERIA **********************

require_once('../../servicios/accesoDatos.php');

date_default_timezone_set('America/Bogota');

class SemestreMateria extends AccesoDatos {

    public function getSemestreMaterias($filtro = '') {
        $this->consulta = "SELECT materia.idmateria,
                                  materia.nombre,
                                  semestre.idsemestre,
                                  semestre.numero,
                                  credito.idcredito,
                                  credito.numero as credito
                                  FROM semestre_materia
                                  INNER JOIN materia ON materia.idmateria = semestre_materia.idmateria
                                  INNER JOIN semestre ON semestre.idsemestre = semestre_materia.idsemestre
                                  INNER JOIN credito ON credito.idcredito = semestre_materia.idcredito";
        if ($filtro != '') {
            $this->consulta .= " $filtro";
        }
        if ($this->consultarBD() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getMaterias(){
        $this->consulta = "SELECT materia.idmateria,
                                     materia.nombre
                                     FROM materia";
        
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


      public function getCreditos(){
        $this->consulta = "SELECT credito.idcredito,
                                     credito.numero
                                     FROM credito";
        
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
        $consultas[] = "INSERT INTO semestre_materia (idmateria,idsemestre,idcredito)
                                VALUES($idmateria,$idsemestre,$idcredito)";
    // foreach ($consultas as $value) {
    //   echo "<br> $value <br>";
    // }return;

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
