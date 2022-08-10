<?php


 function conectarDB() : mysqli{
    $db=new mysqli ("localhost", "root", "Joan92", "primer-proyecto");
    if(!$db){
        echo'No se puedo ejecutar el codigo';
        exit;
    }
    else return $db;
};


    $host = "localhost";
    $db = "primer-proyecto";
    $usuario = "root";
    $password = "Joan92";
    // $mensaje = "";

    try {
        $conexion = new PDO("mysql:host=$host;dbname=$db", $usuario, $password);
        // $mensaje = "Conexion exitosa";
    } catch (Exception $ex) {
        echo $ex -> getMessage();
    }
?>