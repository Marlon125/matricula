<?php

// ********************** MODULO MATERIA **********************

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
    global $tablaMaterias;

    $html = getPlantilla($vista);
    $html = str_replace('{tablaMaterias}', $tablaMaterias, $html);
    $html = render_dinamico_datos($html, $datos);

    print $html;
}

function setMaterias($datos = array()) {
    global $tablaMaterias;

    foreach ($datos as $registros) {
        $tablaMaterias .= '<tr>';
            $tablaMaterias .= '<td>'.$registros['idmateria'].'</td>';
            $tablaMaterias .= '<td>'.$registros['nombre'].'</td>';
        $tablaMaterias .= '</tr>';
    }

}
?>
