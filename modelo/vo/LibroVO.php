<?php

namespace modelo\vo;

use modelo\generico\IGenericoVO;

class LibroVO implements IGenericoVO {

    private $cedula;
    private $nombre;
    private $descripcion;
    private $publicacion;
    private $genero;
    private $isbn;
    private $autor;

    function __construct() {
        
    }

    function getCedula() {
        return $this->cedula;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPublicacion() {
        return $this->publicacion;
    }

    function setPublicacion($publicacion) {
        $this->publicacion = $publicacion;
    }

    function getGenero() {
        return $this->genero;
    }

    function getIsbn() {
        return $this->isbn;
    }

    function getAutor() {
        return $this->autor;
    }

    function setCedula($cedula) {
        $this->cedula = $cedula;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function setGenero($genero) {
        $this->genero = $genero;
    }

    function setIsbn($isbn) {
        $this->isbn = $isbn;
    }

    function setAutor($autor) {
        $this->autor = $autor;
    }

    public function getAtributos() {
        $atributos = array();
        $atributos['cedula'] = $this->cedula;
        $atributos['nombre'] = $this->nombre;
        $atributos['isbn'] = $this->isbn;
        $atributos['autor'] = $this->autor;
        $atributos['descripcion'] = $this->descripcion;
        $atributos['genero'] = $this->genero;
        $atributos['publicacion'] = $this->publicacion;

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
