
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="views/css/style.css">
    <title>home</title>
</head>
<body>
            <div class="card">
            <div class="grid-container-1 form-container">
                <div class="title">
                    <h2>WELCOME to MVC MARVEL API</h2>
                </div>
                    <form method="POST" action="models/marvel.php">
                        <div class="imputname">
                            <input type="text" placeholder="your publickey" name="publickey" >
                        </div>
                        <div class="imputname">
                            <input type="text" placeholder="your privatekey" name="privatekey" >
                        </div>

                        <div class="imputname">
                            <input type="submit" class="blackbtn" value="make you DB for this API"> 
                        </div>

                    </form>
                
            </div>
            </div>
</body>

</html>