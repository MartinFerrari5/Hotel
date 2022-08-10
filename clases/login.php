<?php
namespace Hotel; 
class Login extends ActiveRecord{
    protected static $errores=[];
    protected static $tabla='usuarios';
    protected static $columnaDB=['id','nombre','apellido','question', 'questionAns','mail','password',
'admin','confirmado','token'];
    public $id;
    public $nombre;
    public $apellido;
    public $question; 
    public $questionAns;
    public $mail;
    public $password;
    public $admin;
    public $confirmado;
    public $token;
    public  function __construct($args=[]){
        
        $this->id=$args['id'] ?? null;
        $this->nombre=$args['nombre'] ?? '';
        $this->apellido=$args['apellido'] ?? '';
        $this->question=$args['question'] ?? '';
        $this->questionAns=$args['questionAns'] ?? '';
        $this->mail=$args['mail'] ?? '';
        $this->password=$args['password'] ?? '';
        $this->admin=$args['admin'] ?? '0';
        $this->confirmado=$args['confirmado'] ?? '0';
        $this->token=$args['token'] ?? '';
    }
    public function verificar(){
        if(!$this->nombre){
            self::$errores[]='Debes agregar un nombre';
        }
        if(!$this->apellido){
            self::$errores[]='Debes agregar un apellido';
        }
        if(!$this->question){
            self::$errores[]='Debes agregar una Pregunta clave';
        }
        if(!$this->questionAns){
            self::$errores[]='Debes agregar una Respuesta clave';
        }
        if(!$this->mail){
            self::$errores[]='Debes agregar un mail';
        }
        if(!$this->password){
            self::$errores[]='Debes agregar un password';
        }
        if(strlen($this->password)<10){
            self::$errores[]='Debes agregar un password mayor a 10 caracteres';
        }
        return self::$errores;
    }
    public function passwordHash(){
     $this->password=password_hash($this->password, PASSWORD_BCRYPT);
    
     return $this->password;
    }
    public function passwordVerify($pass){
        $resultado=password_verify( $this->password,$pass);
        return $resultado;
       }
    public function erroresLogeo(){
        if(!$this->mail){
            self::$errores[]='Debes agregar un mail';
        }
        if(!$this->password){
            self::$errores[]='Debes agregar un password';
        }
        return self::$errores;
    }
    public function errorMail(){
        if(!$this->mail){
            self::$errores[]='Debes agregar un mail';
        }
        
        return self::$errores;
    }
    public function repeated($email){
        $repeat=$this->find('mail',$email);
        if($repeat){
            self::$errores[]='Mail ya existente';
        return self::$errores;
        }
        
    }
    public function crearToken(){
        $this->token=uniqid();
    }
}