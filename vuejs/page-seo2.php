<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- ETAPE 2: ON DEFINIT LA ZONE D'ACTION -->
    <div id="app">

        <header>
            <h1>TITRE DE MA PAGE</h1>
        </header>
        <main>
            <section class="contenuAjax">
                <h2>TITRE DE MA SECTION AVEC LE CONTENU A REFERENCER</h2>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Commodi veniam, consequuntur quae quas quam voluptatibus molestias aut corrupti excepturi aspernatur totam nemo impedit culpa ipsam, eligendi cumque dolorum alias voluptatum.</p>
            </section>
        </main>
        <footer>
            <p>tous droits réservés</p>
        </footer>

    </div><!-- FIN DE #app -->


    <!-- ASTUCE: ON CHANGE LA VALEUR DE L'ATTRIBUT type LE NAVIGATEUR IGNORE LE CODE DANS LA BALISE -->
    <!-- LE 2E EFFET KISSCOOL : LES MOTEURS DE RECHERCHE IGNORENT AUSSI CETTE BALISE script -->
    <!-- JE PEUX PLANQUER MON CODE POUR VUEJS DANS CETTE BALISE script -->
    <script id="codeVue" type="text/moncodeamoi">

    <h2>TITRE DE MA SECTION {{ message }}</h2>
    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Commodi veniam, consequuntur quae quas quam voluptatibus molestias aut corrupti excepturi aspernatur totam nemo impedit culpa ipsam, eligendi cumque dolorum alias voluptatum.</p>
    <input type="text" v-model="message">
    {{ message.length }}

    </script>

    <!-- ETAPE 1: JE RAJOUTE LE SCRIPT DE VUEJS -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script>
var moncode = {};
// DECLARATION
moncode.installerVue = function ()
{
    // ICI JE DOIS D'ABORD METTRE EN PLACE LE CODE HTML AVEC LE CODE VUEJS
    var baliseScript = document.querySelector("#codeVue");
    var codeHTML = baliseScript.innerHTML;
    // DEBUG
    // console.log(codeHTML);
    // IL SUFFIT DE COPIER CE CODE POUR REMPLACER LE CONTENU A REFERENCER
    var baliseContenu = document.querySelector(".contenuAjax"); 
    baliseContenu.innerHTML = codeHTML;
    
    // MAINTENANT QUE J'AI LE CODE HTML AVEC LE CODE POUR VUEJS
    // JE PEUX ACTIVER VUEJS POUR QU'IL PRENNE LA MAIN...
    var app = new Vue({
        el: '#app',
        data: {
            message: 'Hello Vue!'
        }
    })

}

// ACTIVATION
moncode.installerVue();



    </script>
</body>
</html>