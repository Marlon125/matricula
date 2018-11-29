<?php

// ********************** MODULO PROGRAMA SEMESTRE **********************

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
    global $tablaProgramaSemestres;
    global $programas;
    global $semestres;

    $html = getPlantilla($vista);
    $html = str_replace('{tablaProgramaSemestres}', $tablaProgramaSemestres, $html);
    $html = str_replace('{programas}', $programas, $html);
    $html = str_replace('{semestres}', $semestres, $html);
    $html = render_dinamico_datos($html, $datos);

    print $html;
}

function setProgramaSemestres($datos = array()) {
    global $tablaProgramaSemestres;

    foreach ($datos as $registros) {
        $tablaProgramaSemestres .= '<tr>';
            $tablaProgramaSemestres .= '<td>'.$registros['nombre'].'</td>';
            $tablaProgramaSemestres .= '<td>'.$registros['numero'].'</td>';
        $tablaProgramaSemestres .= '</tr>';
    }

}

function setProgramas($datos = array(), $idprograma = ''){
    global $programas;

    $programas .= '<option value="">Seleccion programa ..</option>';
    foreach ($datos as $registros) {
        if($registros['idprograma'] == $idprograma){
            $programas .= '<option value="'.$registros['idprograma'].'" selected>'.$registros['nombre'].'</option>';
        }else{
            $programas .= '<option value="'.$registros['idprograma'].'">'.$registros['nombre'].'</option>';
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
?>
