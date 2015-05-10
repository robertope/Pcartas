<?php

require_once '/modelo/m.Config.php';
require_once 'c.sesion.php';
require_once 'c.noticias.php';
require_once 'c.registro.php';
require_once 'c.mandarMail.php';
require_once 'c.usuario.php';

//Ese es el controlador principal o frontal.
//por el pasan casi todas las acciones que realiza la página
//En las funciones de muestra de contenidos lo que se hace es cargar una plantilla y sustituir los contenidos
class Principal {

    //Funcion que carga el código en una variable.
    private function cargar($pagina){
        return file_get_contents($pagina);
    }
    
    //Redireccion a la pagina de inicio
    private function indice(){
        header("location:index.php");
    }
    
    //Funcion para cargar la plantilla, el estilo y los elementos comunes
    private function plantilla($estilo="",$titulo="",$pie="",$botones="",$title=""){
        //Cargamos la plantilla en una variable
        $pagina= $this->cargar("vista/v.plantilla.php");
        if($estilo==""){
            $pagina= preg_replace('/\#ESTILO\#/ms', "vista/css/".Config::$css, $pagina);
        }
        if($titulo==""){
            $titulo=$this->Cargar("vista/v.header.php");
            $pagina= preg_replace('/\#TITULO\#/ms', $titulo, $pagina);
        }
        if($pie==""){
            $pie=$this->cargar("vista/v.pie.php");
            $pagina= preg_replace('/\#PIE\#/ms', $pie, $pagina);
        }
        if($botones==""){
            if(isset($_SESSION['id'])&& $_SESSION['id']!= " "){
                $pagina= preg_replace('/\#BOTONES\#/ms', $this->cargar("vista/v.botones.zusu.php"), $pagina);
            }else{
                $pagina= preg_replace('/\#BOTONES\#/ms', $this->cargar("vista/v.botones.php"), $pagina);
            }
        }
        if($title==""){
            $pagina= preg_replace('/\#TITLE\#/ms', $this->cargar("vista/v.title.php"), $pagina);
        }
        if(isset($_SESSION['id'])&& $_SESSION['id']!= " "){
            $sesion = new Sesion();
            $mantenerS = $sesion->mantenerS();
            $pagina= preg_replace('/\#LOGIN\#/ms',$this->cUsuario($mantenerS), $pagina);
        }else{
            $pagina= preg_replace('/\#LOGIN\#/ms', $this->cargar("vista/v.login.php"), $pagina);
        }
        $pagina= preg_replace('/\#REDES\#/ms', $this->cargar("plugin/paypal/boton.donacion.php"), $pagina);
        if(isset($_SESSION['error'])){
            $script="<script> e='". $_SESSION['error']."'; </script>";
            $_SESSION['error']=" ";
            return $pagina.$script;
        }
        return $pagina;
    }
    
    //Funcion para cargar el indice
    public function cIndice(){
        $pagina= $this->plantilla();
        $pagina= preg_replace('/\#CONTENIDO\#/ms', $this->cargar("vista/pages/v.index.php"),$pagina);
        echo $pagina;
    }
    
    //funcion para iniciar la sesion
    public function inSesion($n,$p="",$r=false){
        //si la sesion esta iniciada no intentamos iniciar sesion
        if(!isset($_SESSION['ok'])|| $_SESSION['ok']!="ok"){
            //Comprobamos si el password esta en blanco, lo que querra decir que venimos del recuerdo de sesion
            $controlador= new Sesion();
            if($p == ""){
                $res=$controlador->recuerdoS($n);
               if($res){
                   $this->indice();
               }else{
                 $_COOKIE['recuerdo']="";
                 $this->indice();
               }
            }else{
                $res=$controlador->iniciarS($n,$p,$r);
                if($res){
                    $this->indice();
                }else{
                    $this->indice();
                }
            }
        }else{
            $this->indice();
        }
    }
    
    //Funcion para cargar el formulario de registro
    public function cRegistro(){
        $pagina = $this->plantilla();
        $pagina= preg_replace('/\#CONTENIDO\#/ms', $this->cargar("vista/v.form.registro.php"),$pagina);
        echo $pagina;
    }
    
