<?php
namespace negocio\generico;

abstract class GenericoControlador {

    protected $cnn;
    
    
    public function __construct(&$cnn) {
        $this->cnn=$cnn;
        session_start();
    }
    
    protected function validarSesion() {
        if (!isset($_SESSION['usuario']) || is_null($_SESSION['usuario'])) {
            session_destroy();
            header('Location:' . RUTA_PRINCIPAL);
        }
    }
    
    
    
}
