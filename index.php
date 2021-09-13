<?php

    require_once("Config/Config.php");

    $url = !empty($_GET['url']) ? $_GET['url'] : 'Home/home'; // Si la url esta vacida entonces se le agrega el controlador y el metodo para redireccionar la página

    $arrUrl = explode("/", $url); // Con esta función separamos el controlador, el método y los parametros en un array

    // Porque se le coloca el mismo valor del controlador al método? en caso que no se ingese si no el controlador seguido de esto se llama al metodo principal de ese controlador 
    $controller = $arrUrl[0];
    $method = $arrUrl[0];
    $params = '';

    // Validamos para ver si existe el metodo
    if (!empty($arrUrl[1])) {// Se pregunta si existe la posiciòn 1 de array
        
        if ($arrUrl[1] != "") { // Se valida que no este vacido el array en la posición 1
            $method = $arrUrl[1];
        }
    }

    // Ahora se valida para los parámetros
    if (!empty($arrUrl[2])) { // Se verifica que exista
        if ($arrUrl[2] != "") { // Se valida que no este vacido el campo
            
            for ($i=2; $i < count($arrUrl); $i++) { 
                $params .= $arrUrl[$i].',';
            }
            
            $params = trim($params,','); // Con la función trim lo que se hace es quitar la ultima 'coma' agregada

        }
    }

    // Función para cargar las clases automaticas
    spl_autoload_register(function($class){

        if (file_exists(LIBS.'Core/'.$class.'.php')) { // Para validar si existe la clase en la carpeta Core
            // Si existe la clase la requerimos
            require_once(LIBS.'Core/'.$class.'.php');
        }

    });

    $controllerFile = 'Controllers/'.$controller.'.php'; //Con esto se crea una ruta de busqueda
    if (file_exists($controllerFile)) {
        require_once($controllerFile);
        // Se hace una instancia del controlador
        $controller = new $controller();

        // Validar si existe el método
        if (method_exists($controller, $method)) {

            $controller->{$method}($params);
        
        }else{
            require_once("Controllers/Error.php");
        }

    }else{
        require_once("Controllers/Error.php");
    }



?>