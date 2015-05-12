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
             " Mo</h5><h5>".$paquete['precio_dinero']." €</h5></div><div class='mPaquete' id='".$paquete['id_paquete']."'style='heigth:0px; width:0px;position:absolute; overflow:hidden;'> <img src='img/paquetes/".$paquete['imagen']."'/><div id='pbotones'><button id='bMonedas'>
                     Pagar con monedas</button><button id='bDinero'>Pagar con dinero</button><button id='bCerrar'>Volver</button></div><div class='descripcion'>"
                     .$paquete['descripcion']."</div></div>";
        }
        $pagina=$pagina."</div>";
        return $pagina;
    }
    
    //Funcion para comprar
    public function comprar($t,$p,$res){
        $paquete= $this->conexion->consultar("*","paquetes","id_paquete=".$p);
        if($t=="m"){
            if($res[0]['monedas']>= $paquete[0]['precio_monedas']){
                $restante= $res[0]['monedas']-$paquete[0]['precio_monedas'];
                $filas=$this->conexion->modificar("jugadores","monedas",$restantes,"id='".$res[0]['id']."'");
                if($filas==1){
                    if($paquete[0]['tipo']=='m'){
                        $resultado=abrirPaquete($paquete,$res);
                        if($resultado){
                            return "1";
                        }else{
                            return "error";
                        }
                    }elseif ($paquete[0]['tipo'=='s']){
                        $resultado=abrirSobre($res);
                        if($resultado){
                            return $resultado;
                        }else{
                            return "error";
                        }
                    }else{
                        return "error";
                    }
                }else{
                    return "error";
                }
            }else{
                return "No tienes monedas fuficientes";
            }
        }elseif ($t=="d"){
            if($res[0]['dinero']>= $paquete[0]['precio_dinero']){
                $restante= $res[0]['dinero']-$paquete[0]['precio_dinero'];
                $filas=$this->conexion->modificar("jugadores","dinero",$restantes,"id='".$res[0]['id']."'");
                if($filas==1){
                    if($paquete[0]['tipo']=='m'){
                        $resultado=abrirPaquete($paquete,$res);
                        if($resultado){
                            return "Mazo comprado con éxito";
                        }else{
                            return "error";
                        }
                    }elseif ($paquete[0]['tipo'=='s']){
                        $resultado=abrirSobre($res);
                        if($resultado){
                            return $resultado;
                        }else{
                            return "error";
                        }
                    }else{
                        return "error";
                    }
                }else{
                    return "error";
                }
            }else{
                return "No tienes dinero suficiente";
            }
        }else{
            return "error";
        }
    }
    
    //Funcion para abrir un mazo
    private function abrirPaquete($paquete,$usuario){
        $cartas = $this->conexion->consultar("*","cartas_paquete","id_paquete=".$paquete[0]['id_paquete']);
        $cartasj = $this->conexion->consultar("*","cartas_jugador","id_jugador='".$usuario[0]['id']);
        foreach ($cartas as $carta){
            $esta="false";
            foreach ($cartasj as $cartaj){
                if($carta['id']==$cartaj['id_carta']){
                    $esta=true;
                    break;
                }
                if($esta){
                    $this->conexion->modificar("cartas_jugador","n_copias","n_copias+".$carta['n_copias'],"id_jugador='".$usuario[0]['id']."' and id_carta=".$carta['id_carta']);
                }else{
                    $this->conexion->insertar("cartas_jugador","'".$usuario[0]['id']."',".$carta['id_carta'].",".$carta['n_copias']);
                }
            }
        }
        return true;
    }
    
    //Funcion para abrir un sobre
    
    /*Un sobre contiene 20 cartas
     * 4 raras
     * 6 infrecuentes
     * y 10 comunes
     * de las cuales
     * 3 serán personajes
     * 4 lugares
     * 5 de juego
     * y el restos aleatorias
     */
    
    private function abrirSobre($usuario){
        $sobre = array();
        $p=3;
        $l=4;
        $j=5;
        $ale=8;
        $r=4;
        $in=6;
        $co=10;
        $cartas("*","cartas");
        
        for($i=0;$i<20;$i++){
            $repe=true;
            do{
                
               $ale=rand(1,count($cartas))-1;
               $carta= $cartas[$ale];
                if($carta['rareza']=="r" && $r>0){
                 if($carta['tipo']=="p"&& $p>0){
                     $r= $r -1;
                     $p = $p -1;
                     $sobre[i]=$carta;
                     $repe=false;
                 }elseif ($carta['tipo']=="l"&& $l>0){
                     $r= $r -1;
                     $l = $l -1;
                     $sobre[i]=$carta;
                     $repe=false;
                 }elseif ($carta['tipo']=="j"&& $j>0){
                     $r= $r -1;
                     $j = $j -1;
                     $sobre[i]=$carta;
                     $repe=false;
                 }elseif ($p==0 && $l==0 && j==0 && $ale>0){
                     $r= $r -1;
                     $ale = $ale -1;
                     $sobre[i]=$carta;
                     $repe=false;
                 }  
                  
                }elseif ($carta['rareza']=="i" && $in>0){
                    if($carta['tipo']=="p"&& $p>0){
                        $in= $in -1;
                        $p = $p -1;
                        $sobre[i]=$carta;
                        $repe=false;
                    }elseif ($carta['tipo']=="l"&& $l>0){
                        $in= $in -1;
                        $l = $l -1;
                        $sobre[i]=$carta;
                        $repe=false;
                    }elseif ($carta['tipo']=="j"&& $j>0){
                        $in= $in -1;
                        $j = $j -1;
                        $sobre[i]=$carta;
                        $repe=false;
                    }elseif ($p==0 && $l==0 && j==0 && $ale>0){
                        $in= $in -1;
                        $ale = $ale -1;
                        $sobre[i]=$carta;
                        $repe=false;
                    }
                    
                }elseif ($carta['rareza']=="c" && $co>0){
                    if($carta['tipo']=="p"&& $p>0){
                        $co= $co -1;
                        $p = $p -1;
                        $sobre[i]=$carta;
                        $repe=false;
                    }elseif ($carta['tipo']=="l"&& $l>0){
                        $co= $co -1;
                        $l = $l -1;
                        $sobre[i]=$carta;
                        $repe=false;
                    }elseif ($carta['tipo']=="j"&& $j>0){
                        $co= $co -1;
                        $j = $j -1;
                        $sobre[i]=$carta;
                        $repe=false;
                    }elseif ($p==0 && $l==0 && j==0 && $ale>0){
                        $co= $co -1;
                        $ale = $ale -1;
                        $sobre[i]=$carta;
                        $repe=false;
                    }
                }
            }while($repe);
        }
        
        $cartasj = $this->conexion->consultar("*","cartas_jugador","id_jugador='".$usuario[0]['id']);
        $puesta=array();
        $iti=0;
        foreach ($sobre as $carta){
            $esta="false";
            $repe="false";
            foreach ($cartasj as $cartaj){
                if($carta['id']==$cartaj['id_carta']){
                    $esta=true;
                    break;
                }
                if($esta){
                    $this->conexion->modificar("cartas_jugador","n_copias","n_copias+1","id_jugador='".$usuario[0]['id']."' and id_carta=".$carta['id']);
                }else{
                    for($i=0;$i<count($puesta);$i++){
                        if($puesta[$i]['id']==$carta['id']){
                            $repe=true;
                            break;
                        }
                    }
                    if($repe){
                        $this->conexion->modificar("cartas_jugador","n_copias","n_copias+1","id_jugador='".$usuario[0]['id']."' and id_carta=".$carta['id']);
                    }else{
                        $repe[$iti]=$carta;
                        $iti++;
                        $this->conexion->insertar("cartas_jugador","'".$usuario[0]['id']."',".$carta['id'].",1");
                    }
                }
            }
        }
        return $sobre;
    }
}