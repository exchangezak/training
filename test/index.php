<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
    <input type="number" name="nombre" >
    <button>cliquer ici</button>
    <?php
    $nom=$_POST["nombre"]??"";
    if($nom>10){
$resultat=$nom-10;
echo "le nombre est plus grand " .$resultat;
    }
     ?>


    </form>
    
</body>
</html>
    
