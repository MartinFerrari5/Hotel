<?php
include __DIR__ . '/../../include/app.php';
use Hotel\Login;
$token=$_GET['token'] ?? '';
if($token){
    $hotel=new Login();
    $usuario=$hotel->find('token', $token);
    if($usuario){
        $usuario->confirmado=1;
        header('Location: login.php?msg=10');
        $usuario->token='';
        $usuario->update();
    }
}