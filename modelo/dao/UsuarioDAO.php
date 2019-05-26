<?php

namespace modelo\dao;

use PDO;
use modelo\generico\GenericoDAO;
use modelo\vo\UsuarioVO;

class UsuarioDAO extends GenericoDAO {

    private $usuarioVO;

    public function __construct($cnn) {
        parent::__construct($cnn, 'usuario');
        $this->usuarioVO = new UsuarioVO();
    }

    public function autenticarUsuario(UsuarioVO $usuarioVO) {
        $sentencia = "SELECT * FROM $this->tabla WHERE cedula=:ced AND contrasena=md5(:con)";
        $resultado = $this->cnn->prepare($sentencia);
        $resultado->bindValue(':ced', $usuarioVO->getCedula());
        $resultado->bindValue(':con', $usuarioVO->getContrasena());
        $resultado->execute();
        return $resultado->fetch(PDO::FETCH_OBJ);
    }

    public function listarUsuario() {
        $sentencia = "SELECT nombre, cedula, correo, telefono, rol FROM $this->tabla WHERE 1";
        $resultado = $this->cnn->prepare($sentencia);
        $resultado->execute();
        return $resultado->fetchAll(PDO::FETCH_OBJ);
    }

    public function consultarUsuario($cedula) {
        $sentencia = "SELECT * FROM $this->tabla WHERE cedula=:ced";
        $resultado = $this->cnn->prepare($sentencia);
        $resultado->bindValue(':ced', $cedula);
        $resultado->execute();
        return $resultado->fetch(PDO::FETCH_OBJ);
    }

    public function eliminarUsuario($cedula) {
        try {
            $sentencia = "DELETE FROM $this->tabla WHERE cedula=:ced";
            $resultado = $this->cnn->prepare($sentencia);
            $resultado->bindValue(':ced', $cedula);
            $resultado->execute();
            return 1;
        } catch (PDOException $ex) {
            return 2;
        }
    }

    public function registrarUsuario(UsuarioVO $usuarioVO) {
        try {
            $sentencia = "INSERT INTO $this->tabla (cedula,nombre,contrasena,correo, telefono,rol) VALUES (:ced,:nom,md5(:cont),:cor,:tel,:rol)";
            $resultado = $this->cnn->prepare($sentencia);
            $resultado->bindValue(':ced', $usuarioVO->getCedula());
            $resultado->bindValue(':nom', $usuarioVO->getNombre());
            $resultado->bindValue(':cont', $usuarioVO->getContrasena());
            $resultado->bindValue(':cor', $usuarioVO->getCorreo());
            $resultado->bindValue(':tel', $usuarioVO->getTelefono());
            $resultado->bindValue(':rol', $usuarioVO->getRol());
            $resultado->execute();
            return 1;
        } catch (PDOException $ex) {
            return 2;
        }
    }

    public function editarUsuario(UsuarioVO $usuarioVO) {
        try {
            $sentencia = "UPDATE $this->tabla SET  nombre=:nom, contrasena=md5(:cont), correo=:cor, telefono=:tel,rol=:rol WHERE cedula=:ced";
            $resultado = $this->cnn->prepare($sentencia);
            $resultado->bindValue(':ced', $usuarioVO->getCedula());
            $resultado->bindValue(':nom', $usuarioVO->getNombre());
            $resultado->bindValue(':cont', $usuarioVO->getContrasena());
            $resultado->bindValue(':cor', $usuarioVO->getCorreo());
            $resultado->bindValue(':tel', $usuarioVO->getTelefono());
            $resultado->bindValue(':rol', $usuarioVO->getRol());
            $resultado->execute();
            return 1;
        } catch (PDOException $ex) {
            return 2;
        }
    }

}
