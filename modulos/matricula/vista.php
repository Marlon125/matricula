<?php

// ********************** MODULO MATRICULA **********************

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
    global $tablaProgramas;

    $html = getPlantilla($vista);
    $html = str_replace('{tablaProgramas}', $tablaProgramas, $html);
    $html = render_dinamico_datos($html, $datos);

    print $html;
}

function setProgramas($datos = array()) {
    global $tablaProgramas;

    foreach ($datos as $registros) {
        $tablaProgramas .= '<tr>';
            $tablaProgramas .= '<td>'.$registros['idprograma'].'</td>';
            $tablaProgramas .= '<td>'.$registros['nombre'].'</td>';
        $tablaProgramas .= '</tr>';
    }

}
?>
