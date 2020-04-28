let listeFormulaire=document.querySelectorAll(".ajax")
listeFormulaire.forEach(function(formulaire){
    formulaire.addEventListener("submit",function(e){
        e.preventDefault();
        let type=e.target;

        let formData=new FormData(type);
        let contenu={
            method:'post',
            body:formData
        }
        //pour moi ici js va communiquer avec php a travers apache(serveur) en lui passant des donnes qui va ce dernier les traités et les envoyés a sql
        //php va renvoyer ces donnes a javascript a travers apache  pour quil puisse ce dernier les affichers sur html le DOM  
        //la requette http qui permet de communiquer entre le client et le serveur 
        fetch("api-ajax.php",contenu)
        .then(function(res)
        {
            return res.json();
        })
        .then(function(objet){
            let affichage=document.querySelector(".table")
            let length=objet.article.length
            for(let i=0;i<length;i++){
            let article=objet.article[i]
                affichage.innerHTML+=`
                <td>${article.id}</td>
                <td>${article.title}</td>
                <td>${article.description}</td>
                <td>${article.statut}</td>
                <td><button type="button" class="btn btn-success" data-indice="${i}" data-id="${article.id}">Modifier</button> </td>
                <td><button type="button" class="btn btn-danger" data-id="${article.id}">Supprimer</button></td>
              `;
              
            }
        })
    });

        var listeBoutonSupprimer = document.querySelectorAll(".btn btn-danger");
        listeBoutonSupprimer.forEach(function(bouton) {
            bouton.addEventListener("click", function supprimerLigne (event)
            {
                // DEBUG
                console.log(event.target);
                var bouton = event.target;
                // JE RECUPERE id DE LA LIGNE A SUPPRIMER
                var id = bouton.getAttribute("data-id");
                // ET JE COPIE id DANS LE FORMULAIRE
                var inputId = document.querySelector("form.delete input[name=id]");
                inputId.value = id;
            
                // MAINTENANT ON VA DECLENCHER L'ENVOI DU FORMULAIRE DE DELETE
                // document.querySelector("form.delete").submit(); // ENVOI SANS AJAX
                document.querySelector("form.delete button[type=submit]").click();
            });
    
    
        var listeBoutonModifier = document.querySelectorAll(".btn btn-success");
        listeBoutonModifier.forEach(function(bouton) {
            bouton.addEventListener("click", function modifierLigne (event)
            {
                // DEBUG
                console.log(event.target);
                var bouton = event.target;
                // JE RECUPERE indice CORRESPONDANT DANS tableauArticle
                var indice = bouton.getAttribute("data-indice");
                var article = tableauArticle[indice];
                // DEBUG
                console.log(article);
            
                // MAINTENANT IL FAUT COPIER LES INFOS DANS LE FORMULAIRE UPDATE
                // id, titre, description, statut, photo
                document.querySelector("form.update input[name=id]").value = article.id;
                document.querySelector("form.update input[name=titre]").value = article.title;
                document.querySelector("form.update input[name=description]").value = article.description;
            
                // PB: COMME ON UTILISE 3 BALISES radio POUR LE STATUT... CA NE MARCHE PAS COMME POUR LES text...
                // document.querySelector("form.update input[name=statut]").value = article.statut;
                // => IL FAUT CHOISIR LA BONNE BALISE ET LUI RAJOUTER L'ATTRIBUT checked
                // ASTUCE: JE VAIS ME SERVIR DE article.statut POUR CONSTRUIRE LE SELECTEUR DE LA BONNE BALISE radio
                // "form.update input[value=todo]"
                // "form.update input[value=ongoing]"
                // "form.update input[value=done]"
                var selecteurRadio = "form.update input[value=" + article.statut + "]";
                // JE SELECTIONNE EN CSS LA BONNE BALISE radio ET JE LA CHECK EN HTML
                document.querySelector(selecteurRadio).checked = true;
            });
        });
    
    })
})
var tableauArticle = [];    // CE SERA LE SERVEUR QUI VA ME CONSTRUIRE CE TABLEAU

