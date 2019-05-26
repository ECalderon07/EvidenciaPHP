<?php

namespace negocio\util;

class Util{
    
    
    public  static function cargarVista($ruta,$datos=''){
        ob_start();
        include_once "$ruta";
        return ob_get_clean();
    }
    
    
}

