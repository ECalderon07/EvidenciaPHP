<?php

namespace negocio\controlador;

use modelo\dao\LibroDAO;
use modelo\vo\LibroVO;
use negocio\generico\GenericoControlador;
use const CARPETA_PRINCIPAL;
use const RUTA_PRINCIPAL;
use negocio\util\Util;

class LibroControlador extends GenericoControlador {

    private $libroDAO;
    private $libroVO;

    public function __construct(&$cnn) {
        parent::__construct($cnn);
        $this->libroDAO = new LibroDAO($cnn);
        $this->libroVO = new LibroVO();
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

    public function vistaActualizarLibro() {
        //debe llamar a un metódo consulta por cédula previamente
        $isbn = $_POST['isbn'];
        $datos = $consulta = $this->libroDAO->consultarLibro($isbn);
        $vista = Util::cargarVista('./vista/libro/editarLibro.php', $datos);
        echo json_encode(array("mensaje" => "1", "dato" => $vista));
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

    public function eliminarLibro() {
        $isbn = $_POST['isbn'];
        $consulta = $this->libroDAO->eliminarLibro($isbn);
        if ($consulta == 1) {
            $datos = $this->libroDAO->listarLibro($_SESSION['usuario']->cedula);
            $vista = Util::cargarVista('./vista/libro/listarLibro.php', $datos);
            echo json_encode(array("mensaje" => 1, "dato" => $vista));
        } else {
            echo json_encode(array("mensaje" => 2, "dato" => "Eliminar fallida revisar Conexion"));
        }
    }

    //vista
    public function vistaRegistrarLibro() {
        $vista = Util::cargarVista('./vista/libro/registrarLibro.php');
        echo json_encode(array("mensaje" => "1", "dato" => $vista));
    }

    public function registrarLibro() {
        $this->libroVO->setIsbn($_POST['inpIsbn']);
        $this->libroVO->setDescripcion($_POST['txtDescripcion']);
        $this->libroVO->setAutor($_POST['inpAutor']);
        $this->libroVO->setPublicacion($_POST['inpPublicacion']);
        $this->libroVO->setGenero($_POST['sltGenero']);
        $this->libroVO->setNombre($_POST['inpNombre']);
        $this->libroVO->setCedula($_POST['inpCedula']);
//        $this->libroVO->setCedula($_SESSION['usuario']->cedula);

        if ($this->consultarLibro($this->libroVO->getIsbn())) {
            $resultado = $this->libroDAO->registrarLibro($this->libroVO);
            if ($resultado == 1) {
                $vista = Util::cargarVista('./vista/menu/menuUser.php');
                echo json_encode(array("mensaje" => $resultado == 1, "dato" => $vista));
            } else {
                echo json_encode(array("mensaje" => $resultado == 2, "dato" => "Registro fallido revisar Conexión"));
            }
        }
    }

    public function editarLibro() {
        $this->libroVO->setIsbn($_POST['inpIsbn']);
        $this->libroVO->setNombre($_POST['inpNombre']);
        $this->libroVO->setDescripcion($_POST['txtDescripcion']);
        $this->libroVO->setPublicacion($_POST['inpPublicacion']);
        $this->libroVO->setGenero($_POST['sltGenero']);
        $this->libroVO->setCedula($_POST['inpCedula']);
        $this->libroVO->setAutor($_POST['inpAutor']);

//        $resultado = $this->libroDAO->editarLibro($this->libroVO);
        $resultado = $this->libroDAO->editarLibro($this->libroVO);
        if ($resultado == 1) {
            $vista = Util::cargarVista('./vista/menu/menuUser.php');
            echo json_encode(array("mensaje" => $resultado == 1, "dato" => $vista));
        } else {
            echo json_encode(array("mensaje" => $resultado == 2, "dato" => "Actualización fallida revisar Conexión"));
        }
    }

    public function vistaListarGenero() {
        $datos = $this->libroDAO->listarLibroGenero();
        $vista = Util::cargarVista('./vista/libro/filtroLibros.php', $datos);
        echo json_encode(['mensaje' => '1', 'dato' => $vista]);
    }

}