    //Funcion para cargar la informacion del usuario
    public function cUsuario($res){
        $zusu = $this->cargar("vista/v.zusu.php");
        $zusu= preg_replace('/\#NOMBRE\#/ms', $res[0]['nombre'], $zusu);
        $zusu= preg_replace('/\#MONEDAS\#/ms', $res[0]['monedas'], $zusu);
        $zusu= preg_replace('/\#DINERO\#/ms', $res[0]['dinero'], $zusu);
        echo $zusu;
    }
    
    //Funcion para cerrar la sesion
    public function cerSesion(){
        $sesion = new Sesion();
       if( $sesion->cerrarS()){
           $this->indice();
       }else{
           $_SESSION['error']="Error al intentar cerrar la sesion";
           $this->indice();
       }
    }
    
    //Funcion para mostrar las noticias
    public function cNoticia($p=1){
        $noticias = new Noticias();
        echo $noticias->vernoticias($p);
        
    }
    
    //funcion para comprobar un mail
    public function comprobarM($mail){
        $reg = new Registro();
        $res= $reg->comprobarM($mail);
        return $res;
    }
    
    //funcion para insertar un nuevo usuario
    public function inRegistro($id,$pass,$mail,$nomb,$pais){
        $reg = new Registro();
        $res= $reg->registrar($id,$pass,$mail,$nomb,$pais);
        if($res){
            $Smail = new Mail();
            if($Smail->mailRegistro($mail,session_id())){
                $this->indice();
            }else{
                $this->indice();
            }
        }
    }
    
    //Funcion para mostrar una noticia
    public function vNoticia($n){
        $noticia= new Noticias();
        $res =  $noticia->noticia($n);
        if($res){
           $texto=$this->cargar("vista/pages/v.noticia.php");
           $texto= preg_replace('/\#NTITULO\#/ms',$res[0]['titulo'],$texto);
           $texto= preg_replace('/\#NTEXTO\#/ms',$res[0]['contenido'],$texto);
           $pagina= $this->plantilla();
           $pagina= preg_replace('/\#CONTENIDO\#/ms', $texto,$pagina);
           echo $pagina;
        }else{
            $_SESSION['error']= "Ha ocurrido un error al cargar la noticia";
            $this->indice();
        }
           
    }
    
    //Funcion para activar la cuenta de usuario
    public function activarR($codigo){
        $reg= new Registro();
        $reg->activar($codigo);
        if($reg){
            $this->indice();
        }else{
            $this->indice();
        }
        
    }
    
    //Funcion para mostrar el perfil del jugador
    public function mostrarPerfil(){
        $sesion = new Sesion();
        $usuario = new Usuario();
        $res = $sesion->mantenerS();
        $plantilla = $this->cargar("vista/pages/v.perfil.php");
        $plantilla = preg_replace('/\#NOMBRE\#/ms',$res[0]['nombre'],$plantilla);
        if($res[0]['avatar']==null){
            $plantilla = preg_replace('/\#\IMAGEN#/ms',"<img src='img/perfil.png'></img>",$plantilla);
        }else{
            $plantilla = preg_replace('/\#\IMAGEN#/ms',"<img src='img/avatar/".$res[0]['avatar']."'></img>",$plantilla);
        }
        $plantilla = preg_replace('/\#CORREO\#/ms',$res[0]['mail'],$plantilla);
        $plantilla = preg_replace('/\#PAIS\#/ms',$res[0]['pais'],$plantilla);
        $plantilla = preg_replace('/\#MONEDAS\#/ms',$res[0]['monedas'],$plantilla);
        $plantilla = preg_replace('/\#DINERO\#/ms',$res[0]['dinero'],$plantilla);
        $datos=$usuario->perfil($res);
        $plantilla = preg_replace('/\#NCARTAS\#/ms',$datos[0],$plantilla);
        $plantilla = preg_replace('/\#NMAZOS\#/ms',$datos[1],$plantilla);
        echo $plantilla;
        
        
    }
}
?>