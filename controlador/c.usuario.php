<?php
require_once 'modelo/m.BdCon.php';

class Usuario{
    private $conexion;
    
    //Constructor que inicia la conexion con la BD
    function  usuario(){
        $this->conexion = new Conexion();
        $this->conexion->Conexion();
    }
    
    //Destructor que finaliza la conexion con la BD
    function __destruct(){
        $this->conexion->desconexion();
    }
    
    //Funcion para mostrar el perfil de un usuario
    public function perfil($res){
        $resultado= array();
        $cartas=$this->conexion->consultar("sum(n_copias)","cartas_jugador","id_jugador='".$res[0]['id']."'");
        $mazos=$this->conexion->consultar("count(nombre_mazo)","mazos","nombre_jugador='".$res[0]['id']."'");
        $resultado[0]=$cartas[0][0];
        $resultado[1]=$mazos[0][0];
        return $resultado;
    }
}