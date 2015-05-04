<?php
//Clase que se encargará del acceso a la base de datos
require_once 'm.Config.php';

class Conexion {
    private $conn;

    //Funcion que llama a la funcion de conectar
    public function conexion(){
        $this->conectar();
    }

    //funcion para desconectar la BD
    public function  desconexion(){
        $this->conn->close();
    }

    //Funcion para modificar valor
    public function modificar($tabla,$columna,$valor,$filtro=""){

        //Creamos la consulta
        $consulta= "Update ".$tabla. " set ".$columna." = ".$valor;
        if($filtro!=""){
            $consulta= $consulta. " where ".$filtro;
        }

        //Realizamos la consulta
        $res=$this->conn->query($consulta ) or die("ERROR AL REALIZAR LA MODIFICACION " .$consulta);

        //devolvemos el numero de filas modificadas
        return $this->conn->affected_rows;


    }

    public function insertar($tabla,$valores,$columnas=""){
        if($columnas!=""){
            $consulta= "INSERT INTO ".$tabla." (".$columnas.") VALUES (".$valores.")";
        }else{
            $consulta= "INSERT INTO ".$tabla."  VALUES (".$valores.")";
        }
        $res=$this->conn->query($consulta ) or die ("ERROR AL INSERTAR  :".mysqli_error($this->conn));
        return $res;
    }

    //Funcion para realizar consultas sobre una tabla de la BD
    public function consultar($dato,$tabla,$filtro="",$orden=""){

        //Creamos la consulta
        $consulta="Select ".$dato." From ".$tabla;
        if($filtro!=""){
            $consulta= $consulta." where ".$filtro;
        }
        if($orden!=""){
            $consulta= $consulta." order by ".$orden;
        }

        //Realizamos la consulta
        $res=$this->conn->query($consulta )or die("ERROR AL REALIZAR LA CONSULTA: ".$consulta);
        $i=0;
        $array =  array();
        while ($fila=$res->fetch_array(MYSQLI_BOTH)){
            $array[$i]=$fila;
            $i++;
        }
        //Finalmente devolvemos el array con las filas
        return $array;
    }

    //Funcion para realizar borrados
    public function borrar($tabla,$filtro){
        //Creamos la consulta
        $consulta= "delete from ".$tabla. " where ".$filtro;

        //Realizamos la consulta
       $res=$this->conn->query($consulta ) or die("ERROR AL REALIZAR LA MODIFICACION " .$consulta);

        //devolvemos el numero de filas modificadas
        return $this->conn->affected_rows;

    }
    //funcion para conectar con la bd
    private function conectar(){
        $this->conn = new mysqli(Config::$bd_hostname,Config::$bd_user,Config::$bd_pass,Config::$bd_bd);
        if($this->conn->connect_error){
            die('Error al conectar la BD:'. $this->conn->connect_error);
        }
    }

    //Funcion que devuelve el último indice insertado
    public function indice(){
        return $this->conn->insert_id();
    }
}


?>

