<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
    <h6>name</h6>
                <input type="text" name="nom">
           
            <h6>competences</h6>
              <select name="competence" >
                <option value="maquetter">maquetter</option>
                <option value="installer">installer</option>
                <option value="transposer">transposer</option>
                <option value="backend">backend</option>
                <option value="frontend">frontend</option>
                <option value="imiter">imiter</option>
                <option value="construire">construire</option>
                <option value="rangement">rangement</option>
              </select>
         
            <h2>niveau</h2>
             <select name="niveau" >
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>

            </select>
            <br>
            <input type="submit" value="ajouter">
            <?php
            
            $tab=["nom"=>$_POST["nom"]??"",
            "competence"=>$_POST["competence"]??"",
            "niveau"=>$_POST["niveau"]??""];
            extract($tab);
            $bdd=new PDO("mysql:host=localhost;dbname=aplication;charset=utf8","root","");
$sql="INSERT INTO skill (nom,competence,niveau) VALUES (:nom,:competence,:niveau) ";
$stat=$bdd->prepare($sql);
$stat->execute($tab);

            ?>
            </form>
            <table>
                <tr>
                    <td>nom</td>
                    <td>competence</td>
                    <td>niveau</td>
                </tr>
               
             <?php   $bdd=new PDO("mysql:host=localhost;dbname=aplication;charset=utf8","root","");
$sql="SELECT *FROM skill";
$stat=$bdd->prepare($sql);
$stat->execute();
$resultat=$stat->fetchAll(PDO::FETCH_ASSOC);
foreach($resultat as $tableau){
  extract($tableau);
  echo "<tr>
  <td>$nom</td>
  <td>$competence</td>
  <td>$niveau</td>
  <td><button>modifier</button></td>
  <td><button>supprimer</button></td>

  </tr>";
}
?>
               
</body>
</html>