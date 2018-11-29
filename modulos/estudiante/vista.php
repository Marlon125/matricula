<?php

// ********************** MODULO ESTUDIANTE **********************

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
    global $tablaEstudiantes;

    $html = getPlantilla($vista);
    $html = str_replace('{tablaEstudiantes}', $tablaEstudiantes, $html);
    $html = render_dinamico_datos($html, $datos);

    print $html;
}

function setEstudiantes($datos = array()) {
    global $tablaEstudiantes;

    foreach ($datos as $registros) {
        $tablaEstudiantes .= '<tr>';
            $tablaEstudiantes .= '<td>'.$registros['idestudiante'].'</td>';
            $tablaEstudiantes .= '<td>'.$registros['nombre'].'</td>';
            $tablaEstudiantes .= '<td>'.$registros['identificacion'].'</td>';
        $tablaEstudiantes .= '</tr>';
    }

}
?>
