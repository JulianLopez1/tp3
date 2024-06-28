<?php
require_once('libs/router.php');
require_once('api/Controllers-Api/jugadorApiController.php');
require_once 'config.php';
$route = new Router();



$route->addRoute('jugadores', 'GET', 'jugadorApiController', 'getAll');
$route->addRoute('jugadores/:ID', 'GET', 'jugadorApiController', 'getJugador');

$route->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
