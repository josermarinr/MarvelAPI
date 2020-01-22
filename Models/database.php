<?php
class Databasemodel {
    private $conexion;
    
    public function database(){
        $server = 'localhost';
        $user = 'root';
        $pw = '';
        $bd = 'marvel';
        $conexion = mysqli_connect($server, $user, $pw);
        
        if(mysqli_select_db($conexion, $bd)){
        echo "databse exists";
        require_once("Controllers\apiController.php");
        }else{
        echo "Databse does not exists";
        $this->conexion=conexion::db();
        $consult= $this->conexion->query("SELECT * FROM keys;");
        
        require_once("Controllers\apiController.php");

        }

        


           
    }

}


?>