<?php

namespace modelo\dao;

use PDO;
use modelo\generico\GenericoDAO;
use modelo\vo\EvidenciaVO;

class EvidenciaDao extends GenericoDAO {

    private $evidenciaVO;

    public function __construct($cnn) {
        parent::__construct($cnn, 'evidencia'); //primer parámetro la conexión/2do parámetro la tabla
        $this->evidenciaVO = new EvidenciaVO();
    }

    public function registrarArchivo($cedula,$random) {
        $sentencia = "INSERT INTO $this->tabla (ruta, cedula) VALUES (:ruta,:cedula)";
        $resultado = $cnn->prepare($sentencia);
        $resultado->bindValue(':ruta', "./evidencia/$cedula/$random.jpg");
        $resultado->bindValue(':cedula', $cedula);
        $resultado->execute();
    }

    public function listarArchivo($cedula) {
        $sentencia = "SELECT * FROM $this->tabla WHERE cedula=:cedula";
        $resultado = $this->cnn->prepare($sentencia);
        $resultado->bindValue(':cedula', $cedula);
        $resultado->execute();
        return $resultado->fetchAll(PDO::FETCH_OBJ);
    }

}
