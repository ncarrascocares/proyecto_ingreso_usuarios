<?php 

if(isset($_POST['login'])){
    //Recibir datos para login
    if(($_POST['Usuario']=='test')&&($_POST['contraseña']=='123')){
        session_start();
        $_SESSION['Usuario']=$_POST['Usuario'];
        $_SESSION['contraseña']=$_POST['contraseña'];
        echo "Sesion iniciada para el usuario test";
        echo "<script>window.location='index.php'</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Validacion de usuario</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </head>
    <body>
        <form class="container bg-primary text-white" method="post">
            <div class="form-group container">
                <label for="exampleInputEmail1">Usuario</label>
                <input type="text" class="form-control" name="Usuario" aria-describedby="emailHelp" placeholder="Usuario">
                <small id="emailHelp" class="form-text text-muted">Ingresa tu nombre de Usuario</small>
            </div>
            <div class="form-group container">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="contraseña" placeholder="Password">
            </div>
            <button clas="" name="login" type="submit" class="btn btn-primary bg-success">Iniciar sesion</button>
        </form>
    </body>
</html>