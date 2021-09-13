<?php

    // Clase para cargar los módelos

    class Controllers {

        public function __construct() {
            // Instancia de la Vista
            $this->views = new Views();
            
            $this->loadModel(); // Se ejecuta de primero
        }

        // Función para cargar los Módelos
        public function loadModel()
        {
            // Ejempld   ---> la clase es Api
            $model = get_class($this)."Model"; // Acá se concatena el nombre de la clase con Model ---> ApiModel
            // ruta de la clase
            $routClass = "Models/".$model.".php"; // Acá se arma la ruta de busqueda del archivo ---> Models/ApiModel.php

            if (file_exists($routClass)) { // Verificar que exista ese archivo
                // Requerimos el archivo
                require_once($routClass);
                $this->model = new $model(); // Esto corresponde a la clase que se va a encontrar en el archivo Models

            }
        }


    }


?>