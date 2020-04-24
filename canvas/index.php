<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <title>Document</title>
</head>
<body>
  <header>
    <h1 class="h1"><span style="color:#4285f4">T</span><span style="color:#ea4335">o</span><span style="color:#fbbc05">d</span><span style="color:#4285f4">o</span><span style="color:#34a853">L</span><span style="color:#4285f4">i</span><span style="color:#ea4335">s</span><span style="color:#fbbc05">t</h1>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <a class="navbar-brand" href="#">Menu</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-item nav-link active" href="#">Ajouter </a>
          <a class="nav-item nav-link active" href="#">Modifier</a>
          <a class="nav-item nav-link active" href="#">Supprimer</a>
        </div>
      </div>
    </nav>
  </header><br>
  <!--section create formulaire-->
  <section class="inserer">
    <form class='creat' method="post">
      <div class="container-fluid">
        <div class="form-group">
          <label for="titre">Title</label>
          <input type="text" class="form-control" id="titre" name="title">
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <input type="hidden" name="identifiantFormulaire" value="creat">
        <button type="submit" class="btn btn-primary">Enregistrer</button><br><br>
        <?php 
       $formulaire=$_POST["identifiantFormulaire"];
      if($formulaire=="creat") {
        require "php/controller/controller.php";
      }       
        ?>
    </form>
    <div class="confirmation">
  </section>
  <!-- secttion modification formulaire  -->
  <section class="modifier">
    <form class='update' method="post">
      <div class="container-fluid">
        <div class="form-group">
          <label for="ide">id</label>
          <input type="text" class="form-control" id="ide" name="id">
        </div>
        <div class="form-group">
          <label for="titre">Title</label>
          <input type="text" class="form-control" id="titre" name="title">
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <input type="hidden" name="identifiantFormulaire" value="update">
        <button type="submit" class="btn btn-primary">Modifier</button><br><br>
        <?php 
       $formulaire=$_POST["identifiantFormulaire"];
      if($formulaire=="update") {
        require "php/controller/controller.php";
      }       
        ?>

    </form>
  </section>
  <!--section supression formulaire-->
  <section class="supprimer cache">
    <form class='delete' method="post">
      <div class="container-fluid">
        <div class="form-group">
          <label for="titre">id</label>
          <input type="text" class="form-control" id="titre" name="id">
        </div>
        <input type="hidden" name="identifiantFormulaire" value="delete">
        <button type="submit" class="btn btn-primary">Supprimer</button><br><br>
      </div>
      <?php 
       $formulaire=$_POST["identifiantFormulaire"];
      if($formulaire=="delete") {
        require "php/controller/controller.php";
      }       
        ?>

    </form>
  </section>
<section class="affichage">
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Modifier</th>
      <th scope="col">Supprimer</th>
    </tr>
  </thead>
  <tbody>
    <?php $sql="SELECT * FROM todo";
    require "php/model/model.php";
    $tabLigne=$statement->fetchAll();
    foreach($tabLigne as $tab){
      extract($tab);
echo
      "<tr>
      <td>$id</td>
      <td>$title</td>
      <td>$description</td>
      <td><button class='mod' type='button' data-id='$id' class='btn btn-success'>Modifier</button></td>
      <td><button class='de' type='button' data-id='$id' class='btn btn-danger'>Supprimer</button></td>
    </tr>";

    }
   
    ?>
  </tbody>
</table>
</section>


<script src="assets/js/app.js"></script>
</body>

</html>