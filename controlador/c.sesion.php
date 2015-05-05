<?php
require_once 'modelo/m.BdCon.php';
//Funcion que comprobara el inicio y el final de las sesiones de usuario

class Sesion{
    private $conexion;

    //Constructor que inicia la conexion con la BD
    function  sesion(){
        $this->conexion = new Conexion();
        $this->conexion->Conexion();
    }
    
    //Destructor que finaliza la conexion con la BD
    function __destruct(){
        $this->conexion->desconexion();
    }
    
    //Comprobamos que el valor de la cookie coincide con el valor guardado en la BD;
    public function recuerdoS($id){
        $res=$this->conexion->consultar("*","jugadores","recuerdo='".$id."' and activado = 1");
        if($res){
            $_SESSION['nombre']=$res[0]['nombre'];
            $_SESSION['id']=$res[0]['id'];
            $_SESSION['error']="Sesion iniciada con exito";
            $_SESSION['ok']="ok";
            return $res;
        }else{
            return false;
        }
    }
    
    //Comprueba que existe el usuario y que la cuenta esta activa. 
    public function iniciarS($id,$pass,$rec){
        $res=$this->conexion->consultar("*","jugadores","id='".$id."' and pass='".$pass."' and activado = 1");
        if($res){
            if($rec){
                $this->conexion->modificar("jugadores","recuerdo","'".session_id()."'","id='".$id."'");
                setcookie('recuerdo',session_id(), time()+60*60*24*7,"/");
            }
            $_SESSION['nombre']=$res[0]['nombre'];
            $_SESSION['id']=$res[0]['id'];
            $_SESSION['error']="Sesion iniciada con exito";
            $_SESSION['ok']="ok";
            return $res;
        }else{
            $_SESSION['error']="Imposible iniciar sesion usuario o password incorrectos";
            return false;
        }
    }
    
    //funcion que finaliza la sesion
    public function cerrarS(){
        setcookie('recuerdo',"", time()-60*60*24*7,"/");
        $_SESSION['nombre']=" ";
        $_SESSION['id']=" ";
        return true; 
    }
    
    //Funcion para mantener la sesion activa
    public function mantenerS(){
        $res=$this->conexion->consultar("*","jugadores","id='".$_SESSION['id']."'");
        return $res;
    }
  
}