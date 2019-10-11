<?php
//If terneario, el cual consiste en recibir una variable y este isset valida que venga un valor, si no agregara un vacío en el campo
//En esta seccion tenemos la recepcion de los valores cargados en el formulario
$txtId = (isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre = (isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtApellidoP = (isset($_POST['txtApellidoP']))?$_POST['txtApellidoP']:"";
$txtApellidoM = (isset($_POST['txtApellidoM']))?$_POST['txtApellidoM']:"";
$txtCorreo = (isset($_POST['txtCorreo']))?$_POST['txtCorreo']:"";
$txtFoto = (isset($_FILES['txtFoto']["name"]))?$_POST['txtFoto']["name"]:"";

//En esta linea lo que se hace es recibir el "value" del boton, para luego evaluar el value en el switch 
$accion = (isset($_POST['accion']))?$_POST['accion']:"";

//Accion en los botones, en estas lineas se desabilitan los botones modifcicar eliminar y cancelar, solo se deja el boton agregar habilitado
$accionAgregar="";
$accionModificar=$accionEliminar=$accionCancelar="disabled";
$mostrarModal=false;

//Referencia al archivo de la conexion, la cual esta creada en la carpeta conexion
include("../conexion/conexion.php");

//switch nos permite evaluar la accion de los botones, podremos determinar el boton que se elecuta en el formulario
switch($accion){
    case "btnAgregar":
        
        if($txtNombre==""){
            $error['Nombre']="Ingrese el dato";
        }
        
        if($txtApellidoP==""){
            $error['ApellidoP']="Ingrese el dato";
        }
        
        if($txtApellidoM==""){
            $error['ApellidoM']="Ingrese el dato";
        }
        
        if(isset($error) == true){
            $mostrarModal=true;
            break;
        }
        
        //Se crea 
        $sentencia = $pdo->prepare("INSERT INTO empleados (Nombre, ApellidoP, ApellidoM, Correo, Foto) VALUES (:Nombre, :ApellidoP, :ApellidoM, :Correo, :Foto)");

        $sentencia->bindParam(':Nombre', $txtNombre);
        $sentencia->bindParam(':ApellidoP', $txtApellidoP);
        $sentencia->bindParam(':ApellidoM', $txtApellidoM);
        $sentencia->bindParam(':Correo', $txtCorreo);

        $Fecha= new DateTime();

        $nombreArchivo=($txtFoto != "")?$Fecha->getTimestamp()."_".$_FILES["txtFoto"]["name"]:"imagen.jpg";
        error_reporting(error_reporting() & ~E_NOTICE);
        $tmpFoto = $_FILES['txtFoto']["tmp_name"];

        if($tmpFoto != ""){
            move_uploaded_file($tmpFoto, "../imagenes/".$nombreArchivo);
        }

        $sentencia->bindParam(':Foto', $nombreArchivo);
        $sentencia->execute();

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

        $Fecha= new DateTime();

        $nombreArchivo=($txtFoto != "")?$Fecha->getTimestamp()."_".$_FILES["txtFoto"]["name"]:"imagen.jpg";
        error_reporting(error_reporting() & ~E_NOTICE);
        $tmpFoto = $_FILES['txtFoto']["tmp_name"];

        if($tmpFoto != ""){
            move_uploaded_file($tmpFoto, "../imagenes/".$nombreArchivo);

            $sentencia = $pdo->prepare("UPDATE empleados SET Foto=:Foto WHERE id=:id");
            $sentencia->bindParam(':Foto', $txtFoto);
            $sentencia->bindParam(':id', $txtId);
            $sentencia->execute();
        }


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
        header('Location: index.php');
        break;
        
    case "Seleccionar":
        $accionAgregar="disabled";
        $accionModificar=$accionEliminar=$accionCancelar="";
        $mostrarModal=true;
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
