<?php
include __DIR__ . '/../../include/app.php';
use Hotel\Propiedades;
$idURL=$_GET['id'] ?? null;
$propiedad=new Propiedades();
$properties=$propiedad->find('titulo', $idURL);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/CSS/card.css">
</head>
<body>
<main class="main-property">
        <div  class="first" class="room">
            <img src="/imagenes/<?php echo $properties->imagen ?>" alt="">
        </div>
        <div class="room"> 
        <h3><?php echo ($properties->titulo)?></h3>
        <p class="precio"> <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-receipt-2" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#597e8d" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2" />
  <path d="M14 8h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5m2 0v1.5m0 -9v1.5" />
</svg>Precio p/noche: <span> $<?php echo ($properties->precio)?> </span> </p>
        <p class="mensaje" id="" cols="30" rows="10"><?php echo ($properties->descripcion)?></p>
        <div class="card-button">
            <a href="/public/">Volver</a>
        </div>
        </div>
        
    </main>
</body>
</html>
