<?php

namespace modelo\dao;

use PDO;
use modelo\generico\GenericoDAO;
use modelo\vo\LibroVO;

class LibroDAO extends GenericoDAO {

    private $libroVO;

    public function __construct($cnn) {
        parent::__construct($cnn, 'libro'); //primer parámetro la conexión/2do parámetro la tabla
        $this->libroVO = new LibroVO();
    }

    public function listarLibro($cedula) {
        $sentencia = "SELECT * FROM $this->tabla WHERE cedula=:ced";
        $resultado = $this->cnn->prepare($sentencia);
        $resultado->bindValue(':ced', $cedula);
        $resultado->execute();
        return $resultado->fetchAll(PDO::FETCH_OBJ);
    }

    public function consultarLibro($isbn) {
        $sentencia = "SELECT * FROM $this->tabla WHERE isbn=:isbn";
        $resultado = $this->cnn->prepare($sentencia);
        $resultado->bindValue(':isbn', $isbn);
        $resultado->execute();
        return $resultado->fetch(PDO::FETCH_OBJ);
    }

    public function eliminarLibro($isbn) {
        try {
            $sentencia = "DELETE FROM $this->tabla WHERE isbn=:isbn";
            $resultado = $this->cnn->prepare($sentencia);
            $resultado->bindValue(':isbn', $isbn);
            $resultado->execute();
            return 1;
        } catch (PDOException $ex) {
            return 2;
        }
    }

    public function registrarLibro(LibroVO $libroVO) {
        try {
            $sentencia = "INSERT INTO $this->tabla (isbn,descripcion,autor, publicacion, genero,nombre,cedula) VALUES (:isbn,:descripcion,:autor,:publicacion,:genero,:nombre,:cedula)";
            $resultado = $this->cnn->prepare($sentencia);
            $resultado->bindValue(':isbn', $libroVO->getIsbn());
            $resultado->bindValue(':descripcion', $libroVO->getDescripcion());
            $resultado->bindValue(':autor', $libroVO->getAutor());
            $resultado->bindValue(':publicacion', $libroVO->getPublicacion());
            $resultado->bindValue(':genero', $libroVO->getGenero());
            $resultado->bindValue(':nombre', $libroVO->getNombre());
            $resultado->bindValue(':cedula', $libroVO->getCedula());
            $resultado->execute();
            return 1;
        } catch (PDOException $ex) {
            return 2;
        }
    }

    public function editarLibro(LibroVO $libroVO) {
        try {
            $sentencia = "UPDATE $this->tabla SET  isbn=:isbn,nombre=:nombre,descripcion=:descripcion,publicacion=:publicacion,genero=:genero,autor=:autor,cedula=:cedula WHERE isbn=:isbn";
            $resultado = $this->cnn->prepare($sentencia);
            
            $resultado->bindValue(':isbn', $libroVO->getIsbn());
            $resultado->bindValue(':nombre', $libroVO->getNombre());
            $resultado->bindValue(':descripcion', $libroVO->getDescripcion());
            $resultado->bindValue(':publicacion', $libroVO->getPublicacion());
            $resultado->bindValue(':genero', $libroVO->getGenero());
            $resultado->bindValue(':cedula', $libroVO->getCedula());
            $resultado->bindValue(':autor', $libroVO->getAutor());
         
            $resultado->execute();
            return 1;
        } catch (PDOException $ex) {
            return 2;
        }
    }
    
        public function listarLibroGenero() {
        $sentencia = "SELECT
        ( SELECT COUNT(*) FROM $this->tabla WHERE genero = 'ficcion' AND cedula =:ced) AS Ficcion,    
        ( SELECT COUNT(*) FROM $this->tabla WHERE genero = 'terror' AND cedula =:ced) AS Terror,
        ( SELECT COUNT(*) FROM $this->tabla WHERE genero = 'drama' AND cedula=:ced ) AS Drama,
        ( SELECT COUNT(*) FROM $this->tabla WHERE genero = 'infantil' AND cedula=:ced ) AS Infantil,
        ( SELECT COUNT(*) FROM $this->tabla WHERE genero = 'comedia' AND cedula=:ced )AS Comedia,
        ( SELECT COUNT(*) FROM $this->tabla WHERE genero = 'aventura' AND cedula=:ced )AS Aventura,    
        ( SELECT COUNT(*) FROM $this->tabla WHERE genero = 'suspenso' AND cedula=:ced )AS Suspenso,    
        ( SELECT COUNT(*) FROM $this->tabla WHERE genero = 'historia' AND cedula=:ced )AS Historia,
        ( SELECT COUNT(*) FROM $this->tabla WHERE genero = 'biografia' AND cedula =:ced)AS Biografia";

        $resultado = $this->cnn->prepare($sentencia);
        $resultado->bindValue(':ced', $_SESSION['usuario']->cedula);
        $resultado->execute();
        return $resultado->fetchAll(PDO::FETCH_OBJ);
    }

}
