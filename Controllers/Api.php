<?php

    class Api extends Controllers{

        public function __construct()
        {
            // Ejecutamos el método constructor de controllers
            parent::__construct();
        }

        // http://localhost:8080/api_himed/Api/api
        public function api()
        {
            echo "Endpoint base";
        }

        // Listar todos los Clientes
        // http://localhost:8080/api_himed/Api/listClientes
        public function listClientes()
        {
            header("Access-Control-Allow_Origin: *");
            $response = $this->model->getUsers(); // Obtenemos los datos en un formato array

            //header('content-type: aplication/json'); // Con este encabezado no se puede ver en una web la información
            $respon = array('status' => 200, 'response' => $response);
            echo json_encode($respon);
        }

        // Función para modificar un usuario
        // http://localhost:8080/api_himed/Api/actualizarCliente
        public function actualizarCliente()
        {
            // Obtener el method de consulta
            $method = $_SERVER['REQUEST_METHOD'];

            //Validar que sea el método POST
            if ($method === 'POST') {

                // Obtener los datos que vienen en un Json y convertiirlos a un formato entendible para php
                $json = file_get_contents('php://input');
                // Decodificamos el json
                $data = json_decode($json);

                // Validar que exista el campo y luego validar que no esten vacidos
                if (!empty($data->name) && !empty($data->lastname) && !empty($data->email) && !empty($data->type_id) && !empty($data->identification) && !empty($data->password)) {
                    
                    if (!$data->name == "" && !$data->lastname == "" && !$data->email == "" && !$data->type_id == "" && !$data->identification == "" && !$data->password == "") {
                        
                        // Validar la cantidad de caracteres ingresados
                        if ( strlen($data->email) > 0 && strlen($data->email) <=30) {

                            if ( strlen($data->name) > 0 && strlen($data->name) <=40) {

                                if ( strlen($data->lastname) > 0 && strlen($data->lastname) <=40) {
                                
                                    // Validar que el número de identificación solo tenga números
                                    if (is_numeric($data->identification) && strlen($data->identification) <= 10) {
                                
                                        // Se procede a módificar el usuario

                                        $respon = $this->model->updateClientes($data);

                                        if ($respon) {
                                            // Respuesta al método update
                                            // header('content-type: aplication/json');
                                            $response = array(
                                                'status' => 200,
                                                'codigoError' => "029",
                                                'descripcionError' => "Actualización del usuario correctamente. ",
                                                'response' => "Cliente actualizado correctamente. "
                                           );
                             
                                            echo json_encode($response); 
                                            
                                        }else{
                                            // Respuesta al método update
                                            // header('content-type: aplication/json');
                                            $response = array(
                                                'status' => 404,
                                                'codigoError' => "000",
                                                'descripcionError' => "No se pudo realizar la actualización",
                                                'response' => $respon
                                           );
                             
                                            echo json_encode($response); 
                                        }
                                
                                    }else{

                                       // Respuesta a la validacion del número de identificación
                                       // header('content-type: aplication/json');
                                       $response = array(
                                           'status' => 409,
                                            'codigoError' => "000",
                                            'descripcionError' => "El número de identificación no cumple con los requisitos",
                                           'response' => "El número de identificación es demasiado grande"
                                      );
                        
                                       echo json_encode($response);  
                                    }
                                }else{

                                    // Respuesta a la longitud del name
                                    // header('content-type: aplication/json');
                                    $response = array(
                                        'status' => 409,
                                        'codigoError' => "000",
                                        'descripcionError' => "El nombre no cumple con los requisitos",
                                        'response' => "El nombre es demasiado grande"
                                    );
                        
                                    echo json_encode($response); 
                                }    

                            }else{
                                // Respuesta a la longitud del name
                                // header('content-type: aplication/json');
                                $response = array(
                                    'status' => 409,
                                    'codigoError' => "000",
                                    'descripcionError' => "El nombre no cumple con los requisitos",
                                    'response' => "El nombre es demasiado grande"
                                );
                        
                                echo json_encode($response); 
                            }

                        }else{
                            // Respuesta a la longitud del email
                            // header('content-type: aplication/json');
                            $response = array(
                                'status' => 409,
                                'codigoError' => "000",
                                'descripcionError' => "El correo electrónico no cumple con los requisitos",
                                'response' => "El correo es demasiado grande"
                            );
                        
                            echo json_encode($response);                           
                        }
                    
                    }else{
                        // Si hay algún campo vacido
                        // header('content-type: aplication/json');
                        $response = array(
                            'status' => 404,
                            'codigoError' => "000",
                            'descripcionError' => "No pueden haber campos vacidos",
                            'response' => "Debe ingresar todos los dato"
                        );
                    
                        echo json_encode($response);
                    }

                }else{
                    // Si hay algún campo que no exista
                    // header('content-type: aplication/json');
                    $response = array(
                        'status' => 409,
                        'codigoError' => "000",
                        'descripcionError' => "No existen los campos",
                        'response' => "No se puede realizar el UPDATE ya que hay un campo que no existe"
                        );
                    
                    echo json_encode($response);

                }

                
            }else{

                // header('content-type: aplication/json');
                $response = array(
                    'status' => 405,
                    'response' => "El método no es Aceptado. ",
                    'codigoError' => "001",
                    'descripcionError' => "El método no cumple con los requisitos " 
                    );
                
                echo json_encode($response);
            }

        }

    

}


?>