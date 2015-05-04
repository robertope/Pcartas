<?php
require_once 'plugin/PHPMailer/class.phpmailer.php';
require_once 'plugin/PHPMailer/class.smtp.php';
require_once 'modelo/m.Config.php';

//clase para mandar mails utilizando phpmailer
class Mail{
    private $mail;
    
    function mail(){
        $this->mail= new phpmailer();
        $this->mail->CharSet = "UTF-8";
        $this->mail->Mailer = "smtp";
        $this->mail->Host = Config::$smtp_host;
        $this->mail->Port= Config::$smtp_port;
        $this->mail->SMTPSecure = Config::$smtp_secure;
        $this->mail->SMTPAuth = true;
        $this->mail->Username = Config::$smtp_log;
        $this->mail->Password = Config::$smtp_pass;
        $this->mail->WordWrap = 79;
        $this->mail->Encoding = 'quoted-printable';
        $this->mail->FromName = "Crystal Chronicles";
        $this->mail->isHTML(true);
    }
    
    public function mailRegistro($direccion,$codigo){
        $mensaje= "Te has registrado con exito en Crystal Chronicles TGC. <br/> Para finalizar el registro haz click en este link <br/> localhost\PCartas\index.php?a=".$codigo."'";
        $this->mail->From="no-reply@CrystalChronicles.com";
        $this->mail->Sender ="info@CrystalChronicles.com";
        $this->mail->Subject = "Confirmación de registro";
        $this->mail->MsgHTML($mensaje);
        $this->mail->AddAddress($direccion);
        $exito = $this->mail->Send();
        $intentos=1;
        while ((!$exito) && ($intentos < 2)) {
            sleep(3);
            $exito = $this->mail->Send();
            $intentos=$intentos+1;
        }
        if(!$exito)
        {
            $_SESSION['error']="Problemas enviando correo electrónico".Config::$smtp_host.$this->mail->ErrorInfo;
            return false;
            
        }else{
            
            $_SESSION['error']="Mensaje enviado con exito";
            return true;
        }        
    }
}