var listeFormulaire = document.querySelectorAll("form.ajax");
// ON FAIT UNE BOUCLE POUR AGIR SUR CHAQUE FORMULAIRE UN PAR UN
listeFormulaire.forEach(function(formulaire){
    // POUR CHAQUE FORMULAIRE
    // ON VA BLOQUER LE FONCTIONNEMENT CLASSIQUE
    // ET ON VA ENVOYER LES INFOS PAR AJAX
    formulaire.addEventListener("submit", envoyerFormulaireAjax);
});

// QUAND ON CHARGE LA PAGE
// ON VA AUTOMATIQUEMENT DECLENCHER LE CLICK SUR LE FORMULAIRE read
// => CA EVITE AU VISITEUR DE LE FAIRE
document.querySelector("form.read button[type=submit]").click();

// LA FONCTION envoyerFormulaireAjax SERA APPELEE PAR JS (PAS PAR MOI)
//      (ET JS FOURNIRA LE PARAMETRE event...)
// QUAND IL SE PRODUIRA L'EVENEMENT submit SUR LE FORMULAIRE
// (QUAND LE VISITEUR VA APPUYER SUR LE BOUTON "CREER UNE TACHE")
// => FONCTION "CALLBACK"
// VERSION1: CLASSIQUE
function envoyerFormulaireAjax (event) 
{
    // LE PARAMETRE event NOUS SERT A BLOQUER LE FORMULAIRE CLASSIQUE...
    event.preventDefault();
    console.log("FORMULAIRE AJAX EN COURS...");

    // https://developer.mozilla.org/fr/docs/Web/Guide/Using_FormData_Objects
    // ON VA RECUPERER LES INFOS DU FORMULAIRE
    // ET ENSUITE ON VA ENVOYER LE REQUETE AJAX AVEC fetch

    var formulaire = event.target;
    // ON VA UTILISER UN OBJET DE LA CLASSE FormData
    // => CET OBJET SERVIRA DE CONTAINER AUX INFOS DU FORMULAIRE
    var formData = new FormData(formulaire);    
                                    // => AUTOMATIQUEMENT, 
                                    // formData VA ASPIRER TOUTES LES INFOS DU formulaire
                                    // COOL POUR NOUS ;-p

    // MAINTENANT ON PEUT ENVOYER LA REQUETE AJAX AVEC fetch
    var contenuForm = 
    {
        method: 'POST',     // NECESSAIRE POUR UPLOAD DE FICHIER
        body:   formData
    };
    // LA FONCTION fetch DE JS ENVOIE UNE REQUETE AJAX VERS api-ajax.php (le premier paramètre)
    fetch("api-ajax.php", contenuForm)
    // POUR LE READ IL FAUT COMPLETER LE CODE POUR RECUPERER LES DONNEES RENVOYEES PAR LE SERVEUR
    .then(function(responseServer) {
        // DEBUG
        console.log(responseServer);

        // EXTRAIRE UN OBJET JS DEPUIS LA REPONSE DU SERVEUR
        return responseServer.json();
    })
    .then(function(objetJSON) {
        // DEBUG
        console.log(objetJSON);

        // SI LE TABLEAU DES ARTICLES EST FOURNI PAR LE SERVEUR
        // ALORS JE VAIS M'EN SERVIR POUR CONSTRUIRE LE HTML
        if ('tableauArticle' in objetJSON)
        {
            // ON COPIE LE TABLEAU DANS NOTRE VARIABLE tableauArticle
            tableauArticle = objetJSON.tableauArticle;
            // => CE TABLEAU JSON SERA EN FAIT FOURNI PAR LE SERVEUR WEB (PHP + TABLE SQL)
            // => LES PROPRIETES SERONT CONSTRUITES A PARTIR DES NOMS DES COLONNES SQL
            rafraichirListeArticle();

        }
    })
    ;

};


// PROGRAMMATION FONCTIONNELLE
// => JE RANGE MON CODE DANS DES FONCTIONS

