<?php
    include __DIR__ . '/../../include/app.php';
    use Hotel\Login;
    
$msg=$_GET['msg'] ?? null;

$alertas=[];
$hotel=new Login();
if($_SERVER['REQUEST_METHOD']=='POST'){
    $user=$_POST;
    $hotel=new Login($user);
    // debuguear($login);
    $alertas=$hotel::getErrores();
    $alertas=$hotel->erroresLogeo();


    if(empty($alertas)){
        $query=Login::find('mail', $hotel->mail);
       
        if(is_null($query)){
            
            $alertas[]='Usario inexistente';
        
        }
        else{
            $confirm=$query->confirmado;
            $resultado=$hotel->passwordVerify($query->password);
            if($resultado && $confirm==1){
                session_start();
                $_SESSION['id']=$query->id;
                $_SESSION['firstName']=$query->nombre;
                $_SESSION['nombre']=$query->nombre . ' ' . $query->apellido;
                $_SESSION['login']=true;
                $_SESSION['confirmado']=$query->confirmado;
                $_SESSION['admin']=$query->admin;
                header("Location: /public/");
            }
            else{
                $alertas[]='Usario no verificado o password erroneo';
            }
        } 
    }
    
}
?>
<?php include __DIR__ . '/../fragments/headerlogin.php' ?>
    <div class="container">
            
            <div class="card">
                <?php if($msg):?>
            <p class="success"> <?php echo mostrarNotificacion($msg) ?? '' ?></p>
            <?php endif;?>
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
                        <h4 class="title">Ingresar</h4>
                    </div>
                    <div><span></span></div>
                </div>
                
                <form method="POST" action='login.php'>
                    <?php include __DIR__ . '/../fragments/loginForm.php'?>
                    <button class="btn" type="submit">Ingresar</button>
                    </form>
                <div class="msg">
                    <a href="cambiar.php" class="btn-link">Olvidaste tu contraseña?</a>
                    <a href="crear.php" class="btn-link">Crea una cuenta!</a>
                </div>
            </div>
                
    </div>
    <script src="/script.js"></script>
</body>
</html>