<?php
function createConexion(){
    $host = 'localhost';
    $database = 'agencia';
    $userName = 'root';
    $password = '';
    try{
        $db = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $userName, $password);
    }catch(Exception $e){
        var_dump($e);
    }

    return $db;
}