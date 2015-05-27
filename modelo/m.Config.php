<?php

//Creamos una clase de configuraci�n con la informaci�n de la BD y la hoja de estilo
class Config{
	static public $bd_hostname= "localhost";
	static public $bd_user="root";
	static public $bd_pass="";
	static public $bd_bd="crystalchronicles";
	static public $css = "v.estilo2.css";
	
//Configuracion del smtp para el envio de mails	
	static public $smtp_host= "smtp.gmail.com";
	static public $smtp_port= 465;
	static public $smtp_secure= "ssl";
	static public $smtp_log= "crystalchroniclestgc@gmail.com";
	static public $smtp_pass= "crystalchronicles2015.";
}
?>