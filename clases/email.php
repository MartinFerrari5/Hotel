<?php
namespace Classes;
use PHPMailer\PHPMailer\PHPMailer ;
class Email {
    public $email;
    public $nombre;
    public $token;
    public function __construct($email, $nombre, $token){
        $this->email=$email;
        $this->nombre=$nombre;
        $this->token=$token;
    }
    public function enviar(){
        // CREAR OBJETO DEL EMAIL
        $mail=new PHPMailer();

        //PROTOCOLO DE ENVIO DE EMAIL
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '72ec8bc52185c8';
        $mail->Password = '579c5ca88edb6f';
        // SETEAR USO DE HTML
        $mail->isHTML();
        $mail->CharSet='UTF-8';
        // Quien envia el mail
        $mail->setFrom('tincho@gmail.com');
        $mail->addAddress('tincho@gmail.com','Lebarba.com');
        $mail->Subject='Confirma tu mail';
        $contenido="<html>";
        $contenido.="<p> <b>". $this->nombre."</b> 
        Confirma tu email</p>";
        $contenido.= "<a href='http://localhost:3000/Secciones/logIn/token.php?token=" .$this->token . "'>Confirmar cuenta </a>";
        $contenido.="</html>";
        $mail->Body=$contenido;
        // ENVIAR
        $mail->send();

    }
    public function recover(){
        // CREAR OBJETO DEL EMAIL
        $mail=new PHPMailer();

        //PROTOCOLO DE ENVIO DE EMAIL
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '72ec8bc52185c8';
        $mail->Password = '579c5ca88edb6f';
        // SETEAR USO DE HTML
        $mail->isHTML();
        $mail->CharSet='UTF-8';
        // Quien envia el mail
        $mail->setFrom('tincho@gmail.com');
        $mail->addAddress('tincho@gmail.com','Lebarba.com');
        $mail->Subject='Restablezca su password';
        $contenido="<html>";
        $contenido.="<p> <b>". $this->nombre."</b> 
        Restablece tu password</p>";
        $contenido.= "<a href='http://localhost:3000/Secciones/logIn/cambiarEnd.php?token=" .$this->token . "'>New Password </a>";
        $contenido.="</html>";
        $mail->Body=$contenido;
        // ENVIAR
        $mail->send();

    }
}