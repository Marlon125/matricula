<?php

// ********************** MODULO CREDITOS **********************

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
    global $tablaCreditos;
    global $unidadMedida;
    global $estados;

    $html = getPlantilla($vista);
    $html = str_replace('{tablaCreditos}', $tablaCreditos, $html);
    $html = render_dinamico_datos($html, $datos);

    print $html;
}

function setCreditos($datos = array()) {
    global $tablaCreditos;

    foreach ($datos as $registros) {
        $tablaCreditos .= '<tr>';
            $tablaCreditos .= '<td>'.$registros['idcredito'].'</td>';
            $tablaCreditos .= '<td>'.$registros['numero'].'</td>';
        $tablaCreditos .= '</tr>';
    }

}
?>
