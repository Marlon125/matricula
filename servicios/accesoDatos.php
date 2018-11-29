    <?php

    abstract class AccesoDatos {

        private static $bd_host = 'localhost';
        private static $bd_usuario = 'root';
        private static $bd_clave = '';
        private static $bd_nombre = 'dbmatricula';
        private $conn;
        protected $consulta;
        public $registros = array();
        public $ultimo_id = '000';
        public $mensaje = '';

        /**
         * Obtiene la informacion de todos los nodos registrados en el sistema, 
         * vincula el nodo con departamento y el municipio.
         *
         * @return boolean true: si encuentra registros, en caso contrario false.
         * @param string $limirInf limite inferior de la consulta SQL.
         * @param string $limirSup limite superior de la consulta SQL.
         */
        private function conectar($nombreBD = '') {
            if ($nombreBD == ''){
                $this->conn = new mysqli(self::$bd_host, self::$bd_usuario, self::$bd_clave, self::$bd_nombre);
            }else{
                $this->conn = new mysqli(self::$bd_host, self::$bd_usuario, self::$bd_clave, $nombreBD);
                
            }
        }

        /**
         * Obtiene la informacion de todos los nodos registrados en el sistema, 
         * vincula el nodo con departamento y el municipio.
         *
         * @return boolean true: si encuentra registros, en caso contrario false.
         * @param string $limirInf limite inferior de la consulta SQL.
         * @param string $limirSup limite superior de la consulta SQL.
         */
        private function desconectar() {
            $this->conn->close();
        }

        /**
         * Obtiene la informacion de todos los nodos registrados en el sistema, 
         * vincula el nodo con departamento y el municipio.
         *
         * @return boolean true: si encuentra registros, en caso contrario false.
         * @param string $limirInf limite inferior de la consulta SQL.
         * @param string $limirSup limite superior de la consulta SQL.
         */
        protected function ejecutarBD() {
            $this->conectar();
            $this->conn->query("SET NAMES 'utf8'");
            $OK = $this->conn->query($this->consulta);
            if (strpos($this->consulta, 'INSERT') !== false) {
                $this->ultimo_id = $this->conn->insert_id;
            }
            $this->desconectar();
            return $OK;
        }

        /**
         * Obtiene la informacion de todos los nodos registrados en el sistema, 
         * vincula el nodo con departamento y el municipio.
         *
         * @return boolean true: si encuentra registros, en caso contrario false.
         * @param string $limirInf limite inferior de la consulta SQL.
         * @param string $limirSup limite superior de la consulta SQL.
         */
        protected function consultarBD($nombreBD = '') {
            $this->conectar($nombreBD);
            $this->conn->query("SET NAMES 'utf8'");
            $this->registros = array();
            $resultado = $this->conn->query($this->consulta);
            while ($this->registros[] = $resultado->fetch_assoc());
            $resultado->close();
            $this->desconectar();
            array_pop($this->registros);
            return count($this->registros);
        }

        protected function ejecutarTransaccion($consultas = array(), $nombreBD = '') {
            $error = 0;
            $this->conectar($nombreBD);
            $this->conn->autocommit(false);
            foreach ($consultas as $consult) {
                $consult = str_replace('{ultimoID}', $this->ultimo_id, $consult);
                if ($this->conn->query($consult)) {
                    if (strpos($consult, 'INSERT') !== false) {
                        if (strpos($consult, 'INSERT INTO internet') === false) {
                            $this->ultimo_id = $this->conn->insert_id;
                        }
                    }
                } else {
                    $error = 1;
                }
                $this->mensaje .= $consult . '<br><br>';
            }

    //        echo $this->mensaje;return;

            if ($error == 0) {
                $this->conn->commit();
                return true;
            } else {
                $this->conn->rollback();
                return false;
            }
        }

    }
