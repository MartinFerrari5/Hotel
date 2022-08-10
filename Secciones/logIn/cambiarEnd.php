<?php
include __DIR__ . '/../../include/app.php';
$token=$_GET['token'] ?? "";

use Classes\Email;
use Hotel\Login; 
$pregunta= false;
$alertas=[];
$hotel=new Login();
$token=$hotel->find('token', $token);
if(!$token){
    return;
}
if($_SERVER['REQUEST_METHOD']=='POST'){
    $args=$_POST;
   $hotel=new Login($args);
   
   $alertas=$hotel->erroresLogeo();
   $alertas=Login::getErrores();
   if(!$alertas){
    $resultado=Login::find('mail', $hotel->mail);
    if(!$resultado){
        $alertas[]='Mail inexistente';
        
    }
    else{
        $pregunta=true;
        $resultado->token=$hotel->crearToken();
        
        $email=new Email($resultado->mail, $resultado->nombre, $resultado->token);
        if($hotel->questionAns==$resultado->questionAns){
            $pass=$hotel->passwordHash();
            $resultado->password=$hotel->password;
            
            $resultado=$resultado->update();
            header('Location: login.php?msg=2');
        }
        
    }
   
   }
   
   
}
include __DIR__ . '/../fragments/headerlogin.php';
 ?>
<div class="container">
            
            <div class="card">
                
            <?php foreach($alertas as $alerta): ?>
                <p class="error"> <?php echo $alerta?> </p>
            <?php endforeach;?>
                <div class="space">
                    <div class="volver">
                        <a href="/public" ><span class="material-symbols-outlined">
                            arrow_back
                            </span></a>
                    </div>
                    <div>
                        <h4 class="title">Nueva Contraseña</h4>
                    </div>
                    <div><span></span></div>
                </div>
                
                <form method="POST" action=''>
                    
                    <?php include __DIR__ . '/../fragments/loginForm.php'?>
                    <?php if($pregunta):?>
                        <p class="verify">Repita la contraseña y Responda la Pregunta</p>
                        <div class="field">
                        <svg class="svg" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-question-mark" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M8 8a3.5 3 0 0 1 3.5 -3h1a3.5 3 0 0 1 3.5 3a3 3 0 0 1 -2 3a3 4 0 0 0 -2 4" />
                        <line x1="12" y1="19" x2="12" y2="19.01" />
                        </svg>
                            <input disabled="disabled" class="input-field" type="text" name="question" placeholder="Pregunta Clave" value="<?php echo $resultado->question ?>">
                        </div>
                        
                        <div class="field">
                        <input class="input-field" type="password" name="questionAns" placeholder="Respuesta Clave" value="">
                        </div>
                    <?php endif;?>
                    <button class="btn" type="submit">CAMBIAR</button>
                <div class="msg">
                    <a href="crear.php" class="btn-link">Crea una Cuenta</a>
                    <a href="login.php" class="btn-link">Inicia Sesion</a>
                </div>
            </div>
                
    </div>
<form action="POST"></form>

