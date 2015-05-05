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
    
    //Funcion que muestra todas las noticias
    public function vernoticias($n){
        $noticias=$this->conexion->consultar("*","noticia","","fecha DESC");
        $pagina="";
        $nNoti=intval(count($noticias)/10)+1;
        for($i=0;($i< count($noticias)&& $i<10)||($i+(($n-1)*10) > count($noticias));$i++){
            $pagina=$pagina."<div id='noticia'><a href= index.php?noti=".$noticias[$i+(($n-1)*10)]['id']."><h1>".$noticias[$i+(($n-1)*10)]['titulo']."</h1></a>";
            $pagina=$pagina."</div>";
        }
        $pagina=$pagina."<hr/><h3>pag:".$n;
        if(($n-1)!=0){
            $pagina=$pagina." <a href='index.php?n=1'>&lt;&lt;</a><a href='index.php?n=".($n-1)."'>".($n-1)."</a>";
        }
        if(($n+1)<$nNoti){
            $pagina=$pagina."...<a href='index.php?n=".($n+1)."'>".($n+1)."</a><a href='index.php?n=".$nNoti."'>"."&gt;&gt;</a>";
        }
        echo $pagina;
    }
    
    //Funcion que muestra una noticia
    public function noticia($n){
        $res=$this->conexion->consultar("*","noticia","id=".$n);
        if($res){
            return $res;
        }else{
            return false;
        }
    }
}