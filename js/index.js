//Agregamos los manejadores
$(document).ready(function(){
	$("#inses").click(init);
	$("#cerses").click(close);
	$("#noticias").click(function(){
		mostrarN(i)
	});
/*	$("#mail").blur(function(){
		comprobar($("#mail").val());
	})*/
	mError(e);
});

var e="";
var i= 1;

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

	