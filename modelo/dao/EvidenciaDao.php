<?php

namespace modelo\dao;

use PDO;
use modelo\generico\GenericoDAO;
use modelo\vo\EvidenciaVO;

class EvidenciaDao extends GenericoDAO {

    private $evidenciaVO;

    public function __construct($cnn) {
        parent::__construct($cnn, 'evidencia'); //primer parámetro la conexión/2do parámetro la tabla
        $this->libroVO = new LibroVO();
    }

    public function listarEvidencia() {
        $sentencia = "SELECT * FROM $this->tabla ";
        $resultado = $this->cnn->prepare($sentencia);
        $resultado->execute();
        return $resultado->fetchAll(PDO::FETCH_OBJ);
    }

    public function consultarLibro($id) {
        $sentencia = "SELECT * FROM $this->tabla WHERE idEvidencia=:idEvidencia";
        $resultado = $this->cnn->prepare($sentencia);
        $resultado->bindValue(':idEvidencia', $isbn);
        $resultado->execute();
        return $resultado->fetch(PDO::FETCH_OBJ);
    }

}
