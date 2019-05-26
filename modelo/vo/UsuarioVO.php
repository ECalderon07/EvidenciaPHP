<?php

namespace modelo\vo;

use modelo\generico\IGenericoVO;

class UsuarioVO implements IGenericoVO {

    private $cedula;
    private $nombre;
    private $telefono;
    private $contrasena;
    private $correo;
    private $rol;

    
    function getContrasena() {
        return $this->contrasena;
    }

    function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }

      
    function getRol() {
        return $this->rol;
    }

    function setRol($rol) {
        $this->rol = $rol;
    }

    function getCedula() {
        return $this->cedula;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getCorreo() {
        return $this->correo;
    }

    function setCedula($cedula) {
        $this->cedula = $cedula;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function getAtributos() {
        $atributos = array();
        $atributos['cedula'] = $this->cedula;
        $atributos['nombre'] = $this->nombre;
        $atributos['correo'] = $this->correo;
        $atributos['telefono'] = $this->telefono;
        $atributos['contraseña'] = $this->contraseña;

        return $atributos;
    }

    public function convertir($info) {
        $atributos = array_keys(get_object_vars($this));
        foreach ($atributos as $nombreAtributo) {
            if (isset($info['pro_' . $nombreAtributo])) {
                $this->$nombreAtributo = $info['pro_' . $nombreAtributo];
            }
        }
    }

}
