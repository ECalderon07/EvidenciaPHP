<?php

namespace negocio\controlador;

use modelo\dao\UsuarioDAO;
use modelo\vo\UsuarioVO;
use negocio\generico\GenericoControlador;
use const CARPETA_PRINCIPAL;
use const RUTA_PRINCIPAL;
use negocio\util\Util;

class UsuarioControlador extends GenericoControlador {

    private $usuarioDAO;
    private $usuarioVO;

    public function __construct(&$cnn) {
        parent::__construct($cnn);
        $this->usuarioDAO = new UsuarioDAO($cnn);
        $this->usuarioVO = new UsuarioVO();
    }

    public function cerrarSesion() {
//        session_start();
        unset($_COOKIE['usuario']);
        setcookie('usuario', '', (time() - 1) - ( 60 * 60 * 24 * 365), RUTA_PRINCIPAL);
        //var_dump($_COOKIE['usuario']);

        session_unset();
        session_destroy();
        include_once './vista/iniciarSesion.php';
    }

    public function autenticarUsuario() {
        $this->usuarioVO->setCedula($_POST['inpCedula']);
        $this->usuarioVO->setContrasena($_POST['inpContrasena']);
        $resultado = $this->usuarioDAO->autenticarUsuario($this->usuarioVO);
        if (is_object($resultado)) {

            //crear sesión
            $_SESSION['usuario'] = $resultado;
            //crear cookie
            $tiempo = (time() + 1) + ( 60 * 60 * 24 * 365);
            setcookie('usuario', json_encode($resultado), $tiempo, RUTA_PRINCIPAL);

            //dependiendo del rol habilitar menú
            if ($_SESSION['usuario']->rol == 'admin') {
                $vista = Util::cargarVista('./vista/menu/menuAdmin.php');
            } else if ($_SESSION['usuario']->rol == 'user') {
                $vista = Util::cargarVista('./vista/menu/menuUser.php');
            } else if ($_SESSION['usuario']->rol == 'supervisor') {
                $vista = Util::cargarVista('./vista/menu/menuSupervisor.php');
            } else {
                echo json_encode(['mensaje' => '0', 'dato' => 'Usuario no existe']);
                return;
            }
            echo json_encode(['mensaje' => '1', 'dato' => $vista]);
        } else {
            echo json_encode(['mensaje' => '0', 'dato' => 'Usuario no existe']);
        }
    }

    public function listarUsuario() {
        $datos = $this->usuarioDAO->listarUsuario();

        if (is_array($datos)) {
            $vista = Util::cargarVista('./vista/usuario/listarUsuario.php', $datos);
            echo json_encode(['mensaje' => '1', 'dato' => $vista]);
        } else {
            echo json_encode(['mensaje' => '0', 'dato' => 'Usuario no existe']);
        }
    }

    public function vistaActualizarUsuario() {
        //debe llamar a un metódo consulta por cédula previamente
        $cedula = $_POST['cedula'];
        $datos = $consulta = $this->usuarioDAO->consultarUsuario($cedula);
        $vista = Util::cargarVista('./vista/usuario/editarUsuario.php', $datos);
        echo json_encode(array("mensaje" => "1", "dato" => $vista));
    }

    public function consultarUsuario($cedula) {
        //falta código consulta unica
        $consulta = $this->usuarioDAO->consultarUsuario($cedula);
        if (is_object($consulta)) {
            echo json_encode(array("mensaje" => 3, "dato" => "usuario repetido"));
            return false;
        } else {
            return true;
        }
    }

    public function eliminarUsuario() {
        //falta código consulta unica
        $cedula=$_POST['cedula'];
        $consulta = $this->usuarioDAO->eliminarUsuario($cedula);
        if($consulta==1){
            $datos = $this->usuarioDAO->listarUsuario();
            $vista = Util::cargarVista('./vista/usuario/listarUsuario.php',$datos);
            echo json_encode(array("mensaje" => 1, "dato" => $vista));
        }else{
            echo json_encode(array("mensaje" => 2, "dato" => "Registro fallido revisar Conexión"));
        }
        
    }

    //vista
    public function vistaRegistrarUsuario() {
        $vista = Util::cargarVista('./vista/usuario/registrarUsuario.php');
        echo json_encode(array("mensaje" => "1", "dato" => $vista));
    }

    public function registrarUsuario() {
        $this->usuarioVO->setCedula($_POST['inpCedula']);
        $this->usuarioVO->setNombre($_POST['inpNombre']);
        $this->usuarioVO->setTelefono($_POST['inpTelefono']);
        $this->usuarioVO->setCorreo($_POST['inpCorreo']);
        $this->usuarioVO->setRol($_POST['sltRol']);
        $this->usuarioVO->setContrasena($_POST['inpContrasena']);

        if ($this->consultarUsuario($this->usuarioVO->getCedula())) {
            $resultado = $this->usuarioDAO->registrarUsuario($this->usuarioVO);
            if ($resultado == 1) {
                $vista = Util::cargarVista('./vista/iniciarSesion.php');
                echo json_encode(array("mensaje" => $resultado == 1, "dato" => $vista));
            } else {
                echo json_encode(array("mensaje" => $resultado == 2, "dato" => "Registro fallido revisar Conexión"));
            }
        }
    }

    public function editarUsuario() {
        $this->usuarioVO->setCedula($_POST['inpCedula']);
        $this->usuarioVO->setNombre($_POST['inpNombre']);
        $this->usuarioVO->setTelefono($_POST['inpTelefono']);
        $this->usuarioVO->setCorreo($_POST['inpCorreo']);
        $this->usuarioVO->setRol($_POST['sltRol']);
        $this->usuarioVO->setContrasena($_POST['inpContrasena']);

        $resultado = $this->usuarioDAO->editarUsuario($this->usuarioVO);
        if ($resultado == 1) {
            $vista = Util::cargarVista('./vista/menu/menuAdmin.php');
            echo json_encode(array("mensaje" => $resultado == 1, "dato" => $vista));
        } else {
            echo json_encode(array("mensaje" => $resultado == 2, "dato" => "Actualización fallida revisar Conexión"));
        }
    }

}
