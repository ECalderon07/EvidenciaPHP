<?php

namespace modelo\basedatos;
use PDO;

class Conexion {
    
    const SERVER='localhost';
    const DB='aprendiz021';
    const USER='root';
    const CLAVE='';
    
    public static function conectar() {
        try {
            $cnn = new PDO('mysql:host='.self::SERVER.'; dbname='.self::DB.';', self::USER,self::CLAVE);
            $cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $cnn->exec("SET CHARACTER SET utf8");
            return $cnn;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }catch (PDOException $exc) {
            echo $exc->getMessage();
        }


        
    }
    
}


