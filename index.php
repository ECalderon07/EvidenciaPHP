<?php

require_once './autoload.php'; //acargar todas las clase posibles
require_once './ruta.php'; //donde están las constantes
if (!isset($_SERVER['PATH_INFO'])) {
    if (isset($_COOKIE['usuario'])) {

        session_start();
        $_SESSION['usuario'] = json_decode($_COOKIE['usuario'], true);  

        $vista= include_once './vista/general.php';
        if ($_SESSION['usuario']['rol'] == 'admin') {
            $vista = include_once './vista/menu/menuAdmin.php';
        } else if ($_SESSION['usuario']['rol'] == 'user') {
            $vista = include_once './vista/menu/menuUser.php';
        } else if ($_SESSION['usuario']['rol'] == 'supervisor') {
            $vista = include_once './vista/menu/menuSupervisor.php';
        }        
        
            
        return;
    }

    include_once './vista/iniciarSesion.php';
    return;
}

use modelo\basedatos\Conexion;

$cnn = Conexion::conectar();
$url = $rutaPrincipal . $_SERVER['PATH_INFO'];
$error404 = false;
foreach (get_defined_constants() as $constante) {

    if (!is_array($constante)) {
        continue;
    }
    if ($url == $constante['url']) {
        $error404 = true;
        $clase = '\\negocio\\controlador\\' . $constante['controlador'];
        $obj = new $clase($cnn);
        $metodo = $constante['metodo'];
        $obj->$metodo();
        break;
    }
}
//en caso de no encontrar una ruta válida
if (!$error404) {
    include_once './vista/error404.php';
}