<?php

require_once 'modelo/m.BdCon.php';
require_once 'modelo/m.validador.php';

class Registro{
    private $conexion;
    private $validador;
    
    //Constructor que inicia la conexion con la BD
    function  registro(){
        $this->conexion = new Conexion();
        $this->validador = new Validador();
        $this->conexion->Conexion();
    }
    
    //Destructor que finaliza la conexion con la BD
    function __destruct(){
        $this->conexion->desconexion();
    }
    
    //Comprueba si un mail esta en la BD
    public function comprobarM($mail){
       $correo= $this->validador->mail($mail);
       if($correo){
           $resultado= $this->conexion->consultar("mail","jugadores","mail='".$correo."'");
           if(count($resultado)==0){
               return "bien";
           }else{
               return "mal";
           }
       }else{
           return "error";
       }
    }
    
    //Comprueba si un ID esta en la BD
    public function comprobarID($id){
        $id= $this->validador->texto($id);
        if($id){
            $resultado= $this->conexion->consultar("id","jugadores","id='".$id."'");
            if(count($resultado)==0){
                return "bien";
            }else{
                return "mal";
            }
        }else{
            return "error";
        }
    }
    
    //Funcion para insertar un nuevo usuario
    public function registrar($id,$pass,$mail,$nomb,$pais){
        
        $id = $this->validador->texto($id);
        $pass = $this->validador->texto($pass);
        $mail = $this->validador->texto($mail);
        $nomb = $this->validador->texto($nomb);
        $pais = $this->validador->texto($pais);
        $mail= $this->validador->mail($mail);
        $correctMail= $this->comprobarM($mail);
        
        if($correctMail == "bien"){
            $correctID=$this->comprobarID($id);
            if($correctID== "bien"){
                $this->conexion->insertar("jugadores","'".$id."','".$pass."','".$mail."','".$nomb."','".$pais."','".session_id()."'","id,pass,mail,nombre,pais,activacion");
                return true;       
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
    //Funcion para activar un registro
    public function activar($c){
        
        $codigo=$this->validador->texto($c);
        $res=$this->conexion->modificar("jugadores","activado",1,"activacion='".$codigo."'");
        if($res==1){
            $_SESSION['error']= "Cuenta activada con exito";
            return true;
        }else{
            $_SESSION['error']="Ha habido un problema al activar la cuenta. Puede que su cuenta esta activada con anterioridad. Si no es el caso, pongase en contacto con nosotros";
            return false;
        }
    }
}