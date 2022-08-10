<?php
include __DIR__ . '/../include/app.php';
$auth=login();
$idUser=$_GET['id'] ?? '';
$msg=$_GET['mensaje'] ?? '';
use Hotel\Propiedades;
$propiedades=Propiedades::all();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoteleria</title>
    <link rel="stylesheet" href="/CSS/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=MonteCarlo&family=Montserrat&family=Open+Sans:wght@300;400;700;800&family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>
<body>
    <?php ; if($msg): ?>
                <p class="success start"> <?php echo mostrarNotificacion($msg)?> </p>
    <?php endif;?>
    <header>
        <nav>
            <a href="#" id="icono" class="icono menu">Menu</a>
            <?php if(!$auth){?>
            <a href="/Secciones/logIn/login.php" class="icono login">Login</a>
            <?php  } 
            else { ?>
            <a href="/Secciones/logIn/logout.php" class="icono login">Cerrar Sesion</a>
            <?php }?>
        <div class="enlaces uno" id="enlaces">
                <a href="#">Inicio</a>
                <a href="/Secciones/acerca.php">Acerca de</a>
                <a href="/Secciones/reservas/reservas.php">Reserva</a>
            </div>
        </nav>
        <div class="container">
            <div class="textos">
                <h1>Hoteleria Premium</h1>
                <h2>Hacemos que tu Hotel sea ideal.</h2>
                <a href="/Secciones/contacto.php">Contacto</a>
            </div>
            <img src="/img/vector.jpg" alt="Hoteles">
        </div>
        
    </header>
    <div class="wave">
        <div style="height: 150px; overflow: hidden;" ><svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;"><path d="M0.00,49.98 C149.99,150.00 349.20,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #0F2027;"></path></svg></div>
    </div>

    <div class="alfonso">
        <?php $num=3; include __DIR__ . '/../Secciones/cards/tarjeta.php' ?>
    </div>  

    <footer>

    </footer>
    <script src="/script.js"></script>
</body>
</html>