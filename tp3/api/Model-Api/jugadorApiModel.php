<?php
require_once "api/Model-Api/model.php";
class jugadorModel extends Model
{
    function getAll($atr = null, $order= null){
        //abrimos la conexion;
        $db = $this->createConexion();
       
        if(!$atr){
            $sentencia = $db->prepare("SELECT * FROM jugador");
        }else{
            $sentencia = $db->prepare("SELECT * FROM jugador order by $atr $order");
        }
        $sentencia->execute();
        //Enviar la consulta
        $jugadores = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $jugadores;
    }
    function insert($nombre, $apellido, $club, $representante)
    {

        $db = $this->createConexion();

        $resultado = $db->prepare("INSERT INTO jugador (nombre, apellido, club, representante_id) VALUES (?,?,?,?)");
        $resultado->execute([$nombre, $apellido, $club, $representante]);
    }
    function delete($id)
    {
        $db = $this->createConexion();
        if ($db) {
            $resultado = $db->prepare("DELETE FROM jugador WHERE id = ?");
            $resultado->execute([$id]);
        } else {
            echo "No se pudo conectar a la base de datos.";
        }
    }
    function getJugador($id)
    {
        $db = $this->createConexion();
        if ($db) {
            $resultado = $db->prepare("SELECT * FROM jugador WHERE id = ?");
            $resultado->execute([$id]);
            $jugador = $resultado->fetch(PDO::FETCH_OBJ);
            return $jugador;
        } else {
            echo "No se pudo conectar a la base de datos.";
        }
    }
}