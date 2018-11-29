<?php

// ********************** MODULO CREDITOS **********************

require_once('../../servicios/accesoDatos.php');

date_default_timezone_set('America/Bogota');

class Creditos extends AccesoDatos {

    public function getCreditos($filtro = '') {
        $this->consulta = "SELECT credito.idcredito,
                                  credito.numero
                                  FROM credito";
        if ($filtro != '') {
            $this->consulta .= " $filtro";
            echo"consulta $this->consulta";
        }
        // echo"consulta $this->consulta";
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
        $consultas[] = "INSERT INTO credito (numero)
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
        $consultas[] = "UPDATE credito SET 
                               numero = '$numero'
                               
                                 WHERE idcredito = $idcredito";

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
        $consultas[] = "DELETE FROM credito WHERE idcredito = $idcredito";

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
