
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    
    <title>heros</title>
</head>
<body>
        <?php
            require_once '..\models\paginator.php';
            $conexion = new mysqli('localhost', 'root', '', 'marvel'); 
            
            $query      = "SELECT * from `heromarvel`";
 
            $Paginator  = new Paginator( $conexion, $query );
         
            $results    = $Paginator->getData(  );
            ?>
       <div class="bg-white">
           <div class="card">
                <div class="grid-container-4" id="row-hero">
                
                <?php for( $i = 0; $i < count( $results->data ); $i++ ) : ?>
                <div class="grid-item">
                    <div class="carreimgpersonnage">
                    
                        <img src='<?php echo $results->data[$i]['imgpath'].".".$results->data[$i]['imgext'] ?>' 
                        alt="<?php echo $results->data[$i]['heroname']; ?>" class="imgperssonage">
                    </div>
                    <div class="divpersonagename">
                        <p class="personagename">
                        <?php echo $results->data[$i]['heroname']; ?>
                        
                        </p>
                    </div>
                    </div>
                <?php endfor; ?>

                </div>

                <div class="grid-container-1">
                    <div class="divpagination">
                        <?php echo $Paginator->createLinks( ); ?> 
                          
                    </div>
                </div>
           </div>
            
                
            
        <!-- <div class="card">
            <div class="grid-container-1 form-container">
                <div class="title">
                    <h2>Nouveau personnage</h2>
                </div>

                <form method="POST" action="../models/saving.php" //enctype="multipart/form-data">
                    <div class="imputname">
                        <input type="text" placeholder="entrer un nom" name="heroname">
                    </div>

                    <div class="imputimage">
                        <input type="test" placeholder="url"  name="img">
                        <img src="/photo-camera.svg" alt="" class="icon">
                    </div>

                    <div class="bnt ">
                    <div class="imputname">
                            <input type="submit" class="blackbtn" value="enregistrer"> 
                        </div>
                    </div>
                </form>
            </div>
        </div> -->
    </div>
</body>
</html>
