<?php

foreach ($_GET as $variable => $valor) {
    $_GET [$variable] = str_replace("'", "", trim($_GET [$variable]));
}

// Modificamos las variables de formularios 
foreach ($_POST as $variable => $valor) {
    if ($variable != 'checkes') {
        $_POST [$variable] = str_replace("'", "", trim($_POST [$variable]));
    }
}
