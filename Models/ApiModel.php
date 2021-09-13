<?php

    class ApiModel extends Mysql{

        function __construct() {
            //echo "Mensaje desde el módel Home";
            parent::__construct();  // Para ejecutar el contructor de la clase Mysql
        }

        // Función que va a mostrar todos los usuarios
        public function getUsers()
        {
            $query = "SELECT * FROM users";
            $response = $this->select_all($query);
            return $response;
        }

        // Función para editar los clientes ya creados
        public function updateClientes($data){
            // Esta función recibe un objeto con toda la información

            // Guardamos cada dato en su respectivo campo
            $name = $data->name;
            $lastname = $data->lastname;
            $email = $data->email;
            $type_id = $data->type_id;
            $identification = $data->identification;
            $password = $data->password;

            // Se procede armar un Query
            //$query = "UPDATE users SET name = '${name}', lastname = '${lastname}', email = '${email}', type_id = '${type_id}', password = '${password}' WHERE identification = '${identification}'";
            $query = "UPDATE users SET name = ?, lastname = ?, email = ?, type_id = ?, password = ? WHERE identification = ?";
            
            // Se procede a crear un array con lod datos 
            $arrayData = array($name, $lastname, $email, $type_id, $password, $identification); // Los datos ingresados deben estar en el mismo orden al de la consulta

            $response = $this->update($query, $arrayData);

            return $response;
        }


    }


?>