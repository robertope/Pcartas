function manejadores2(){
	$(".imagen").click(function(){
		mostrar(this);
	});
	$("#puestas div").click(function(){
		mostrar(this);
	});

}

var control = true;
var control2 = true;

function mostrar(e){
	elemento=e.innerHTML;
	$("#error").show("slow");
	$("#error").html(elemento);
	$("#error").css({"z-indez": "999999", "position" : "absolute","height":"70%","width":"80%","margin-top":"10%","margin-left":"10%"});
	$("#error").click(cerrar2);
}

function cerrar2(){
	$("#error").click("");
	cerrarCarta(this);
}

function cerrarCarta(e){
	$(e).hide("slow");
}

function mostrarF(){
	$("#facebook").css({"animation-name":"facebook","animation-duration":"0.5s","-webkit-animation-name":"facebook","-webkit-animation-duration":"0.5s","display":"inline","width":"550px","height":"550px","z-index":"99999"});
	$("#icofbk").css({"animation-name":"icofacebook","animation-duration":"0.5s","-webkit-animation-name":"icofacebook","-webkit-animation-duration":"0.5s","top":"15%","z-index":"99999"});
	$("#icofbk").off("click");
	$("#icofbk").on("click",function(){
		ocultarF();
	})
}

function ocultarF(){
	$("#facebook").css({"animation-name":"facebook2","animation-duration":"0.5s","-webkit-animation-name":"facebook2","-webkit-animation-duration":"0.5s","display":"inline","width":"0px","height":"0px","z-index":"0"});
	$("#icofbk").css({"animation-name":"icofacebook2","animation-duration":"0.5s","-webkit-animation-name":"icofacebook2","-webkit-animation-duration":"0.5s","top":"35%"});
	$("#icofbk").off("click");
	$("#icofbk").on("click",function(){
		mostrarF();
	})
}

function mostrarT(){
	control=false;
	$("#botones").hide("slow");
	$("#contenido").hide("slow");
	$("#redes2 iframe").css({"animation-name":"twitter","animation-duration":"0.5s","-webkit-animation-name":"twitter","-webkit-animation-duration":"0.5s","display":"inline","width":"550px","height":"550px","z-index":"99999999"});
	$("#icotwt").off("click");
	$("#icotwt").on("click",function(){
		ocultarT();
	});
	if($(window).width()<624){
		$("header").css({"visibility":"hidden"});
	}
}

function ocultarT(){
	control= true;
	$("#botones").show("slow");
	$("#contenido").show("slow");
	$("#redes2 iframe").css({"animation-name":"twitter2","animation-duration":"0.5s","-webkit-animation-name":"twitter2","-webkit-animation-duration":"0.5s","display":"inline","width":"0px","height":"0px","z-index":"0"});
	$("#icotwt").off("click");
	$("#icotwt").on("click",function(){
		mostrarT();
	});
	$("header").css({"visibility":"visible"});
}

function comprobarT(){
	if($(window).width()>1650){
		if(control){
			$("#redes2 iframe").css({"width":"500px","height":"500px"});
			$("#contenido").show("slow");
			$("#botones a").css({"visibility":"visible"});
			$("#botones a").off("click", ocultarM);
			$("header").css({"visibility":"visible"});
		}
	}else if($(window).width()<1650 && $(window).width()>1199 ){
		if(control){
			$("#redes2 iframe").css({"width":"0px","height":"0px"});
			$("#contenido").show("slow");
			$("#botones a").css({"visibility":"visible"});
			$("#botones a").off("click", ocultarM);
		}
		$("header").css({"visibility":"visible"});
	}else{
		if(control2){
			$("#botones a").css({"visibility":"hidden"});
		}	
	}
}

function mostrarM(){
	control2=false;
	$("#contenido").hide("slow");
	$("#botones a").css({"visibility":"visible","animation-name":"menu1","animation-duration":"0.5s","-webkit-animation-name":"menu1","-webkit-animation-duration":"0.5s","width":"100%","height":"100%"});
	$("#botones span").off("click");
	$("#botones span").on("click", ocultarM);
	$("#botones a").on("click", ocultarM);
}

function ocultarM(){
	control2=true;
	$("#contenido").show("slow");
	$("#botones a").css({"animation-name":"menu2","animation-duration":"0.5s","-webkit-animation-name":"menu2","-webkit-animation-duration":"0.5s","visibility":"hidden"});
	$("#botones span").off("click");
	$("#botones span").on("click", mostrarM);
	$("#botones a").off("click", ocultarM);

}

