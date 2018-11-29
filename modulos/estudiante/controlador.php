<?php

// ********************** MODULO ESTUDIANTE **********************

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

    $estudianteOBJ = new Estudiante();
    $datos = getDatos();

    switch ($evento) {
        case vADMINISTRACION:
            $estudianteOBJ->getEstudiantes();
            setEstudiantes($estudianteOBJ->registros);

            if (array_key_exists('msg', $datos)) {
                $datos['mensaje'] = getMensaje($datos['msg']);
            } else {
                $datos['mensaje'] = '';
            }
            verVista($evento, $datos);
            break;
        case INSERTAR:
            $msg = $estudianteOBJ->insertar($datos);
            header("location: administracion?msg=$msg");
            break;
        case vEDICION:
            $info = array();
            if (array_key_exists('idestudiante', $datos)) {
                $filtro = "WHERE programa.idestudiante = " . $datos['idestudiante'] . " LIMIT 1";
                if ($estudianteOBJ->getEstudiantes($filtro)) {
                    $info = $estudianteOBJ->registros[0];
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
            if (array_key_exists('idestudiante', $datos)) {
                $msg = $estudianteOBJ->editar($datos);
                header("location: administracion?msg=$msg");
            } else {
                header("location: administracion?msg=0");
            }
            break;
        case vELIMINACION:
            $info = array();
            if (array_key_exists('idestudiante', $datos)) {
                $filtro = "WHERE estudiante.idestudiante = " . $datos['idestudiante'] . " LIMIT 1";
                if ($estudianteOBJ->getEstudiantes($filtro)) {
                    $info = $estudianteOBJ->registros[0];
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
            if (array_key_exists('idestudiante', $datos)) {
                $msg = $estudianteOBJ->eliminar($datos);
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
        if (array_key_exists('idestudiante', $_POST))
            $datos['idestudiante'] = $_POST['idestudiante'];
        if (array_key_exists('nombre', $_POST))
            $datos['nombre'] = $_POST['nombre'];
        if (array_key_exists('identificacion', $_POST))
            $datos['identificacion'] = $_POST['identificacion'];
        
    } else if ($_GET) {
        if (array_key_exists('msg', $_GET))
            $datos['msg'] = $_GET['msg'];
        if (array_key_exists('idestudiante', $_GET))
            $datos['idestudiante'] = $_GET['idestudiante'];
    }
    return $datos;
}
