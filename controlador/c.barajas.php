<?php

require_once 'modelo/m.BdCon.php';

class Baraja{

    private $conexion;

    //Constructor que inicia la conexion con la BD
    function  Baraja(){
        $this->conexion = new Conexion();
        $this->conexion->Conexion();
    }

    //Destructor que finaliza la conexion con la BD
    function __destruct(){
        $this->conexion->desconexion();
    }
    
    //Funcion que muestra las barajas
    function mostrar(){
        return $this->conexion->consultar("*","mazos","nombre_jugador='".$_SESSION['id']."'");
    }
    
    //Funcion que muestra la coleccion de un jugador
    function coleccion(){
        return $this->conexion->consultar("*","cartas_jugador","id_jugador='".$_SESSION['id']."'");
    }
    
    //Funcion para obtener una carta
    function carta($id){
        return$this->conexion->consultar("*", "cartas","id=".$id);
    }
    
    function crearMazo($nombre,$descripcion){
        return-$this->conexion->insertar("mazos", "'".$_SESSION['id']."','".$nombre."','".$descripcion."'");
    }
    
    function cartaMazo($id,$copias,$mazo){
        return $this->conexion->insertar("cartas_mazo",$copias.",'".$_SESSION['id']."','".$mazo."',".$id);
    }
}