function rafraichirListeArticle ()
{
    // ON REMET LA LISTE A ZERO
    var baliseListTodo = document.querySelector(".listTodo");
    baliseListTodo.innerHTML = '';

    for(var indice=0; indice < tableauArticle.length; indice++)
    {
        var article = tableauArticle[indice];
        var codeHTML = 
        `
                    <article class="${article.statut}">
                        <h3>${article.titre}</h3>
                        <p>${article.description}</p>
                        <p>${article.statut}</p>
                        <p>${article.id}</p>
                        <img src="${article.photo}">
                        <button class="update" data-indice="${indice}" data-id="${article.id}">modifier</button>
                        <button class="delete" data-id="${article.id}">supprimer</button>
                    </article>
        `;
        // AJOUTER DANS LA BALISE listTodo
        baliseListTodo.innerHTML += codeHTML;
    }

    // CHRONOLOGIE: 
    // JE DOIS ATTENDRE QUE LES BOUTONS SOIENT RAJOUTES AVEC LES ARTICLES
    // ET ENSUITE JE PEUX AJOUTER LES EVENT LISTENER DESSUS

    // UNE FOIS QU'ON A CREE LES ARTICLES AVEC LES BOUTONS SUPPRIMER
    // ON VA AJOUTER UN EVENT LISTENER SUR CHAQUE BOUTON
    var listeBoutonSupprimer = document.querySelectorAll(".listTodo button.delete");
    listeBoutonSupprimer.forEach(function(bouton) {
        bouton.addEventListener("click", supprimerLigne);
    });


    var listeBoutonModifier = document.querySelectorAll(".listTodo button.update");
    listeBoutonModifier.forEach(function(bouton) {
        bouton.addEventListener("click", modifierLigne);
    });

}


function modifierLigne (event)
{
    // DEBUG
    console.log(event.target);
    var bouton = event.target;
    // JE RECUPERE indice CORRESPONDANT DANS tableauArticle
    var indice = bouton.getAttribute("data-indice");
    var article = tableauArticle[indice];
    // DEBUG
    console.log(article);

    // MAINTENANT IL FAUT COPIER LES INFOS DANS LE FORMULAIRE UPDATE
    // id, titre, description, statut, photo
    document.querySelector("form.update input[name=id]").value = article.id;
    document.querySelector("form.update input[name=titre]").value = article.titre;
    document.querySelector("form.update input[name=description]").value = article.description;

    // PB: COMME ON UTILISE 3 BALISES radio POUR LE STATUT... CA NE MARCHE PAS COMME POUR LES text...
    // document.querySelector("form.update input[name=statut]").value = article.statut;
    // => IL FAUT CHOISIR LA BONNE BALISE ET LUI RAJOUTER L'ATTRIBUT checked
    // ASTUCE: JE VAIS ME SERVIR DE article.statut POUR CONSTRUIRE LE SELECTEUR DE LA BONNE BALISE radio
    // "form.update input[value=todo]"
    // "form.update input[value=ongoing]"
    // "form.update input[value=done]"
    var selecteurRadio = "form.update input[value=" + article.statut + "]";
    // JE SELECTIONNE EN CSS LA BONNE BALISE radio ET JE LA CHECK EN HTML
    document.querySelector(selecteurRadio).checked = true;
}

// FONCTION DE CALLBACK SUR LE CLICK DU BOUTON SUPPRIMER
function supprimerLigne (event)
{
    // DEBUG
    console.log(event.target);
    var bouton = event.target;
    // JE RECUPERE id DE LA LIGNE A SUPPRIMER
    var id = bouton.getAttribute("data-id");
    // ET JE COPIE id DANS LE FORMULAIRE
    var inputId = document.querySelector("form.delete input[name=id]");
    inputId.value = id;

    // MAINTENANT ON VA DECLENCHER L'ENVOI DU FORMULAIRE DE DELETE
    // document.querySelector("form.delete").submit(); // ENVOI SANS AJAX
    document.querySelector("form.delete button[type=submit]").click();
}
