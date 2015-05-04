<?php

require_once 'modelo/m.BdCon.php';
class Noticias{
    
    private $conexion;
    
    //Constructor que inicia la conexion con la BD
    function  Noticias(){
        $this->conexion = new Conexion();
        $this->conexion->Conexion();
    }
    
    //Destructor que finaliza la conexion con la BD
    function __destruct(){
        $this->conexion->desconexion();
    }
    
    public function vernoticias($n){
        $noticias=$this->conexion->consultar("*","noticia","","fecha DESC");
        $pagina="";
        echo count($noticias);
        echo $n;
        $nNoti=intval(count($noticias)/10)+1;
        for($i=0;($i< count($noticias)&& $i<10)||($i+(($n-1)*10) > count($noticias));$i++){
            $pagina=$pagina."<a href= noticias.php?noti=".$noticias[$i+(($n-1)*10)]['id']."><h1>".$noticias[$i+(($n-1)*10)]['titulo']."</h1></a>";
            $pagina=$pagina."<hr/>";
        }
        $pagina=$pagina."<hr/><h6>pag:".$n;
        if(($n-1)!=0){
            $pagina=$pagina." <a href='noticias.php?n=1'>&lt;&lt;</a><a href='noticias.php?n=".($n-1)."'>".($n-1)."</a>";
        }
        if(($n+1)<$nNoti){
            $pagina=$pagina."...<a href='noticias.php?n=".($n+1)."'>".($n+1)."</a><a href='noticias.php?n=".$nNoti."'>"."&gt;&gt;</a>";
        }
        echo $pagina;
    }
}