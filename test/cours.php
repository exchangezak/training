<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action='cours.php' method='post'>
            <label for='nom'>Nom d'utilisateur : </label>
            <input type='text' name='nom' id='nom'><br>
            <label for='pass'>Choisissez un mot de passe.</label>
            <input type='password' name='pass' id='pass'><br>
            <input type='submit' value='Envoyer'>
        </form>
          <?php
                     require 'classes/utilisateur.classe.php';
                     require 'classes/admin.classe.php';
                     
                     $pierre = new Admin('Pierre', 'abcdef');
                     $mathilde = new Utilisateur('Math', 123456);
                     
                     echo $pierre->getNom(). '<br>';
                     echo $mathilde->getNom(). '<br>';
                     
                     $pierre->setBan('Paul');
                     $pierre->setBan('Jean');
                     echo $pierre->getBan();
      ?>



    
</body>
</html>