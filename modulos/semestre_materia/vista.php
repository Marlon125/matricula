<?php

// ********************** MODULO SEMESTRE MATERIA **********************

$diccionario = array(
    'subtitulo' => array(
        vADMINISTRACION => '',
    ),
);

function render_dinamico_datos($html, $data) {
    foreach ($data as $clave => $valor) {
        $html = str_replace('{' . $clave . '}', $valor, $html);
    }
    return $html;
}

function getPlantilla($form = '') {
    $archivo = '../../' . PUBLICO . $form . '.html';
    $template = file_get_contents($archivo);
    return $template;
}

function verVista($vista = '', $datos = array()) {
    global $diccionario;
    global $tablaSemestreMaterias;
    global $materias;
    global $semestres;
    global $creditos;

    $html = getPlantilla($vista);
    $html = str_replace('{tablaSemestreMaterias}', $tablaSemestreMaterias, $html);
    $html = str_replace('{materias}', $materias, $html);
    $html = str_replace('{semestres}', $semestres, $html);
    $html = str_replace('{creditos}', $creditos, $html);
    $html = render_dinamico_datos($html, $datos);

    print $html;
}

function setSemestreMaterias($datos = array()) {
    global $tablaSemestreMaterias;

    foreach ($datos as $registros) {
        $tablaSemestreMaterias .= '<tr>';
            $tablaSemestreMaterias .= '<td>'.$registros['nombre'].'</td>';
            $tablaSemestreMaterias .= '<td>'.$registros['numero'].'</td>';
            $tablaSemestreMaterias .= '<td>'.$registros['credito'].'</td>';
        $tablaSemestreMaterias .= '</tr>';
    }

}

function setMaterias($datos = array(), $idmateria = ''){
    global $materias;

    $materias .= '<option value="">Seleccion materia ..</option>';
    foreach ($datos as $registros) {
        if($registros['idmateria'] == $idmateria){
            $materias .= '<option value="'.$registros['idmateria'].'" selected>'.$registros['nombre'].'</option>';
        }else{
            $materias .= '<option value="'.$registros['idmateria'].'">'.$registros['nombre'].'</option>';
        }
    }
}

function setSemestres($datos = array(), $idsemestre = ''){
    global $semestres;

    $semestres .= '<option value="">Seleccion semestre ..</option>';
    foreach ($datos as $registros) {
        if($registros['idsemestre'] == $idsemestre){
            $semestres .= '<option value="'.$registros['idsemestre'].'" selected>'.$registros['numero'].'</option>';
        }else{
            $semestres .= '<option value="'.$registros['idsemestre'].'">'.$registros['numero'].'</option>';
        }
    }
}

function setCreditos($datos = array(), $idcredito = ''){
    global $creditos;

    $creditos .= '<option value="">Seleccion numero de creditos ..</option>';
    foreach ($datos as $registros) {
        if($registros['idcredito'] == $idcredito){
            $creditos .= '<option value="'.$registros['idcredito'].'" selected>'.$registros['numero'].'</option>';
        }else{
            $creditos .= '<option value="'.$registros['idcredito'].'">'.$registros['numero'].'</option>';
        }
    }
}
?>
