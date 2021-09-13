<?php
    
    class Home extends Controllers{
        
        public function __construct()
        {
            // Para que se ejecute el método constructor de Controllers
            parent::__construct();
        }

        public function home($params)
        {
            $this->views->getViews($this,"home");
        }

        public function insertar($params)
        {
            $data = $this->model->insertar("Alexis","Uribe", "alexis@gmail.com", "CC", "1234623", "123");
            print_r($data);
        }        

    }

?>