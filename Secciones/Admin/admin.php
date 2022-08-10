<?php
include __DIR__ . '/../../include/app.php';
$auth=login();

if(!$auth['admin']){
    return;
}

use Intervention\Image\ImageManagerStatic as Image;
use Hotel\Propiedades;
$propiedades=new Propiedades();
$errores=[];
if($_SERVER['REQUEST_METHOD']=='POST'){
    $args=$_POST['propiedad'];
    $propiedades=new Propiedades($args);
    $imgName=md5(uniqid(rand(), true)) . ".jpg" ;
    
    if($_FILES['propiedad']['tmp_name']["imagen"]){
    // Realiza un resize a la image
    // MAKE ACCEDE A LA UBICACION DEL ARCHIVO
    // FIT DECLARES THE HEIGHT AND THE WIDTH
    $image= Image::make($_FILES['propiedad']['tmp_name']["imagen"])->fit(800,600);
    // SE LE ASIGNA A LA FUNCION EL NOMBRE DEL Archivo
    $propiedades->setImage($imgName);
        
    }
    $errores=$propiedades->validar();
    if(empty($errores)){
        /*SUBIDA DE ARCHIVOS*/
            // CREAR CARPETA
            $carpetaImg='../../imagenes';
            if(!is_dir($carpetaImg)){
                $carpetaImg='../../imagenes';
                mkdir($carpetaImg);
            };
            // GUARDA LA IMAGEN EN EL SERVIDOR
            $image->save($carpetaImg . "/" . $imgName);
        $propiedades->guardar();
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/CSS/admin.css">
</head>
<body>
    <main class="main-contacto">
        <?php foreach($errores as $error): ?>
            <p class="error"> <?php echo $error ?></p>
        <?php endforeach;?>
    <form class="form-contacto" enctype="multipart/form-data" method="POST" action="">
        <fieldset>
            <legend>Crear Propiedad</legend>
            <div class="campos">
                <label for="titulo" for="">Titulo:</label>
                <input id="titulo" name="propiedad[titulo]" placeholder="Titulo Propiedad" type="text" value=""></input>
            </div>
            <div class="campos">
                <label  for="precio">Precio</label>
                <input value="" id="precio" name="propiedad[precio]" type="number"></input>
            </div>
            <div class="campos">
                <label for="">Imagen</label>
                <input name="propiedad[imagen]" type="file" placeholder="Imagen" accept="image/jpg, image/jpeg, image/png"></input>
                <?php if(false):?>
                     <img class="img-small" src="../../imagenes/<?php echo $propiedad->imagen?>" alt="img">
                <?php endif;?>
                
            </div>
            <div class="campos">
                <label for="">Descripcion</label>
                <textarea name="propiedad[descripcion]" id="" cols="20" rows="5"></textarea>
            </div>
        </label>
    </fieldset>
    <fieldset>


    <div>
        <button value="send-propiedad" class="form-button boton-verde">Enviar</button>
    </div>
    </form>
    </main>
    
</body>
</html>
