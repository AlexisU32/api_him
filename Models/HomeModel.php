<?php

    class HomeModel extends Mysql{

        function __construct() {
            //echo "Mensaje desde el módel Home";
            parent::__construct();  // Para ejecutar el contructor de la clase Mysql
        }

        public function insertar(string $name, string $lastname, string $email, string $type_id, string $identification, string $password)
        {
            $query_insert = "INSERT INTO users (name, lastname, email, type_id, identification, password) VALUES (?,?,?,?,?,?)";
            $arrData = array($name, $lastname, $email, $type_id, $identification, $password);
            $request_insert = $this->insert($query_insert,$arrData);

            return $request_insert;
        }

    }

?>