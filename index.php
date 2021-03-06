<?php

//Se incluyen las páginas necesarias
require_once 'controlador/c.Principal.php';

//Iniciamos o recuperamos sesion
if(session_id() != ""){
    session_id(session_id());
}else{
    session_start();
}
echo "<meta charset='UTF-8'>";
//Creamos una instancia del controlador principal
$controlador= new Principal();

if(isset($_SESSION['error'])){
    echo"<script>e='".$_SESSION['error']."';</script>";
}

$p=0;

if(isset($_POST['Cavatar'])){
    $directorio="img/avatar/";
    if(is_uploaded_file($_FILES['avatar']['tmp_name'])){
        $a_nombre=$_FILES['avatar']['name'];
        $p_archivo=$_FILES['avatar']['tmp_name'];
        if($_FILES['avatar']['size']<1000000){
            $a_type=substr($a_nombre, strlen($a_nombre)-3,strlen($a_nombre));
            if(strtoupper($a_type) != "JPG"){
                $_SESSION['error']="el archivo cargadono no esta en JPG";
                header("location:index.php");
            }else{
                $nombre=$_SESSION['id'].$a_nombre;
            move_uploaded_file($p_archivo, $directorio.$nombre);
            $controlador->cambiarAvatar($nombre);
            
           }   
        }else{
                    $_SESSION['error']="el archivo cargado es mayor de 1MB";
                    header("location:index.php");
            }
    }else{
        $_SESSION['error']="El archivo no ha sido cargado mediante el formulario";
        header("location:index.php");
    }
}else{
    if(isset($_POST['crearN'])){
       $controlador->guardarNoticia($_POST['nombre'],$_POST['noticia']);
    }
    if(isset($_GET['nc'])){
        $controlador->crearNoticia();
    }else{
        if(isset($_POST['cid'])){
            $controlador->cartaMazo($_POST['cid'],$_POST['copias'],$_POST['mazo']);
        }else{
            if(isset($_POST['nMazo'])){
                $controlador->crearMazo($_POST['nMazo'],$_POST['descMazo']);
            }else{
                //Llamada para crear una baraja
                if(isset($_GET['crear'])){
                    $controlador->barajaCrear();
                }else{
                    //Llamada para mostrar las barajas de un jugador
                    if(isset($_GET['b'])){
                        $controlador->barajas();
                    }else{
                        //llamada para comprar un paquete
                        if(isset($_POST['tipo'])){
                            $controlador->comprar($_POST['tipo'],$_POST['paquete']);
                        }else{
                            //Llamada para mostrar la tienda
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
                        }
                    }
                } 
            }
        }
    }
}

?>