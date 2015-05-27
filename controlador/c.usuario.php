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
    
    public function porcentaje($maximo,$referencia,$valor){
        if($maximo>0 && $referencia>0 && $valor >0){
            $resultado  = ($valor*$referencia)/$maximo;
            return $resultado;
        }else{
            return 0;
        }
    }
    
    //Funcion para mostrar el perfil de un usuario
    public function perfil($res){
        $resultado= array();
        $cartas=$this->conexion->consultar("sum(n_copias)","cartas_jugador","id_jugador='".$res[0]['id']."'");
        $mazos=$this->conexion->consultar("count(nombre_mazo)","mazos","nombre_jugador='".$res[0]['id']."'");
        $partidas= $this->conexion->consultar("*","jugadores_partida","id_jugador='".$res[0]['id']."'");
        $jugadas= count($partidas);
        $ganadas= $this->conexion->consultar("count(id)","partida","ganador='".$res[0]['id']."'");
        $perdidas= $jugadas-$ganadas[0][0];
        $resultado[0]=$cartas[0][0];
        $resultado[1]=$mazos[0][0];
        $resultado[2]=$ganadas[0][0];
        $resultado[3]=$perdidas;
        $resultado[4]=$jugadas;
        return $resultado;
    }
    
    public function cambiarAvatar($imagen,$res){
        if($res[0]['avatar']==null){
            $this->conexion->modificar("jugadores","avatar","'".$imagen."'","id='".$_SESSION['id']."'");
            $_SESSION['error']="Avatar creado con éxito";
            header("location:index.php");
        }else{
            unlink("img/avatar/".$res[0]['avatar']);
            $this->conexion->modificar("jugadores","avatar","'".$imagen."'","id='".$_SESSION['id']."'");
            $_SESSION['error']="Avatar modificado con éxito";
            header("location:index.php");
        }
    }
}