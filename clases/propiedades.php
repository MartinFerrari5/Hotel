<?php
namespace Hotel;

class Propiedades extends ActiveRecord{

    protected static $tabla='propiedades';
    protected static $errores=[];
    protected static $columnaDB=["id", "titulo","precio",
    "imagen", "descripcion"];
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public function __construct($args=[]){
        $this-> id= $args['id'] ?? null;
        $this-> titulo= $args['titulo'] ?? "";
        $this-> precio= $args['precio'] ?? "";
        $this-> imagen= $args['imagen'] ?? "";
        $this-> descripcion= $args['descripcion'] ?? "";
    }
    public function validar(){
        
        if(!$this->titulo){
            self::$errores[]="Debes agregar un titulo";
        }
        if(!$this->precio){
           self:: $errores[]="Debes agregar un precio";
        }
        if(!$this->imagen ){
            self::$errores[]="Debes agregar una imagen";
        }
        // if(($this->imagen["size"]/1000)>1000){
        //     self::$errores[]="Debes agregar una imagen menor de 100kb, tu imagen pesa " . $this->imagen["size"]/1000 . "kb" ;
        // }
        if(strlen($this->descripcion)<10){
            self::$errores[]="Debes agregar una descripcion más amplia";
        }
        
        return self::$errores;
    }
}