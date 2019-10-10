<?php
//If terneario, el cual consiste en recibir una variable y este isset valida que venga un valor, si no agregara un vacío en el campo
//En esta seccion tenemos la recepcion de los valores cargados en el formulario
$txtId = (isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre = (isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtApellidoP = (isset($_POST['txtApellidoP']))?$_POST['txtApellidoP']:"";
$txtApellidoM = (isset($_POST['txtApellidoM']))?$_POST['txtApellidoM']:"";
$txtCorreo = (isset($_POST['txtCorreo']))?$_POST['txtCorreo']:"";
//Opcion para subir imagenes
//$txtFoto = (isset($_FILES['txtFoto']["name"]))?$_POST['txtFoto']["name"]:"";

//En esta linea lo que se hace es recibir el "value" del boton, para luego evaluar el value en el switch 
$accion = (isset($_POST['accion']))?$_POST['accion']:"";

//Referencia al archivo de la conexion, la cual esta creada en la carpeta conexion
include("../conexion/conexion.php");

//switch nos permite evaluar la accion de los botones, podremos determinar el boton que se elecuta en el formulario
switch($accion){
    case "btnAgregar":

        //Se crea 
        $sentencia = $pdo->prepare("INSERT INTO empleados (Nombre, ApellidoP, ApellidoM, Correo, Foto) VALUES (:Nombre, :ApellidoP, :ApellidoM, :Correo, :Foto)");

        $sentencia->bindParam(':Nombre', $txtNombre);
        $sentencia->bindParam(':ApellidoP', $txtApellidoP);
        $sentencia->bindParam(':ApellidoM', $txtApellidoM);
        $sentencia->bindParam(':Correo', $txtCorreo);

//        $Fecha= new DateTime();
//
//        $nombreArchivo=($txtFoto != "")?$Fecha->getTimestamp()."_".$_FILES["txtFoto"]["name"]:"imagen.jpg";
//        error_reporting(error_reporting() & ~E_NOTICE);
//        $tmpFoto = $_FILES['txtFoto']["tmp_name"];
//
//        if($tmpFoto != ""){
//            move_uploaded_file($tmpFoto, "../imagenes/".$nombreArchivo);
//        }
//
//        $sentencia->bindParam(':Foto', $nombreArchivo);
//        $sentencia->execute();

        echo $txtId;
        echo "Presionaste el boton btnAgregar";
        break;

    case "btnModificar":

        $sentencia = $pdo->prepare("UPDATE empleados SET
        Nombre=:Nombre, 
        ApellidoP=:ApellidoP, 
        ApellidoM=:ApellidoM, 
        Correo=:Correo
        WHERE
        id=:id");

        $sentencia->bindParam(':Nombre', $txtNombre);
        $sentencia->bindParam(':ApellidoP', $txtApellidoP);
        $sentencia->bindParam(':ApellidoM', $txtApellidoM);
        $sentencia->bindParam(':Correo', $txtCorreo);
        $sentencia->bindParam(':id', $txtId);
        $sentencia->execute();

//        $Fecha= new DateTime();
//
//        $nombreArchivo=($txtFoto != "")?$Fecha->getTimestamp()."_".$_FILES["txtFoto"]["name"]:"imagen.jpg";
//        error_reporting(error_reporting() & ~E_NOTICE);
//        $tmpFoto = $_FILES['txtFoto']["tmp_name"];
//
//        if($tmpFoto != ""){
//            move_uploaded_file($tmpFoto, "../imagenes/".$nombreArchivo);
//
//            $sentencia = $pdo->prepare("UPDATE empleados SET Foto=:Foto WHERE id=:id");
//            $sentencia->bindParam(':Foto', $txtFoto);
//            $sentencia->bindParam(':id', $txtId);
//            $sentencia->execute();
//        }


        //Redireccionamiento a una pagina, en este caso se esta re direccionando a la misma página
        header('Location: index.php');

        echo "Presionaste el boton btnModificar";
        break;

    case "btnEliminar":

        $sentencia = $pdo->prepare(" DELETE FROM empleados WHERE id=:id ");
        $sentencia->bindParam(':id', $txtId);
        $sentencia->execute();

        //Redireccionamiento a una pagina, en este caso se esta re direccionando a la misma página
        header('Location: index.php');

        echo "Presionaste el boton btnEliminar";
        break;

    case "btnCancelar":
        echo "Presionaste el boton btnCancelar";
        break;    
}

//Declaracion de la sentenci SQL en la variable $sentecia
$sentencia=$pdo->prepare(" SELECT * FROM `empleados` WHERE 1 ");
//Esta linea va a ejecutar la sentencia
$sentencia->execute();
//Y aca se guardara la informacion en la vatiable $listaEmpleados
$listaEmpleados=$sentencia->fetchAll(PDO::FETCH_ASSOC);

//print_r($listaEmpleados);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>CRUD con php y msql</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <form action="" method="post" ectype="multipart/form-data">

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Empleado</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <input type="hidden" name="txtID" value="<?php echo $txtId;?>" placeholder="" id="txtID" require="">
                                    <div class="col-md-4">
                                        <label for="">Nombre:</label>
                                        <input class="form-control" type="text" required name="txtNombre" value="<?php echo $txtNombre; ?>" placeholder="" id="txtNombre" require="">
                                        <br>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Apellido Paterno:</label>
                                        <input class="form-control" type="text" required name="txtApellidoP" value="<?php echo $txtApellidoP; ?>" placeholder="" id="txtApellidoP" require="">
                                        <br>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Apellido Materno:</label>
                                        <input class="form-control" type="text" required name="txtApellidoM" value="<?php echo $txtApellidoM; ?>" placeholder="" id="txtApellidoM" require="">
                                        <br>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Correo:</label>
                                        <input class="form-control" type="email" required name="txtCorreo" value="<?php echo $txtCorreo; ?>" placeholder="" id="txtCorreo" require="">
                                        <br>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Foto:</label>
                                        <input class="form-control" type="file" accept="image/*" name="txtFoto" value="<?php echo $txtFoto; ?>" placeholder="" id="txtFoto" require="">
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button value="btnAgregar" class="btn btn-success" type="submit" name="accion">Agregar</button>
                                <button value="btnModificar" class="btn btn-warning" type="submit" name="accion">Modificar</button>
                                <button value="btnEliminar" class="btn btn-danger" type="submit" name="accion">Eliminar</button>
                                <button value="btnCancelar" class="btn btn-primary" type="submit" name="accion">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Agregar registro +
                </button>
            </form>
            <!--Formulario para mostrar la informacion contenida en la base de datos-->
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nombre Completo</th>
                            <th>Correo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <?php //Sentencia php?>
                    <?php foreach($listaEmpleados as $empleado){?>

                    <tr>
                        <td><img class="img-thumbnail" width="100px" src="../imagenes/<?php echo $empleado['Foto']; ?>" alt=""></td>
                        <td><?php echo $empleado['Nombre']; ?> <?php echo $empleado['ApellidoP']; ?> <?php echo $empleado['ApellidoM']; ?></td>
                        <td><?php echo $empleado['Correo']; ?></td>
                        <td>


                            <form action="" method="post">

                                <input type="hidden" name="txtID" value="<?php echo $empleado['ID']; ?>">
                                <input type="hidden" name="txtNombre" value="<?php echo $empleado['Nombre']; ?>">
                                <input type="hidden" name="txtApellidoP" value="<?php echo $empleado['ApellidoP']; ?>">
                                <input type="hidden" name="txtApellidoM" value="<?php echo $empleado['ApellidoM']; ?>">
                                <input type="hidden" name="txtCorreo" value="<?php echo $empleado['Correo']; ?>">
                                <input type="hidden" name="txtFoto" value="<?php echo $empleado['Foto']; ?>">

                                <input type="submit" value="Seleccionar" name="accion">
                                <button value="btnEliminar" type="submit" name="accion">Eliminar</button>

                            </form>
                        </td>
                    </tr>
                    <?php }?>
                </table>
            </div>
        </div>
    </body>
</html>