//Agregamos los manejadores
$(document).ready(function(){
	manejadores();
});

var e="";
var i= 1;
var victorias=0;
var puestas= [];
var cantidad= [];
var tipos={p:0,l:0,j:0,b:0};

function manejadores(){
	$("#inses").click(init);
	$("#cerses").click(close);
	$("#bnoticias").click(function(){
		mostrarN(i)
	});
	$(".imagen").dblclick(function(){
		agregar(this);
	});
	$("#binicio").click(inicio);
	$("#breg").click(registro);
	$("#bperfil").click(perfil);
	$("#btienda").click(tienda);
	$("#bbarajas").click(baraja);
	$("#bcrearb").click(crear);
	$("#bforo").click();
	$("#botonG").click(grafico);
	mError(e);
	$(".paquete img").click(function(){
		mostrarPaquete(this);
	});
	$(".poner").click(function(){
		agregar(this);
	});
	$("#guardarMazo").click(validarMazo);
	manejadores2();
/*	$("#mail").blur(function(){
		comprobar($("#mail").val());
	})*/
}


//Funcion para cargar el registro
function registro(){
	
	$.ajax({
		  url: 'vista/v.form.registro.php',
		  global:false,
		  type: 'GET',
		  async: true,
		  data: '',
		  success: function(result){
			  $("#contenido").html(result);
			  manejadores();
		  },
		  error: function(){
			  alert("error");
		  }
		});	
}

//funcion para cargar el index
function inicio(){
	$.ajax({
		  url: 'vista/pages/v.index.php',
		  global:false,
		  type: 'GET',
		  async: true,
		  data: '',
		  success: function(result){
			  $("#contenido").html(result);
			  manejadores();
		  },
		  error: function(){
			  alert("error");
		  }
		});	
}

//Funcion que muestra el login en el div de contenido
function init(){
	$.ajax({
		  url: 'vista/v.form.login.php',
		  global:false,
		  type: 'GET',
		  async: true,
		  data: '',
		  success: function(result){
			  $("#contenido").html(result);
			  manejadores();
		  },
		  error: function(){
			  alert("error");
		  }
		});	
}

//Funcion para mostrar los mensajes de error
function mError(e){
	if(e.trim()!=""){
		var boton= "<br/><input type='button' value='OK' onclick='cerrar(this)'/>";
		$("#error").html(e+boton);
	}
}

//Funcion que hace desaparecer las ventanas "emergentes"
function cerrar(e){
	$(e).parent().hide("slow");
}

//Funcion para el cierre de la sesion
function close(){
	$.ajax({
		  url: 'index.php',
		  global:false,
		  type: 'GET',
		  async: true,
		  data: 'c=c',
		  success: function(result){
			  $("body").html(result);
			  location.reload();
		  },
		  error: function(){
			  alert("error");
		  }
		});

}

//Funcion para validar el formulario de inscripcion
function validarform(){
	
	var id= $("#id");
	var nombre = $("#nombre");
	var pass = $("#pass");
	var repass = $("#repass");
	var mail = $("#mail");
	
	if(id.val()== null|| id.val().length == 0 || /^\s*$/.test(id.val())){
		alert("El id no puede estar vacio");
		id.focus();
		return false;
	}else{
		if(nombre.val()== null|| nombre.val().length == 0 || /^\s*$/.test(nombre.val())){
			alert("El nombre no puede estar vacio");
			nombre.focus();
			return false;
		}else{
			if(/^(.+\@.+\..+)$/.test(mail.val())){
				if(pass.val() == repass.val()){
						return true;
				}else{
					alert("Las contraseñas no coinciden");
					pass.focus();
					return false;
				}
			}else{
				alert("La dirección de correo no es correcta");
				mail.focus();
				return false;
			}
		}
	}
}

//Funcion para mostrar todas las noticias en orden cronologico inverso
function mostrarN(i){
	$.ajax({
		  url: 'index.php',
		  global:false,
		  type: 'GET',
		  async: true,
		  data: 'n='+i,
		  success: function(result){
			  $("#contenido").html(result);
			  manejadores();
		  },
		  error: function(){
			  alert("error");
		  }
		});
}

//Funcion que comprueba si un mail esta en la BD
function comprobar(mail){
	$.ajax({
		  url: 'index.php',
		  global:false,
		  type: 'GET',
		  async: true,
		  data: 'm='+mail,
		  success: function(result){
			  alert($("#resultado").html());
			  alert(result);
			  switch($("#resultado").html()){
			  case "error":
				  $("#email").html("<br/><span>No es una dirección de correo válida</span>");
				  break;
			  case "bien":
				  $("#email").html($("#email").html()+"<br><span>Dirección de correo disponible</span>");
				  break;
			  case "mal":
				  $("#email").html($("#email").html()+"<br><span>Dirección de correo no disponible</span>");
				  break;
			  }
		  },
		  error: function(){
			  alert("error");
		  }
		});
}

