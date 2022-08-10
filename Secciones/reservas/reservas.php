<?php 
include __DIR__ . '/../../include/app.php';
$auth=login();
$mensaje=$_GET['mensaje'] ?? '';



if(!$auth){
    header('Location: ../logIn/login.php?msg=6');
}
$idUser=$auth['id'];
if($_SERVER['REQUEST_METHOD']=='POST'){
    
}

$txtID = (isset($_POST['txtID']))?$_POST['txtID']:"";
    $txtNombre = (isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
    $txtFecha = strtotime((isset($_POST['txtFecha']))?$_POST['txtFecha']:"");
    $txtHabitacion = (isset($_POST['txtHabitacion']))?$_POST['txtHabitacion']:"";
    $accion = (isset($_POST['accion']))?$_POST['accion']:"";
    
    $reservado = true;
    $sentenciatotal=$conexion->prepare("SELECT * FROM hotel");
    $sentenciaSQL = $conexion -> prepare("SELECT * FROM hotel WHERE usuarioid={$idUser}");
    
    $sentenciatotal -> execute();
    $sentenciaSQL -> execute();


    $listaReservasTotal = $sentenciatotal -> fetchAll(PDO::FETCH_ASSOC);
    // debuguear($listaReservasTotal);
    $listaReservas = $sentenciaSQL -> fetchAll(PDO::FETCH_ASSOC);
    // debuguear($listaReservas);
    switch ($accion) {
        case 'Agregar':
            
            foreach($listaReservasTotal as $reserva){
            
                if ($reserva['habitacion'] != $txtHabitacion){
                    
                    $reservado = true;
                }
                else {
                    $reservado = false;
                    header("Location: reservas.php?id={$idUser}&mensaje=7");
                    return;
                }
            }
           
            if ($reservado) {
                $sentenciaSQL = $conexion -> prepare("INSERT INTO hotel (nombre, fecha, habitacion, usuarioid) VALUES(:nombre, :dob, :habitacion, :usuarioid)");
                
                $sentenciaSQL -> bindParam(':nombre', $txtNombre);

                $dob = date('Y-m-d', $txtFecha);
                $sentenciaSQL -> bindParam(':dob', $dob);

                $sentenciaSQL -> bindParam(':habitacion', $txtHabitacion);

                $sentenciaSQL -> bindParam(':usuarioid', $idUser);

                $sentenciaSQL -> execute();
                header("Location: /public/?id={$idUser}&mensaje=8");
            }
            
            
            break;

        case 'Cancelar';
            $sentenciaSQL = $conexion -> prepare("DELETE FROM hotel WHERE id = :id");
            $sentenciaSQL -> bindParam(':id', $txtID);
            $sentenciaSQL -> execute();

            header("Location: /public/?mensaje=9");
            break;

        case 'Limpiar':
            $txtNombre = "";
            $txtFecha = "";
            $txtHabitacion = "";
            break;
            
        case 'Modificar':
            $sentenciaSQL = $conexion -> prepare("UPDATE hotel SET nombre = :nombre, fecha = :dob, habitacion = :habitacion WHERE id = :id");
            $sentenciaSQL -> bindParam(':id', $txtID);
            $sentenciaSQL -> bindParam(':nombre', $txtNombre);
            $dob = date('Y-m-d', $txtFecha);
            $sentenciaSQL -> bindParam(':dob', $dob);
            $sentenciaSQL -> bindParam(':habitacion', $txtHabitacion);
            $sentenciaSQL -> execute();

            header("Location: /public/");
            break;

        case 'Seleccionar':
            
            $sentenciaSQL = $conexion -> prepare("SELECT * FROM hotel WHERE id = :id");
            $sentenciaSQL -> bindParam(':id', $txtID);
            $sentenciaSQL -> execute();
            $reserva = $sentenciaSQL -> fetch(PDO::FETCH_LAZY);

            $txtID = $reserva['id'];
            $txtNombre = $reserva['nombre'];
            $txtFecha = $reserva['fecha'];
            $txtHabitacion = $reserva['habitacion'];

            break;
    }
    

    // $sentenciaSQL = $conexion -> prepare("SELECT * FROM hotel");
    // $sentenciaSQL -> execute();
    // $listaReservas = $sentenciaSQL -> fetchAll(PDO::FETCH_ASSOC);
    // debuguear($listaReservas);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/reservas.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
            <div class="contact-box">
                <div class="left"></div>
                <div class="right">
                    <a href="/public/?id= <?php echo $idUser?>" class="back">←</a>
                    <h2>Datos de reserva</h2>
                    <?php  if($mensaje): ?>
                            <p class="error"> <?php echo mostrarNotificacion($mensaje)?> </p>
                    <?php endif;?>
                   
                
                <div>
                    
                    <form method="POST" action="" >

                    <input type="hidden" name="txtId"  value="<?php echo $auth['id'] ?? '' ?>" class="field blocked"  placeholder="ID...">
                    <div >
                        <input name="txtNombre"   readonly="readonly" value="<?php echo $auth['nombre'] ?? '' ?>" required type="text" class="field blocked" id="txtNombre" placeholder="Nombre...">
                    </div>
                    <div >
                        
                        <input min="<?php echo date('Y-m-d', strtotime('+1 day'))?>" 
                max="<?php echo date('Y-m-d', strtotime('+6 month'))?>"
                         value="<?php echo $txtFecha ?? '' ?>" required type="date" class="field" name="txtFecha" id="txtFecha">
                    </div>
                    <div >
                        <input value="<?php echo $txtHabitacion ?? '' ?>" required type="number" class="field" name="txtHabitacion" id="txtHabitacion" placeholder="Nro de habitacion" min="0" max="100">
                    </div>

                    <div class="contenedor-btn">
                        <div class="contenedor-btn" role="group" aria-label="">
                            <div>
                                <input class="btn" type="submit" name="accion" value="Agregar">
                            </div>
                            <div >
                            <input type="submit" name="accion" class="btn" value="Cancelar">
                            </div>
                            <div>
                                <input class="btn" type="submit" name="accion"  value="Modificar">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
        
    </section>
    <section class="tabla backtabla">
        <div>
            <div class="table-title"><h3>Reservas Hechas</h3></div>
            <table class="table-fill centrar">
                <thead>
                    <tr>
                        <th class="table-left">ID</th>
                        <th class="table-left">Nombre</th>
                        <th class="table-left">Fecha</th>
                        <th class="table-left">Habitacion</th>
                        <th class="table-left">Opciones</th>
                    </tr>
                </thead>
                <?php
                
                foreach($listaReservas as $reserva):?>
                <tbody class="table-hover">
                
                    <tr>
                        <td class="text-left"><?php echo $reserva['id'] ?></td>
                        <td class="text-left"><?php echo $reserva['nombre'] ?></td>
                        <td class="text-left"><?php echo $reserva['fecha'] ?></td>
                        <td class="text-left"><?php echo $reserva['habitacion'] ?></td>
                        <td>
                            <form method="post">

                                <input type="hidden" name="txtID" id="txtID" value="<?php echo $reserva['id']?>" >

                                <input type="submit" name="accion" value="Seleccionar" class="btn">

                                <input type="submit" name="accion" class="btn" value="Cancelar">

                            </form>
                        </td>
                    </tr>
                </tbody>
                <?php endforeach; ?>
            </table>
        </div>
        

    </section>
</body>
</html>