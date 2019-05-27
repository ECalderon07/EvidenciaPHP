<?php

namespace negocio\controlador;

use modelo\dao\EvidenciaDao;
use modelo\vo\EvidenciaVO;
use negocio\generico\GenericoControlador;
use const CARPETA_PRINCIPAL;
use const RUTA_PRINCIPAL;
use negocio\util\Util;

class EvidenciaControlador extends GenericoControlador {

    private $evidenciaDAO;
    private $evidenciaVO;

    function __construct() {
        parent::__construct($cnn);
        $this->evidenciaDAO = new EvidenciaDao($cnn);
        $this->evidenciaVO = new EvidenciaVO();
    }

    public function cargarArchivo($cedula, $random, $archivo) {
        if (!is_dir('./evidencia/' . $cedula)) {
            mkdir('./evidencia/' . $cedula);
            if (!is_file("./evidencia/$cedula/$random.jpg")) {
                if (move_uploaded_file($archivo['tmp_name'], "./evidencia/$cedula/$random.jpg")) {
                    return 1;
                } else {
                    return 2;
                }
            } else {
                return 3;
            }
        } else {
            if (!is_file("./evidencia/$cedula/$random.jpg")) {
                if (move_uploaded_file($archivo['tmp_name'], "./evidencia/$cedula/$random.jpg")) {
                    return 1;
                } else {
                    return 2;
                }
            } else {
                return 3;
            }
        }
    }

    public function registrarArchivo() {

        $random = rand(0, 20000000);

        $this->evidenciaVO->setRuta($_FILES['inpArchivo']);
        $this->evidenciaVO->setCedula($_POST['inpCedula']);

        if ($this->cargarArchivo($cedula, $random, $archivo) == 1) {
            try {
                $resultado = $this->evidenciaDAO->registrarArchivo($this->evidenciaVO);
                if ($resultado == 1) {
                    $vista = Util::cargarVista('./vista/menu/menuUser.php');
                    echo json_encode(array("mensaje" => $resultado == 1, "dato" => "Carga exitosa"));
                }
            } catch (PDOException $ex) {
                echo json_encode(array("mensaje" => $resultado == 2, "dato" => "Falla en SQL" . $ex->getMessage()));
            }
        } else if ($this->cargarArchivo() == 2) {
            echo json_encode(array("mensaje" => $resultado == 3, "dato" => "Archivo repetido"));
        } else if ($this->cargarArchivo() == 3) {
            echo json_encode(array("mensaje" => $resultado == 4, "dato" => "Falla al subir el archivo"));
        }
    }

    public function listarArchivo() {
        $datos = $this->evidenciaDAO->listarArchivo($_SESSION['usuario']->cedula);
        if (is_array($datos)) {
            $vista = Util::cargarVista('./vista/evidencia/listarArchivo.php', $datos);
            echo json_encode(['mensaje' => '1', 'dato' => $vista]);
        } else {
            echo json_encode(['mensaje' => '0', 'dato' => 'No existe evidencias registradas']);
        }
    }

}
