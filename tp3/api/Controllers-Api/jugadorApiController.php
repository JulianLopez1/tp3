<?php
require_once ('api/Controllers-api/controller.php');
require_once ('api/Model-Api/jugadorApiModel.php');
require_once ('api/Controllers-api/controller.php');
class jugadorApiController extends Controller
{
    private $model;
    function __construct()
    {
        parent::__construct();
        $this->model = new jugadorApiModel();

    }
    function getJugadores()
    {
        try {
            // Obtener todas las tareas del modelo
            if (empty($_GET['atr']) && empty($_GET['order']))
                $jugadores = $this->model->getAll();
            else
                $jugadores = $this->model->getAll($_GET['atribute'], $_GET['order']);

            if ($jugadores) {
                $response = [
                    "status" => 200,
                    "data" => $jugadores
                ];
                // Si hay tareas, devolverlas con un código 200 (éxito)
                $this->view->response($response, 200);
            } else
                // Si no hay tareas, devolver un mensaje con un código 404 (no encontrado)
                $this->view->response("No hay jugadores en la base de datos", 404);
        } catch (Exception $e) {
            // En caso de error del servidor, devolver un mensaje con un código 500 (error del servidor)
            $this->view->response("Error de servidor", 500);
        }

    }


    function getJugador($params = []){
        try{
            $jugador = $this->model->getJugador($params[':ID']);
                if (!empty($jugador)) {
                    $this->view->response($jugador, 200);
                } else {
                    $this->view->response(['msg' => 'no existe ese jugador'], 404);
                }
            }       
        catch (Exception $e) {
            // En caso de error del servidor, devolver un mensaje con un código 500 (error del servidor)
                     $this->view->response("Error de servidor", 500);
        }
        }
    


    function delete($params = [])
    {
        $jugador_id = $params[':ID'];
        $jugador = $this->model->getJugador($jugador_id);
        if ($jugador) {
            $this->model->delete($jugador_id);
            $this->view->response(['msg' => 'El jugador se elimino correctamente'], 200);
        } else {
            $this->view->response(['msg' => 'Jugador  no se encontro'], 404);

        }
    }
    function create($params = [])
    {
        $body = $this->getData();
        $nombre = $body->nombre;
        $apellido = $body->apellido;
        $club = $body->club;
        $representante = $body->representante_id;
        $this->model->insert($nombre, $apellido, $club, $representante);
        $this->view->response(['msg' => 'El jugador fue agregado'], 201);
    }
    function update($params = [])
    {
        $jugador_id = $params[':ID'];
        $jugador = $this->model->getJugador($jugador_id);
        if ($jugador) {
            $body = $this->getData();
            $nombre = $body->nombre;
            $apellido = $body->apellido;
            $club = $body->club;
            $representante = $body->representante_id;
            $this->model->updateJugador($jugador_id, $nombre, $apellido, $club, $representante);

            $this->view->response(['msg' => 'El jugador se modifico correctamente'], 200);
        } else {
            $this->view->response(['msg' => 'Jugador  no se encontro'], 404);

        }
    }
    function getPorClub($params = [])
    {
        if (!empty($params)) {
            $jugadores = $this->model->getClub($params[':CLUB']);
            if (!empty($jugadores)) {
                $this->view->response($jugadores, 200);
            } else {
                $this->view->response(['msg' => 'no existe ese club'], 404);
            }
        }


    }
}



