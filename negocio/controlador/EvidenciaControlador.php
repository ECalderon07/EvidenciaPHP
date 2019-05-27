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

        public function registrarArchivo() {
        $cedula = $_POST['inpCedula'];
        $archivo = $_FILES['inpArchivo'];
        $random = rand(0, 20000000);
        
        $this->evidenciaVO->setIsbn($_POST['inpIsbn']);
        $this->evidenciaVO->setIsbn($_POST['inpIsbn']);
        $this->evidenciaVO->setIsbn($_POST['inpIsbn']);

        if ($this->cargarArchivo($cedula, $random, $archivo) == 1) {
            //$cedula lo captura de la sesiòn $_SESSION
            try {
                
                echo json_encode(["codigo" => "1", "mensaje" => "carga exitosa"]);
            } catch (PDOException $ex) {
                echo json_encode(["codigo" => "2", "mensaje" => "Falla en SQL" . $ex->getMessage()]);
            }
        } else if ($this->cargarArchivo() == 2) {
            echo json_encode(["codigo" => "2", "mensaje" => "Archivo repetido"]);
        } else if ($this->cargarArchivo() == 3) {
            echo json_encode(["codigo" => "3", "mensaje" => "Falla al subir el archivo"]);
        }
    }
    
    public function consultarLibro($isbn) {
        //falta código consulta unica
        $consulta = $this->libroDAO->consultarLibro($isbn);
        if (is_object($consulta)) {
            echo json_encode(array("mensaje" => 3, "dato" => "libro repetido"));
            return false;
        } else {
            return true;
        }
    }

    public function listarLibro() {
        $datos = $this->libroDAO->listarLibro($_SESSION['usuario']->cedula);

        if (is_array($datos)) {
            $vista = Util::cargarVista('./vista/libro/listarLibro.php', $datos);
            echo json_encode(['mensaje' => '1', 'dato' => $vista]);
        } else {
            echo json_encode(['mensaje' => '0', 'dato' => 'No existe libros registrados']);
        }
    }

}
