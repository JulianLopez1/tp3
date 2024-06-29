<?php
require_once ('libs/router.php');
require_once ('api/Controllers-Api/jugadorApiController.php');
require_once 'config.php';
require_once ('api/Controllers-api/controller.php');
$route = new Router();



$route->addRoute('getJugadores', 'GET', 'jugadorApiController', 'getJugadores');
$route->addRoute('create', 'POST', 'jugadorApiController', 'create');
$route->addRoute('getJugador/:ID', 'GET', 'jugadorApiController', 'getJugador');
$route->addRoute('get/:CLUB', 'GET', 'jugadorApiController', 'getPorClub');

$route->addRoute('update/:ID', 'PUT', 'jugadorApiController', 'update');

$route->addRoute('delete/:ID', 'DELETE', 'jugadorApiController', 'delete');

$route->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
