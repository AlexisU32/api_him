<?php

class Errors extends Controllers{

    public function __construct()
        {
            // Para que se ejecute el método constructor de Controllers
            parent::__construct();
        }

        public function notFound()
        {
            $this->views->getViews($this,"error");
        }

}

$notFound = new Errors();
$notFound->notFound();


?>