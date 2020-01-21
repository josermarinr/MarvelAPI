<?php

class Conexion extends mysqli{
       public static function conecting(){
        $server = 'localhost';
        $user = 'root';
        $pw = '';
        $bd = 'marvel';
        $conectingbd = mysqli_connect(
            $server, 
            $user, 
            $pw,
            $bd);
        return $conectingbd;
    }
    public static function db(){
        $server = 'localhost';
        $user = 'root';
        $pw = '';
        $bd = 'marvel';
        $conexion = mysqli_connect($server, $user, $pw);
        if (!$conexion) {
            die('Error de Conexión (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }
        
        mysqli_select_db($conexion, $bd);
            try {
                $ndb = new PDO("mysql:host=$server", $user, $pw);
        
                $ndb->exec("CREATE DATABASE `$bd`;") 
                or die(print_r($ndb->errorInfo(), true));
            } catch (PDOException $e) {
                die("DB ERROR: ". $e->getMessage());
            }
            $mybd = new mysqli($server,$user,$pw,$bd);
                $table1 = "CREATE TABLE  `heromarvel` (
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    heroname varchar(250) ,
                    imgpath varchar(250) ,
                    imgext varchar(250) );";
                $table2 = "CREATE TABLE  `keys` (
                    `id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    `privatekey` varchar(250) ,
                    `publickey` varchar(250) ,
                    `hashi` varchar(250) );";
            if(mysqli_query($mybd, $table1 ) === true && mysqli_query($mybd, $table2 ) === true ){
                printf("we did it");
            }
            
            return $mybd;
            
           
           
    }
}

?>