//Funcion para cargar el perfil
function perfil(){
	$.ajax({
		  url: 'index.php',
		  global:false,
		  type: 'POST',
		  async: true,
		  data: 'perfil=1',
		  success: function(result){
			  $("#contenido").html(result);
			  manejadores();
		  },
		  error: function(){
			  alert("error");
		  }
		});
}

//Funcion para cargar la tienda
function tienda(){
	$.ajax({
		  url: 'index.php',
		  global:false,
		  type: 'POST',
		  async: true,
		  data: 'tienda=1',
		  success: function(result){
			  $("#contenido").html(result);
			  manejadores();
		  },
		  error: function(){
			  alert("error");
		  }
		});
}

function mostrarPaquete(e){
	
	var id= e.parentNode.getAttribute('id');
	longitud=id.length-1;
	elemento=(id.substring(longitud));
	$("#"+elemento).css({"heigth":"100%","width":"100%"});
	$("#"+elemento).show(1000);
	$("#"+elemento+" #bCerrar").click(function(){
		$("#"+elemento).hide(1000);
	});
	$("#"+elemento+" #bMonedas").click(function(){
		if(confirm("¿Quieres comprar este paquete con monedas?")){
			if(confirm("¿Seguro?")){
				pagar("m",elemento);
			}
		}
	});
	$("#"+elemento+" #bDinero").click(function(){
		if(confirm("¿Quieres comprar este paquete con Dinero?")){
			if(confirm("¿Seguro?")){
				pagar("d",elemento);
			}
		}
	});
}


//Funcion que muestra el grafico de victorias/derrotas
function grafico(){
	can= document.getElementById("grafico");
	var ctx=can.getContext("2d");
	derrotas= 360-victorias;
	rad= (Math.PI/180)*victorias;
	rad2= (Math.PI/180)*derrotas;
	ctx.beginPath();
	ctx.moveTo(75,75);
	ctx.arc(75,75,60,0,rad,true);
	ctx.lineWidth=3
	ctx.fillStyle="green";
	ctx.closePath();
	ctx.stroke();
	ctx.fill();
	
	var ctx2=can.getContext("2d");
	ctx2.fillStyle="red";
	ctx2.beginPath();
	ctx2.moveTo(75,75);
	ctx2.arc(75,75,60,0,rad2,false);
	ctx2.closePath();
	ctx2.stroke();
	ctx2.fill();
	
}

//Funcion para pagar un paquete
function pagar(t,e){
	$.ajax({
		  url: 'index.php',
		  global:false,
		  type: 'POST',
		  async: true,
		  data: 'tipo='+t+"&paquete="+e,
		  success: function(result){
			  $("#"+e+" .descripcion2").html(result);
			  $("#"+e+" .descripcion2").css({"heigth":"100%","width":"100%","z-index":"999"});	
			  $("#"+e+" .descripcion2").show(1000);
			  $("#"+e+" .descripcion2").click(function(){
				  $("#"+e+" .descripcion2").html("");
				  $("#"+e+" .descripcion2").hide(1000);
			  });
			  manejadores();
		  },
		  error: function(){
			  alert("fallo");
		  }
		});
}

//Funcion para mostrar las barajas de un jugador
function baraja(){
	$.ajax({
		  url: 'index.php',
		  global:false,
		  type: 'GET',
		  async: true,
		  data: 'b=b',
		  success: function(result){
			  $("#contenido").html(result);
			  manejadores();
		  },
		  error: function(){
			  alert("error");
		  }
		});
}

//funcion para crear una baraja
function crear(){
	$.ajax({
		  url: 'index.php',
		  global:false,
		  type: 'GET',
		  async: true,
		  data: 'crear=b',
		  success: function(result){
			  $("#contenido").html(result);
			  var puestas= [];
			  var cantidad=[];
			  var tipos=" ";
			  var tipos={p:0,l:0,j:0,b:0};
			  manejadores();
		  },
		  error: function(){
			  alert("error");
		  }
		});
}

//Funcion para arrastrar
function arrastrar(ev){
	ev.dataTransfer.setData("text", ev.target.parentNode.parentNode.id);
}
	
function agregar(e){
	 var data = e.parentNode.id;
	 agregarCarta(data);
}

function soltar(ev){
	 ev.preventDefault();
	 var data = ev.dataTransfer.getData("text");
	 agregarCarta(data);
	 
}

