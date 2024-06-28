<?php
    require_once('api/viewApi/ApiView.php');
    require_once('api/Model-Api/jugadorApiModel.php');
    require_once('api/Controllers-Api/controller.php');
    require_once('api/helpers/loginHelpers.php');
    class jugadorApiController extends controller {
        private $model;
         function __construct() {
            $this->model = new jugadorModel();
        }
        public function getAll() { //debo poner el token
            $us = $this->user->currentUser(); 
            if($us){
               
                try {
                    // Obtener todas las tareas del modelo
                    if(empty($_GET['atr']) && empty($_GET['order']) )
                        $jugadores = $this->model->getAll();
                    else
                        $jugadores = $this->model->getAll($_GET['atribute'], $_GET['order']);
                   
                    if($jugadores){
                        $response = [
                        "status" => 200,
                        "data" => $jugadores
                        ];
                        // Si hay tareas, devolverlas con un código 200 (éxito)
                        $this->view->response($response, 200);
                    }
                    else
                        // Si no hay tareas, devolver un mensaje con un código 404 (no encontrado)
                            $this->view->response("No hay tareas en la base de datos", 404);
                } catch (Exception $e) {
                    // En caso de error del servidor, devolver un mensaje con un código 500 (error del servidor)
                    $this->view->response("Error de servidor", 500);
                }
            }else{
                $this->view->response("Sin autorizacion", 401);
            }
        }
            public function getJugador($params = null) {
                $user = $this->user->currentUser(); 
                if($user){
                    $id = $params[':ID'];
            
                    try {
                        // Obtiene una tarea del modelo
                        $jugador = $this->model->getJugador($id);
                        // Si existe la tarea, la retorna con un código 200 (éxito)
                        if($jugador){
                            $response = [
                            "status" => 200,
                            "message" => $jugador
                           ];
                            $this->view->response($response, 200);
                        //    $this->view->response($tareas, 200);
                        }
                        else{
                            $response = [
                                "status" => 404,
                                "message" => "No existe la tarea en la base de datos."
                            ];
                            $this->view->response($response, 404);
                        }
                    } catch (Exception $e) {
                        // En caso de error del servidor, devolver un mensaje con un código 500 (error del servidor)
                        $this->view->response("Error de servidor", 500);
                    }
                }else{
                    $this->view->response("Sin autorizacion", 401);
                }
            }  
    }

    