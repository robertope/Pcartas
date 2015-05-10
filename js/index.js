//Agregamos los manejadores
$(document).ready(function(){
	manejadores();
});

var e="";
var i= 1;
var victorias=0;

function manejadores(){
	$("#inses").click(init);
	$("#cerses").click(close);
	$("#bnoticias").click(function(){
		mostrarN(i)
	});
	$("#binicio").click(inicio);
	$("#breg").click(registro);
	$("#bperfil").click(perfil);
	$("#btienda").click(tienda);
	$("#bbaraja").click();
	$("#bforo").click();
	$("#botonG").click(grafico);
	mError(e);
	
	$(".paquete img").click(function(){
		mostrarPaquete(this);
	});
	
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
	$("#"+elemento).toggle(100);
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
	