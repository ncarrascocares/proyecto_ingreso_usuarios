<?php 
    require 'empleados.php';
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
        <style>
            body{
                background-color: aqua;
                padding: 20px;
            }
        </style>
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
                                    <input type="hidden" name="txtID" value="<?php echo $txtId;?>" placeholder="" id="txtID" require>
                                    <div class="col-md-4">
                                        <label for="">Nombre:</label>
                                        <input class="form-control <?php echo (isset($error['Nombre']))?"is-invalid":""; ?>" type="text" name="txtNombre" value="<?php echo $txtNombre; ?>" placeholder="" id="txtNombre">
                                        <div class="invalid-feedback">
                                            <?php echo (isset($error['Nombre']))? $error['Nombre']:""; ?>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Apellido Paterno:</label>
                                        <input class="form-control <?php echo (isset($error['ApellidoP']))?"is-invalid":""; ?>" type="text" name="txtApellidoP" value="<?php echo $txtApellidoP; ?>" placeholder="" id="txtApellidoP">
                                        <div class="invalid-feedback">
                                            <?php echo (isset($error['ApellidoP']))? $error['ApellidoP']:""; ?>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="">Apellido Materno:</label>
                                        <input class="form-control <?php echo (isset($error['ApellidoM']))?"is-invalid":""; ?>" type="text" name="txtApellidoM" value="<?php echo $txtApellidoM; ?>" placeholder="" id="txtApellidoM">
                                        <div class="invalid-feedback">
                                            <?php echo (isset($error['ApellidoM']))? $error['ApellidoM']:""; ?>
                                        </div>
                                        <br>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Correo:</label>
                                        <input class="form-control" type="email" required name="txtCorreo" value="<?php echo $txtCorreo; ?>" placeholder="" id="txtCorreo" require>
                                        <br>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="">Foto:</label>
                                        <input class="form-control" type="file" accept="image/*" name="txtFoto" value="<?php echo $txtFoto; ?>" placeholder="" id="txtFoto" require>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button value="btnAgregar" <?php echo $accionAgregar?> class="btn btn-success" type="submit" name="accion">Agregar</button>
                                <button value="btnModificar" <?php echo $accionModificar?> class="btn btn-warning" type="submit" name="accion">Modificar</button>
                                <button value="btnEliminar" onclick="return Confirmar('¿Realmente deseas borrar?')" <?php echo $accionEliminar?> class="btn btn-danger" type="submit" name="accion">Eliminar</button>
                                <button value="btnCancelar" <?php echo $accionCancelar?> class="btn btn-primary" type="submit" name="accion">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Agregar registro +
                </button>
                <br>
                <br>
            </form>
            <!--Formulario para mostrar la informacion contenida en la base de datos-->
            <div class="row">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark table-bordered">
                        <tr>
                            <th>Foto</th>
                            <th>Nombre Completo</th>
                            <th>Correo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
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

                                <input type="submit" class="btn btn-info" value="Seleccionar" name="accion">
                                <button value="btnEliminar" onclick="return Confirmar('¿Realmente deseas borrar?')" class="btn btn-danger" type="submit" name="accion">Eliminar</button>

                            </form>
                        </td>
                    </tr>
                    <?php }?>
                </table>
            </div>
            <?php if($mostrarModal){ ?>
                <script>
                    $('#exampleModal').modal('show');
                </script>
            <?php } ?>
            
            <!--Confirmacion de borrado de datos-->
            <script>
                function Confirmar(Mensaje){
                    return (confirm(Mensaje))?true:false;
                }
            </script>    
        </div>
    </body>
</html>