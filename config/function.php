<?php


use Hotel\Login;
function debuguear($value){
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    exit;
}
// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    
    return $s;
}
// ALERTA DE CREADO, ACTUALIZADO O ELIMINADO
function mostrarNotificacion($message){
    $msg="";
   
    switch($message){
        case 1: $msg="Verifica tu email";
            break;
        case 2: $msg="Actualizado correctamente";
            break;
        case 3: $msg="Eliminado correctamente";
            break;
        case 5: $msg="Enviado correctamente";
            break;            
        case 6: $msg='Para Acceder a Esta Seccion, Debes Logearte';
                break;
        case 7: $msg='Habitacion Ocupada';
                break;
        case 8: $msg='Reserva Completada';
            break;        
        case 9: $msg='Reserva Eliminada';
        case 10: $msg='Cuenta Confirmada';
        break;
        default:
            $msg=false;
            break;
        
    }
    
    return $msg;
}
function login(){
    session_start();
   $auth=$_SESSION;
    return $auth;
}
