<?php
//Clase para validar los datos de los formularios

class Validador{
	
	public function texto($valor){
		// Quitamos espacios en blanco al principio y al final, convertimos elementos especiales de html 
		$valor= $valor? strip_tags((trim(htmlspecialchars($valor,ENT_QUOTES,"UTF-8")))):"";
		if (get_magic_quotes_gpc()){
			$valor = stripcslashes($valor);
		}
		//Si despues de quitar espacios en blanco el valor contiene algo lo devolvemos, en caso contrario devolvemos false;
		if($valor!=""){
			return $valor;
		}else{
			return false;
		}
	}
	
	public function numero($valor){
		//Comprobamos que el valor sea un número.
		if(is_numeric($valor)){
			return $valor;
		}else{
			return false;
		}
	}
	
	public function mail($valor){
		//Comprobamos que sea un mail. 
		$patron= "/^(.+\@.+\..+)$/";
		if (preg_match($patron, $valor)){
			return $valor;
		}else{
			return false;
		}
	}
}