function agregarCarta(data){
	$dato= $("#"+data+ " .imagen" );
	 $numero=$("#"+data+ " .cantidad" );
	 max= parseInt($numero.attr('max'));
	 var indice;
	 var posicion=0;
	 esta=false;
	 if(parseInt($numero.val())>0){
		 for(i=0; i< puestas.length; i++){
			 if(puestas[i]== data){
				 cantidad[i]= parseInt(cantidad[i]) + parseInt($numero.val());
				 posicion= i;
				 if(cantidad[i]>max){
					 cantidad[i]=max;
				 }
				 esta=true;
				 break;
			 }
		 }
		 if(esta){
			 $("#numero"+posicion).html( $dato.html() +"</br><span class='copias'>"+ cantidad[posicion]+"</span><input type='hidden' value='"+ $("#"+data+" .tipo").val() + "'><input type='hidden' value='"+data+"' class='id'>");
			 tipoCarta= $("#"+data+" .tipo").val();
			 switch(tipoCarta){
			 case "p":
				 tipos['p']= parseInt(tipos['p'])+ parseInt(cantidad[posicion]);
				 break;
			 case "l":
				 tipos['l']= parseInt(tipos['l'])+ parseInt(cantidad[posicion]);
				 break;
			 case "j":
				 tipos['j']= parseInt(tipos['j'])+ parseInt(cantidad[posicion]);
				 break;
			 case "b":
				 tipos['b']= parseInt(tipos['b'])+ parseInt(cantidad[posicion]);
				 break;
			 }
		 }else{
			 indice=puestas.length;	 
			 puestas[indice]=data;
			 cantidad[indice]=$numero.val();
			 carta= "<div id='numero"+indice+"' ondblclick='quitar(this)'>" + $dato.html() +"</br><span class='copias'>"+ $numero.val() +"</span><input type='hidden' value='"+ $("#"+data+" .tipo").val() + "'><input type='hidden' value='"+data+"' class='id'></div>";
			 $("#puestas").html($("#puestas").html()+carta);
			 tipoCarta= $("#"+data+" .tipo").val();
			 switch(tipoCarta){
			 case "p":
				 tipos['p']= parseInt(tipos['p'])+ parseInt($numero.val());
				 break;
			 case "l":
				 tipos['l']= parseInt(tipos['l'])+ parseInt($numero.val());
				 break;
			 case "j":
				 tipos['j']= parseInt(tipos['j'])+ parseInt($numero.val());
				 break;
			 case "b":
				 tipos['b']= parseInt(tipos['b'])+ parseInt($numero.val());
				 break;
			 }
		 }
	 }
}

function allowDrop(ev) {
    ev.preventDefault();
}

function maximo(e){
	if(parseInt(e.value) > parseInt(e.getAttribute('max'))){
		e.value= e.getAttribute('max');
	}
}

function validarMazo(){
	if($("#nombreMazo").val().trim()==""){
		alert("El nombre no puede estar vacio");
		return false;
	}else{
		if(tipos['p']<10){
			alert("faltan "+ (10-tipos['p'])+" cartas de personaje");
			return false;
		}else if(tipos['p']>10){
			alert("sobran "+ (tipos['p']-10)+" cartas de personaje");
			return false;
		}else{
			if(tipos['l']<30){
				alert("faltan "+ (30-tipos['l'])+" cartas de localizaciones");
				return false;
			}else{
				if(tipos['j']<40){
					alert("faltan "+ (40-tipos['j'])+" cartas de juego");
					return false;
				}else{
					if(tipos['b']<1){
						alert("falta 1 carta de base");
						return false;
					}else if (tipos['b']>1){
						alert("sobran "+ (tipos['b']-1)+" cartas de base");
						return false;
					}else{
						guardarMazo();
					}
				}
			}
		}
	}
}

function guardarMazo(){
	nombre = $("#nombreMazo").val();
	descripcion= $("#descMazo").val();
	$.ajax({
		  url: 'index.php',
		  global:false,
		  type: 'POST',
		  async: true,
		  data: 'nMazo='+nombre+"&descMazo="+descripcion,
		  success: function(result){
			  guardarMazo2(nombre);
		  },
		  error: function(){
			  alert("error");
		  }
		});
}

function guardarMazo2(mazo){
	ventana=document.getElementById('puestas');
	divs= ventana.getElementsByTagName('DIV');
	for(i=0;i<divs.length;i++){
		id= divs[i].getElementsByClassName('id');
		copias= divs[i].getElementsByClassName('copias');
		alert(copias[0].innerHTML +" "+id[0].value);
		$.ajax({
			  url: 'index.php',
			  global:false,
			  type: 'POST',
			  async: true,
			  data: 'cid='+id[0].value+"&copias="+copias[0].innerHTML+"&mazo="+mazo,
			  success: function(result){
			  },
			  error: function(){
				  alert("error");
			  }
			});
	}
	alert('ok');
}

function quitar(e){
	longitud=e.id.length-1;
	elemento= e.id.substring(longitud);
	cantidad[elemento]--;
	tipo=$("#"+e.id+ " input").val();
	tipos[tipo]--;
	if(cantidad[elemento]>0){
		$("#"+e.id+ " span").html(cantidad[elemento]);
	}else{
		$("#"+e.id).html("");
	}
}