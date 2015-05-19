function manejadores2(){
	$(".imagen").click(function(){
		mostrar(this);
	});
	$("#puestas img").click(function(){
		mostrar(this);
	});
}

function mostrar(e){
	elemento=e.innerHTML;
	$("#error").show("slow");
	$("#error").html(elemento);
	$("#error").css({"z-indez": "999999", "position" : "absolute","height":"100%","width":"100%","margin-top":"10%"});
	$("#error").click(cerrar2);
}

function cerrar2(){
	$("#error").click("");
	cerrarCarta(this);
}

function cerrarCarta(e){
	$(e).hide("slow");
}