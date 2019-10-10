    
   <?php
    // Forma de conexion PDO
    $servidor = "mysql:dbname=empresa;host=127.0.0.1";
    $usuario="root";
    $password="";

    //Si la conexion se realiza de forma correcta el try se ejecutara y me enviara el mensaje que esta dentro 
    try{
        
        $pdo= new PDO($servidor, $usuario, $password);
        //echo "Conectado";
        
    }catch(PDOException $e){
        
        echo "Conexion mala : ( ".$e->getMessage();
        // en caso de haber problemas de todas formas se ejecutara, pero pasara al catch y nos mostrara el mensaje que esta dentro
    }
?>