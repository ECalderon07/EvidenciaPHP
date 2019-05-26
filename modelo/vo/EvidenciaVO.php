<?php

namespace modelo\vo;

use modelo\generico\IGenericoVO;

class EvidenciaVO implements IGenericoVO {

    private $idEvidencia;
    private $ruta;
    private $cedula;

    function __construct() {
        
    }

    function getIdEvidencia() {
        return $this->idEvidencia;
    }

    function getRuta() {
        return $this->ruta;
    }

    function getCedula() {
        return $this->cedula;
    }

    function setIdEvidencia($idEvidencia) {
        $this->idEvidencia = $idEvidencia;
    }

    function setRuta($ruta) {
        $this->ruta = $ruta;
    }

    function setCedula($cedula) {
        $this->cedula = $cedula;
    }

    public function convertir($info) {
        $atributos = array_keys(get_object_vars($this));
        foreach ($atributos as $nombreAtributo) {
            if (isset($info['pro_' . $nombreAtributo])) {
                $this->$nombreAtributo = $info['pro_' . $nombreAtributo];
            }
        }
    }

    public function getAtributos() {
        $atributos['idEvidencia'] = $this->idEvidencia;
        $atributos['ruta'] = $this->ruta;
        $atributos['cedula'] = $this->cedula;

        return $atributos;
    }

}
