<?php

class Conexion {

    private $conect;

    public function __construct(){
         
       $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8";

        try {

            $this->conect = new PDO($dsn, DB_USER, DB_PASSWORD);
            $this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $e) {
            $this->conect = "Error de conexión";
            echo "Error" . $e->getMessage(); // Nos muestra el error
            
        }

    }

    public function conect()
    {
        return $this->conect; // Almacena la conexión
    }

}

?>