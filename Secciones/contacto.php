<?php
 include __DIR__ . '/../include/app.php';
 use Hotel\Login;
 
 $auth=login();
if(!$auth){
    header('Location: ../Secciones/logIn/login.php?msg=6');
}
$idUser=$auth['id'];
$usario=new Login();
$datos=$usario->find('id', $idUser);

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoteleria</title>
    <link rel="stylesheet" href="/CSS/contacto.css">
    <link href="https://fonts.googleapis.com/css2?family=MonteCarlo&family=Montserrat&family=Open+Sans:wght@300;400;700;800&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <form>
            <div class="container">
                <div class="contact-box">
                    <div class="left"></div>
                    <div class="right">
                        <h2>Contacto</h2>
                        <input type="text" value="<?php echo $datos->nombre . ' ' . $datos->apellido ?>" class="field"  placeholder="Tu Nombre">
                        <input type="email" value="<?php echo $datos->mail ?>" class="field" placeholder="Tu Email">
                        <input type="text" class="field" placeholder="Tu Telefono">
                        <textarea name="mensaje" id="mensaje" cols="30" rows="10" class="field area" placeholder="Mensaje"></textarea>
                        <button class="btn">Enviar</button><a href="/public/" class="btn ancla">volver</a>
                    </div>
                </div>
            </div>
        </form>
    </header>
    
</body>
</html>