<?php

function __autoload($parametro) {
    $clase = str_replace('\\', '/', $parametro);
    $rutaFinal = __DIR__ . '/' . $clase . '.php';
    require_once $rutaFinal;
}

