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
             " Mo</h5><h5>".$paquete['precio_dinero']." €</h5></div><div class='mPaquete' id='".$paquete['id_paquete']."'style='heigth:0px; width:0px;position:absolute; overflow:hidden;'> <img src='img/paquetes/".$paquete['imagen']."'/><div class='descripcion>"
                     .$paquete['descripcion']."</div><div id='pbotones'><button id='bMonedas'>Pagar con monedas</button><button id='bDinero'>Pagar con dinero</button></div></div>";
        }
        $pagina=$pagina."</div>";
        return $pagina;
    }
}