<?php

namespace Hotel;
class ActiveRecord{
    //BBDD
    protected static $db;
    protected static $columnaDB=[];
    
    protected static $tabla="";
    
     // ERRORES
    protected static $errores=[];


    // CONEXION A BBDD
    public static function setDB($database){
    self::$db=$database;
    }

    
    public function guardar(){
        
        // SANITIZAR LOS DATOS
        $sanitize=$this->sanitizar();
       
        $string=join(", ", array_keys($sanitize));
        $values=join( "'" . ", '", array_values($sanitize));
        

        $query="INSERT INTO " . static::$tabla . " ({$string}) VALUES(
        '{$values}');";
            
      
        $resultado=self::$db->query($query);
        if($resultado){
            echo "Agregado correctamente";
          return $resultado;
        }
    }
    // Actualizar ATRIBUTOS;
    public function update(){
        $sanitize=$this->sanitizar();
        $valores=[];
        foreach($sanitize as $key=>$value){
            $valores[]=$key . "=" . "'" . $value . "'"; 
        }
        $string=join(", ", $valores);
        $query="UPDATE " . static::$tabla . " SET {$string}
        WHERE id=" . self::$db->escape_string($this->id);
       
        $resultado=self::$db->query($query);
        return $resultado;
    } 
    public function eliminar(){
      
        $query="DELETE  FROM " . static::$tabla .
         " WHERE id=" . self::$db->escape_string($this->id) . " LIMIT 1";
         
         $foreign="SET  FOREIGN_KEY_CHECKS=0";
         $resultado=self::$db->query($foreign);
         $resultado=self::$db->query($query);
         if($resultado){
            unlink("../imagenes/" . $this->imagen);
            header("Location: /admin/index.php?mensaje=3 ");
        
        }
    }
    // IDENTIFICAR Y UNIR LOS ATRIBUTOS DE LA BBDD
    public function atributos(){
        $atributos=[];
        foreach(static::$columnaDB as $columna){
            if($columna=="id")continue;
            else $atributos[$columna]=  $this->$columna;
        }
       
        return $atributos;
    }
    public function sanitizar(){
       $atributos=$this->atributos();
       $sanitize=[];
        
       foreach($atributos as $key=>$value){
        // $sanitize[$atributos]= $this->$atributo;
       
        $sanitize[$key]=self::$db->escape_string($value);
       }
      
       return $sanitize;
    }
    // SUBIDA DE ARCHIVOS
    public function setImage($imagen){
        // ELIMINA IMAGEN
        if(isset($this->id)){
            $exists=file_exists("../../imagenes/" . $this->imagen);
            if($exists){
                unlink("../../imagenes/" . $this->imagen);
            }
        }
        
        if($imagen){
            $this->imagen=$imagen;
        }
    }   
    // VALIDACION
    public static function getErrores(){
        return static::$errores;
    }
    
    public static function all(){
        $query="SELECT * FROM " . static::$tabla;
       
        $resultado=self::consultarSQL($query);
        return $resultado;
    }
    public static function get($num){
        $query="SELECT * FROM " . static::$tabla . " LIMIT {$num} ";
       
        $resultado=self::consultarSQL($query);
        return $resultado;
    }
    // BUSCA UN REGISTRO POR SU ID
    public static function find($columna, $valor){
        $query="SELECT * FROM " . static::$tabla . " where " . $columna . "= '" . $valor . "' ;";
   
        $resultado=self::consultarSQL($query);
        // debuguear($resultado);
        return array_shift($resultado);
    }
    public static function consultarSQL($query){
        // CONSULTAR LA BASE DE DATOS
        $resultado=self::$db->query($query);
        // ITERAR RESULTADOS
        $array=[];
        while($registro = $resultado->fetch_assoc()){
            $array[]=static::crearObjeto($registro);
        }
        
        // LIBERAR LA MEMORIA CUANDO SE TERMINA DE HACER  LA CONSULTA
        $resultado->free();
        // RETORNAR LOS RESULTADOS
        return($array);
        
    }
    protected static function crearObjeto($registro){
      $objeto=new static;
      foreach($registro as $key=>$value){
        if(property_exists($objeto, $key)){
            
            $objeto->$key=$value;
        }
       
    }
        return $objeto;
    }
    // LEE EL POST Y MAPEA PROPIEDADES Y REESCRIBE LAS NUEVAS PROPS
    public function sincronizar($args=[]){
        foreach($args as $key=>$value){
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key=$value;
            }
        }
        return $this;
    }
}