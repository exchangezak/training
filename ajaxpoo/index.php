<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODOLIST LH</title>
    <style>
html, body {
    width:100%;
    height:100%;
    padding:0;
    margin:0;
    font-size:16px;
}
* {
    box-sizing: border-box;
}
h1, h2, h3 {
    padding:0.5rem;
    text-align:center;
    margin:0;
}
form {
    display: flex;
    flex-direction: column;
    width:100%;
    padding:1rem;
}        
form > * {
    margin: 0.2rem;
    padding: 0.2rem;
    font-family: monospace;
    width:100%;
}

.listTodo {
    display:flex;
    flex-wrap: wrap;
    width:100%;
    justify-content: center;
}
.listTodo article {
    border:1px solid #aaaaaa;
    padding: 0.25rem;
    margin:0.25rem;
    width: calc(100% / 3 - 0.5rem); /* IL FAUT ENLEVER LE MARGIN */
    min-width:200px;
}

article img {
    width:100%;
    height:15vh;
    object-fit:cover;
}

article.todo {
    background-color: yellow;
}
article.done {
    background-color: green;
}
article.ongoing {
    background-color: orange;
}

article {
    transition: all 0.5s;
}
article:hover {
    border:1px solid #ffffff;
    box-shadow: 1px 2px 4px rgba(0,0,0,0.8);
}


body {
    display: flex;
    flex-direction: column;
    width:100%;
    align-items: center;
}

body > * {
    max-width:960px;
}

.cache {
    display: none;
}
    </style>
</head>
<body>
    <header>
        <h1>MA TODOLIST LH</h1>
    </header>
    <main>

        <section>
            <h2>FORMULAIRE DE CREATION (CREATE)</h2>
            <form class="ajax" action="" method="POST">
                <input type="text" name="titre" required placeholder="entrez le titre">
                <textarea name="description" cols="60" rows="5" required placeholder="entrez la description"></textarea>
                
                <label>
                    <input type="radio" name="statut" value="todo" required placeholder="entrez le statut">
                    <span>todo</span>
                </label>
                <label>
                    <input type="radio" name="statut" value="ongoing" required placeholder="entrez le statut">
                    <span>ongoing</span>
                </label>
                <label>
                    <input type="radio" name="statut" value="done" required placeholder="entrez le statut">
                    <span>done</span>
                </label>

                <!-- temporaire en attendant upload... -->
                <input type="text" name="photo" required placeholder="entrez la photo">
                <button type="submit">CREER UNE TACHE</button>
                <!-- ON AJOUTE UNE INFO NON VISIBLE AU VISITEUR MAIS QUI SERA ENVOYEE AU SERVEUR -->
                <input type="hidden" name="identifiantFormulaire" value="create">
            </form>
        </section>

        <section>
            <h2>FORMULAIRE DE MODIFICATION (UPDATE)</h2>
            <form class="ajax update" action="" method="POST">
                <input type="text" name="titre" required placeholder="entrez le titre">
                <textarea name="description" cols="60" rows="5" required placeholder="entrez la description"></textarea>
                
                <label>
                    <input type="radio" name="statut" value="todo" required placeholder="entrez le statut">
                    <span>todo</span>
                </label>
                <label>
                    <input type="radio" name="statut" value="ongoing" required placeholder="entrez le statut">
                    <span>ongoing</span>
                </label>
                <label>
                    <input type="radio" name="statut" value="done" required placeholder="entrez le statut">
                    <span>done</span>
                </label>

                <!-- temporaire en attendant upload... -->
                <input type="text" name="photo" placeholder="entrez la photo">

                <!-- IMPORTANT NE PAS OUBLIER L'ID DE LA LIGNE -->
                <input type="hidden" name="id" required placeholder="id de la ligne">

                <button type="submit">MODIFIER UNE TACHE</button>
                <!-- ON AJOUTE UNE INFO NON VISIBLE AU VISITEUR MAIS QUI SERA ENVOYEE AU SERVEUR -->
                <input type="hidden" name="identifiantFormulaire" value="update">
            </form>
        </section>

        <section class="cache">
            <h2>FORMULAIRE DE DELETE</h2>
            <form class="ajax delete" action="">
                <input type="number" name="id" required placeholder="id de la ligne">
                <button type="submit">SUPPRIMER LA LIGNE</button>
                <!-- ON AJOUTE UNE INFO NON VISIBLE AU VISITEUR MAIS QUI SERA ENVOYEE AU SERVEUR -->
                <input type="hidden" name="identifiantFormulaire" value="delete">
            </form>
        </section>

        <section>
            <h2>AFFICHAGE DES TACHES (READ)</h2>
            <!-- FORMULAIRE POUR RAFRAICHIR LA LISTE DES TACHES -->
            <form class="ajax read" action="" method="POST">
                <button type="submit">RAFRAICHIR LA LISTE DES TACHES</button>
                <!-- ON AJOUTE UNE INFO NON VISIBLE AU VISITEUR MAIS QUI SERA ENVOYEE AU SERVEUR -->
                <input type="hidden" name="identifiantFormulaire" value="read">
            </form>
            <div class="listTodo">
         
                
            </div>

        </section>
    </main>
    <footer>
        <p>tous droits réservés - 2020</p>
    </footer>
