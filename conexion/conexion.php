    
   <?php
    // Conexion a la base de datos PDO
    $servidor = "mysql:dbname=empresa;host=127.0.0.1";
    $usuario="root";
    $password="";

    //Try catch, permite ejecutar el codigo, en caso de haber error o no, en el caso de haber, se ejecua el catch. 
    try{
        
        $pdo= new PDO($servidor, $usuario, $password);
        //echo "Conectado";
        
    }catch(PDOException $e){
        
        echo "Conexion mala : ( ".$e->getMessage();
    }
?>
       