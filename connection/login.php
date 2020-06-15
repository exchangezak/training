<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Document</title>
</head>
<body>
<header>

</header>
<main>
<div id="container">
            <!-- zone de connexion -->
            
            <form action="" method="POST">
                <h1>Connexion</h1>
                
                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>

                <input type="submit" id='submit' value='LOGIN' >
                <?php

    $user=$_POST["username"]??"";
    $pwd=$_POST["password"]??"";
  

$bdd=new PDO("mysql:host=localhost;dbname=aplication;charset=utf8","root","");
$sql="SELECT * FROM user WHERE username='$user'";
$stat=$bdd->prepare($sql);
$stat->execute();
$resultat=$stat->fetchAll(PDO::FETCH_ASSOC);
foreach($resultat as $tableau){
  extract($tableau);
  if($username==$user && $password==$pwd){
     header('location:verification.php');
  }
  else
  { echo "vous avez une erreur dans votre mot de pass ou votre nom";
}

}
     ?>
            </form>
            

        </div>
        <footer>

</footer>



<script src="assets/js/app.js"></script>

    
</body>
</html>





