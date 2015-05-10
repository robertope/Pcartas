<?php
require_once 'modelo/m.BdCon.php';

class Tienda{
    private $conexion;
    
    //Constructor que inicia la conexion con la BD
    function  tienda(){
        $this->conexion = new Conexion();
        $this->conexion->Conexion();
    }
    
    //Destructor que finaliza la conexion con la BD
    function __destruct(){
        $this->conexion->desconexion();
    }
    
    public function mostrarTienda(){
        $paquetes=$this->conexion->consultar("*","paquetes");
        $pagina="<div id='paquetes'>";
        foreach ($paquetes as $paquete){
            $pagina= $pagina."<div class='paquete' id='paquete".$paquete['id_paquete']."' ><img src='img/paquetes/".$paquete['imagen']."'/><h4>".$paquete['nombre_paquete']."</h4><h5>".$paquete['precio_monedas'].
             " Mo</h5><h5>".$paquete['precio_dinero']." €</h5></div>";
        }
        $pagina=$pagina."</div>";
        return $pagina;
    }
}