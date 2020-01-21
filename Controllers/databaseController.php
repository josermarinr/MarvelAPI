<?php
    require_once("Models/database.php");
        $db = new Databasemodel();
        $data=$db->database();

    require_once("Views/home.php")


?>