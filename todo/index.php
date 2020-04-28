<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
  <title>Document</title>
</head>

<body>
  <header>
    <h1>Todo List</h1>
    <div class="ligne"></div>
  </header>
  <main>
    <section class="creat">
      <form class="ajax creat" method="post">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" name="title" class="form-control" id="title" placeholder="Enter your title todo">
        </div>

        <div class="form-group">
          <label for="description">Description</label>
          <input type="text" name="description" class="form-control" id="description" placeholder="Enter your description todo">
        </div>
          <label>
            
            <input type="radio" name="statut" value="todo">
            <span>todo</span>
          </label>
          </div>
          <div>
          <label>
            <input type="radio" name="statut" value="ongoing">
            <span>ongoing</span>
          </label>
          </div>
          <div>
          <label>
            <input type="radio" name="statut" value="done">
            <span>done</span>
          </label>
          </div>

        <input type="hidden" name="formulaire" value="creat">
        <button type="submit" class="btn btn-primary ">Ajouter</button>
    </form>

    </section>
    <section class="update">
      <form class="ajax update" method="post">
        <div class="form-group">
          <label for="id">ID</label>
          <input type="text" name="id" class="form-control" id="id" placeholder="Enter your ID">
        </div>
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" name="title" class="form-control" id="title" placeholder="Enter your title todo">
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <input type="text" name="description" class="form-control" id="description" placeholder="Enter your description todo">
        </div>
        <div>
          <label>
            <input type="radio" name="statut" value="todo">
            <span>todo</span>
          </label>
        </div>
        <div>
          <label>
            <input type="radio" name="statut" value="ongoing">
            <span>ongoing</span>
          </label>
        </div>
        <div>
          <label>
            <input type="radio" name="statut" value="done">
            <span>done</span>
          </label>
        </div>
        <input type="hidden" name="formulaire" value="update">
        <button type="submit" class="btn btn-primary ">Modifier</button>
      </form>
    </section>

    <section class="delete">
      <form class="ajax delete" method="post">
        <div class="form-group">
          <label for="id">ID</label>
          <input type="text" name="id" class="form-control" id="id" placeholder="Enter your ID">
        </div>
        <input type="hidden" name="formulaire" value="delete">
        <button type="submit" class="btn btn-primary ">SUPPRIMER</button>
      </form>
    </section>
    <section class="affichage">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Statut</th>
            <th scope="col">Modifier</th>
            <th scope="col">supprimer</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          </tr>
        </tbody>
      </table>
    </section>
  </main>
  <footer>

  </footer>
  <script src="assets/js/app.js"></script>
</body>

</html>