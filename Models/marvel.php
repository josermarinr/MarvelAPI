<?php
class searchHero{
     function conectingbd(){
        $server = 'localhost';
        $user = 'root';
        $pw = '';
        $bd = 'marvel';
        $conexion = new mysqli($server, $user, $pw, $bd);
        if ($conexion->connect_errno) {
            die("Connection failed: " . $conexion->connect_error);
            
        }
        return $conexion;
        
     }
     public function searh_data(){
                
        $query = ("SELECT publickey, hashi  FROM `keys`;");
        $conexion = searchHero::conectingbd();
        $consult = $conexion->query($query);
        if($consult->num_rows > 0){
            while($datas = $consult->fetch_assoc()) {
            $publickey =$datas["publickey"];
            $hash= $datas["hashi"];
            }
        }else{
            echo 'without result';
        }
        $consult->close();
        
        $MarvelUrlAPI = file_get_contents("https://gateway.marvel.com/v1/public/characters?limit=10&ts=1&apikey=$publickey&hash=$hash");
        $res = json_encode($MarvelUrlAPI);
        $res1= html_entity_decode($res);
        $res2 = json_decode($res1, TRUE);
        $code = json_decode($res2, TRUE);
        $data = $code["data"]["results"];
        
        $cone = searchHero::conectingbd();   
        for($i=0; $i<count($data); $i++){
                $name = $data[$i]["name"];
                $path= $data[$i]["thumbnail"]["path"];
                $ext = $data[$i]["thumbnail"]["extension"];
                $querry = "INSERT INTO `heromarvel` ( heroname, imgpath, imgext) 
                VALUES ('$name', '$path', '$ext')";
                if($cone->query($querry) ===true){
                  
                    header('Location: ../views/listCharacter.php');

                echo 'listo';
                }else{
                echo "Error: " . $querry . "<br>" . $cone->error;
                }
            }
              
        $cone->close();
          
        return $data;
    
    }

}
        $ts = 1;
        $publickey = $_POST['publickey']; 
        $privatekey = $_POST['privatekey'];
        $hash = md5($ts . $privatekey . $publickey);  
        
        $cone = searchHero::conectingbd();     
        $data = "INSERT INTO `keys` ( privatekey, publickey, hashi ) 
        VALUES('$privatekey', '$publickey', '$hash')";
        
        if($cone->query($data) ===true){
           
            $heromarvel = new searchHero();
            $data=$heromarvel->searh_data();
            
            
        } else {
            echo "Error: " . $data . "<br>" . $cone->error;

        }
        
        $cone->close();


?>