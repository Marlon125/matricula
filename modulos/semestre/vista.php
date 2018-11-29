<?php

// ********************** MODULO SEMESTRE **********************

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
    global $tablaSemestres;

    $html = getPlantilla($vista);
    $html = str_replace('{tablaSemestres}', $tablaSemestres, $html);
    $html = render_dinamico_datos($html, $datos);

    print $html;
}

function setSemestres($datos = array()) {
    global $tablaSemestres;

    foreach ($datos as $registros) {
        $tablaSemestres .= '<tr>';
            $tablaSemestres .= '<td>'.$registros['idsemestre'].'</td>';
            $tablaSemestres .= '<td>'.$registros['numero'].'</td>';
        $tablaSemestres .= '</tr>';
    }

}
?>
