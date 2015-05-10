<?php

//Se incluyen las páginas necesarias
require_once 'controlador/c.Principal.php';

//Iniciamos o recuperamos sesion
session_start();

//Cargamos la libreria de jquery
echo "<script src='http://code.jquery.com/jquery-1.10.1.min.js'></script>";
echo "<script src='js/index.js'></script>";
echo "<meta charset='UTF-8'>";
//Creamos una instancia del controlador principal
$controlador= new Principal();

if(isset($_SESSION['error'])){
    echo"<script>e='".$_SESSION['error']."';</script>";
}

$p=0;

if(isset($_POST['tienda'])){
    $controlador->mostrarTienda();
}else{
    //Llamada para mostrar el perfil del jugador
    if(isset($_POST['perfil'])){
        $controlador->mostrarPerfil();
    }else{
        //llamada para comprobar la clave de activación
        if(isset($_GET['a'])){
            $controlador->activarR($_GET['a']);
        }else{
            //llamada a la comprobacion de un mail
            if(isset($_GET['m'])){
                $x =$controlador->comprobarM($_GET['m']);
               echo"<div id='resultado'>". $x ."</div>";
            }else{
                //Llamada al validador del registro
                if(isset($_POST['id'])){
                    $controlador->inRegistro($_POST['id'],$_POST['pass'],$_POST['mail'],$_POST['nombre'],$_POST['pais']);
                }else{
                    //Si estamos en otra pagina se lo haremos saber desde este punto
                    if (isset($_GET['n'])){
                        $p= $_GET['n'];
                        echo"<script> i= ".$p.";</script>";
                        $controlador->cNoticia($p);
                    }else{
                        //Llamada a una noticia
                        if(isset($_GET['noti'])){
                           $pagina=$controlador->vNoticia($_GET['noti']);
                        }else{
                            //llamada a la funcion para cerrar sesion
                            if(isset($_GET['c'])){
                                $_SESSION['ok']=" ";
                                $_SESSION['error']= "Sesión cerrada correctamente";
                                $controlador->cerSesion();
                            }
                            //Comprobamos si venimos de iniciar sesion o si tenemos recordada la sesion
                            if(isset($_COOKIE['recuerdo'])&& $_COOKIE['recuerdo']!=""){
                                $controlador->inSesion($_COOKIE['recuerdo']);
                            }else{
                                if(isset($_POST['ini'])||isset($_POST['reg'])){
                                    if( isset($_POST['ini'])){
                                        $r=false;
                                        if(isset($_POST['recuerdo'])){
                                            $r=true;
                                        }
                                        $controlador->inSesion($_POST['nom'],$_POST['pass'],$r);
                                    }
                                    if(isset($_POST['reg']) && $_POST['reg']!=""){
                                        $controlador->cRegistro();
                                    }
                                }else{
                                    //llamamos a cargar el indice
                                    $controlador->cIndice();
                                }  
                            }
                        }
                    }
                } 
            }
        }
    }
}

?>