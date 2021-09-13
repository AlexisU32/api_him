<?php

    class Views {

        function getViews($controller, $view)
        {
            $controller = get_class($controller);
            // Validacion
            if ($controller == "Home") {
                $view = VIEWS.$view.".php";
            }else{
                $view = VIEWS.$controller."/".$view.".php";
            }

            require_once($view);
        }

    }

?>