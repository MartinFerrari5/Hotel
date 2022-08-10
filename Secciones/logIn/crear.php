<?php 
include __DIR__ . '/../../include/app.php';
$msg=$_GET['msg'] ?? '';
$alertas=[];
use Hotel\Login;
use Classes\Email;
$alertas=[];
$hotel=new Login();

if($_SERVER['REQUEST_METHOD']=='POST'){
    // debuguear($_POST);
    $args=$_POST;
    $hotel=new Login($args);
    
    
    $alertas=$hotel->verificar();
   
    $alertas=$hotel->repeated($hotel->mail);
   
    $alertas=Login::getErrores();
    
    if(empty($alertas)){
        $hotel->passwordHash();
        $hotel->crearToken();
        
        
        $email=new Email($hotel->email, $hotel->nombre, $hotel->token);
     
        $email->enviar();
        $resultado=$hotel->guardar();
        if($resultado){
           
            header('Location: login.php?msg=1');
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
                        <h4 class="title">Nueva cuenta</h4>
                    </div>
                    <div><span></span></div>
                </div>
                
                <form method="POST" action=''>
                    <div class="field">
                        <input class="input-field" type="text" name="nombre" placeholder="Nombre" value="<?php echo s($hotel->nombre) ?? ''?>">
                    </div>

                    <div class="field">
                    <input class="input-field" type="text" name="apellido" placeholder="Apellido" value="<?php echo s($hotel->apellido) ?? ''?>">
                    </div>

                    <div class="field">
                    <svg class="svg" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-question-mark" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M8 8a3.5 3 0 0 1 3.5 -3h1a3.5 3 0 0 1 3.5 3a3 3 0 0 1 -2 3a3 4 0 0 0 -2 4" />
                    <line x1="12" y1="19" x2="12" y2="19.01" />
                    </svg>
                        <input class="input-field" type="text" name="question" placeholder="Pregunta Clave" value="">
                    </div>
                    
                    <div class="field">
                    <input class="input-field" type="password" name="questionAns" placeholder="Respuesta Clave" value="">
                    </div>
                    <?php include __DIR__ . '/../fragments/loginForm.php'?>
                    <button class="btn" type="submit">CREAR</button>
                </form>
                <div class="msg">
                    <a href="cambiar.php" class="btn-link">Olvidaste tu contraseña?</a>
                    <a href="login.php" class="btn-link">Inicia Sesion</a>
                </div>
            </div>
                
    </div>