<?php

    class Mysql extends Conexion{
        private $conexion;
        private $strquery;
        private $arrValues;

        function __construct() {
            $this->conexion = new Conexion(); // Instanciamos un objeto de la clase Conexión
            $this->conexion = $this->conexion->conect(); // se invoca la función conect para utilizarlo

        }

        // Se procede a definir unas funciones estandares para usarlas en los modelos, de esta forma nos evitaremos estar reescribiendo 
        // el código con solo mandarle la consulta y un array 

        // Insertat un registro
        public function insert(string $query, array $arrValues)
        {
            
            $this->strquery = $query;
            $this->arrValues = $arrValues;

            $insert = $this->conexion->prepare($this->strquery); // prepare devuelve un objeto
            $resInsert = $insert->execute($this->arrValues);

            // Validar si guardo los datos
            if ($resInsert) {
                $lastIsert = $this->conexion->lastInsertId(); // Si guarda lo que hace es que devuelve el id
            }else{
                $lastIsert = 0;
            }

            return $lastIsert;

        }

        // Buscar un registro
        public function select(string $query)
        {
            $this->strquery = $query;
            $result = $this->conexion->prepare($this->strquery);
            $result->execute();

            $data = $result->fetch(PDO::FETCH_ASSOC);
            return $data;
        }

        // Devolver todos los registros
        public function select_all(string $query)
        {
            $this->strquery = $query;
            $result = $this->conexion->prepare($this->strquery);
            $result->execute();

            $data = $result->fetchall(PDO::FETCH_ASSOC);
            return $data;
        }

        // Actualizar registros
        public function update(string $query, array $arrValues)
        {
            $this->strquery = $query;
            $this->arrValues = $arrValues;

            $update = $this->conexion->prepare($this->strquery);
            $resExecute = $update->execute($this->arrValues);

            return $resExecute; // Si realizo el update manda un true
        }

        // Eliminar un registro
        public function delete(string $query)
        {
            $this->strquery = $query;

            $result = $this->conexion->prepare($this->strquery);
            $result->execute();
            return $result;
        }


    }


?>