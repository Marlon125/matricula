<?php

// ********************** MODULO SEMESTRE MATERIA **********************

session_start();
require_once('../../servicios/evitarInyeccionSQL.php');
require_once('constantes.php');
require_once('vista.php');
require_once('modelo.php');

controlador();

function controlador() {
    $evento = '';
    $url = $_SERVER['REQUEST_URI'];

    $peticiones = array(vADMINISTRACION, INSERTAR, vEDICION, EDITAR, vELIMINACION, 
        ELIMINAR);

    foreach ($peticiones as $peticion) {
        $url_peticion = MODULO . $peticion;
        if (strpos($url, $url_peticion) == true) {
            $evento = $peticion;
        }
    }

    $semestremateriaOBJ = new SemestreMateria();
    $datos = getDatos();

    switch ($evento) {
        case vADMINISTRACION:
            $semestremateriaOBJ->getSemestreMaterias();
            setSemestreMaterias($semestremateriaOBJ->registros);

            $semestremateriaOBJ->getMaterias();
            setMaterias($semestremateriaOBJ->registros);

            $semestremateriaOBJ->getSemestres();
            setSemestres($semestremateriaOBJ->registros);

            $semestremateriaOBJ->getCreditos();
            setCreditos($semestremateriaOBJ->registros);

            if (array_key_exists('msg', $datos)) {
                $datos['mensaje'] = getMensaje($datos['msg']);
            } else {
                $datos['mensaje'] = '';
            }
            verVista($evento, $datos);
            break;
        case INSERTAR:
            $msg = $semestremateriaOBJ->insertar($datos);
            header("location: administracion?msg=$msg");
            break;
        case vEDICION:
            $info = array();
            if (array_key_exists('idprograma', $datos)) {
                $filtro = "WHERE programa.idprograma = " . $datos['idprograma'] . " LIMIT 1";
                if ($semestremateriaOBJ->getProgramas($filtro)) {
                    $info = $semestremateriaOBJ->registros[0];
                    $info['error'] = 0;
                } else {
                    $info['error'] = 1;
                }
            } else {
                $info['error'] = 1;
            }
            echo json_encode($info);
            break;
        case EDITAR:
            if (array_key_exists('idprograma', $datos)) {
                $msg = $semestremateriaOBJ->editar($datos);
                header("location: administracion?msg=$msg");
            } else {
                header("location: administracion?msg=0");
            }
            break;
        case vELIMINACION:
            $info = array();
            if (array_key_exists('idprograma', $datos)) {
                $filtro = "WHERE materia.idprograma = " . $datos['idprograma'] . " LIMIT 1";
                if ($semestremateriaOBJ->getProgramas($filtro)) {
                    $info = $semestremateriaOBJ->registros[0];
                    $info['error'] = 0;
                } else {
                    $info['error'] = 1;
                }
            } else {
                $info['error'] = 1;
            }
            echo json_encode($info);
            break;
        case ELIMINAR:
            if (array_key_exists('idprograma', $datos)) {
                $msg = $semestremateriaOBJ->eliminar($datos);
                header("location: administracion?msg=$msg");
            } else {
                header("location: administracion?msg=0");
            }
            break;
    }
}

function getMensaje($msg = 0) {
    $mensaje = "<script>
                    $(document).ready(function(){
                      setTimeout(function(){ $('.alert').fadeOut(1000).fadeIn(1000).fadeOut(700).fadeIn(700).fadeOut(1000);}, 5000); 
                    });
                </script>";
    switch ($msg) {
        case 0:
            $mensaje .= '<div class="alert alert-warning" align="center">
                        <strong>
                            La operacion solicitada <b>NO</b> fue realizada. -- <b>[ ERROR ]</b><br>
                            Comuniquese con el Administrador del Sistema.                           
                        </strong>
                        </div>';
            break;
        case 1:
            $mensaje .= '<div class="alert alert-success" align="center">
                        <strong>
                                Se ha ingresado un registro con éxito <i class="glyphicon glyphicon-ok"></i>                          
                        </strong>
                        </div>';
            break;
        case 2:
            $mensaje .= '<div class="alert alert-warning" align="center">
                        <strong>
                                El registro se ha editado con éxito <i class="glyphicon glyphicon-refresh"></i>                          
                        </strong>
                        </div>';
            break;
        case 3:
            $mensaje .= '<div class="alert alert-info" align="center">
                        <strong>
                                El registro se ha eliminado con éxito <i class="glyphicon glyphicon-remove"></i>                           
                        </strong>
                        </div>';
            break;
    }
    return $mensaje;
}

function getDatos() {
    $datos = array();
    if ($_POST) {
        if (array_key_exists('idmateria', $_POST))
            $datos['idmateria'] = $_POST['idmateria'];
        if (array_key_exists('idsemestre', $_POST))
            $datos['idsemestre'] = $_POST['idsemestre'];
        if (array_key_exists('idcredito', $_POST))
            $datos['idcredito'] = $_POST['idcredito'];
        
    } else if ($_GET) {
        if (array_key_exists('msg', $_GET))
            $datos['msg'] = $_GET['msg'];
        if (array_key_exists('idmateria', $_GET))
            $datos['idmateria'] = $_GET['idmateria'];
    }
    return $datos;
}
