<?php
class Crudite
{
    // PROPRIETE DE CLASSE (static)
    static $tabAssoReponse = [];    // AU DEPART LE TABLEAU EST VIDE

    // METHODE DE CLASSE (static)
    static function cruder ()
    {
        // DEBUG
        // ON VA RENVOYER CE QU'ON RECOIT...
        // JE RAJOUTE UN NOUVEL ELEMENT DANS LE TABLEAU
        Crudite::$tabAssoReponse["request"] = $_REQUEST;
        
        $formulaire = $_REQUEST["formulaire"] ?? "";
                
        if ($formulaire == "create")
        {
            Crudite::creer();
        }

        if ($formulaire == "read")
        {
            // EN PROGRAMMATION PAR CLASSE
            // POUR APPELER UNE METHODE
            // ON PRECISE D'ABORD LA CLASSE ET ENSUITE LA METHODE A APPELER
            // Classe::methode()
            Crudite::lire();
        }

        if ($formulaire == "update")
        {
            Crudite::modifier();
        }

        if ($formulaire == "delete")
        {
            Crudite::supprimer();
        }

        // ON VA FOURNIR DU JSON
        echo json_encode(Crudite::$tabAssoReponse, JSON_PRETTY_PRINT);
        
    }
    
    // UPDATE
    static function modifier ()
    {
        // TODO: AJOUTER SECURITE... 

        // ON VA MAINTENANT RECUPERER CHAQUE INFO DU FORMULAIRE
        // ET ENSUITE LES STOCKER DANS LA TABLE SQL todo
        $tabAssoColonneValeur = [
            // COLONNE SQL      HTML
            // "titre"          name="titre"
            "id"            =>  $_REQUEST["id"] ?? "",          // IMPORTANT
            "titre"         =>  $_REQUEST["titre"] ?? "",
            "description"   =>  $_REQUEST["description"] ?? "",
            "statut"        =>  $_REQUEST["statut"] ?? "",
            "photo"         =>  $_REQUEST["photo"] ?? "",
        ];
    
        // IL FAUDRA GERER A PART LE CAS DE L'UPLOAD QUI DEVIENT OPTIONNEL
        // ... 
        
        $requetePrepareeSQL =     
        " UPDATE todo
         SET
             titre       = :titre,
             description = :description,
             statut      = :statut,
             photo       = :photo
         WHERE id = :id";
 

        
        $pdoStatement = Model::envoyerRequeteSQL($requetePrepareeSQL, $tabAssoColonneValeur);
    
        // ON FAIT AUSSI UN READ APRES LE CREATE POUR RENVOYER LA NOUVELLE LISTE 
        // AVEC LA TACHE QUI VIENT D'ETRE CREE... 
        Crudite::lire();
    }

    // DELETE
    static function supprimer ()
    {
        // TODO: AJOUTER SECURITE... 

        // ON VA MAINTENANT RECUPERER CHAQUE INFO DU FORMULAIRE
        // ET ENSUITE LES STOCKER DANS LA TABLE SQL todo
        $tabAssoColonneValeur = [
            // COLONNE SQL      HTML
            // "titre"          name="titre"
            "id"         =>  $_REQUEST["id"] ?? "",
        ];
    
        $requetePrepareeSQL =" DELETE FROM todo
        WHERE id = :id";
        $pdoStatement = Model::envoyerRequeteSQL($requetePrepareeSQL, $tabAssoColonneValeur);
    
        // ON FAIT AUSSI UN READ APRES LE DELETE POUR RENVOYER LA NOUVELLE LISTE 
        // AVEC LA TACHE QUI VIENT D'ETRE CREE... 
        Crudite::lire();
    }

    // CREATE
    static function creer ()
    {
        // TODO: AJOUTER SECURITE... 

        // ON VA MAINTENANT RECUPERER CHAQUE INFO DU FORMULAIRE
        // ET ENSUITE LES STOCKER DANS LA TABLE SQL todo
        $tabAssoColonneValeur = [
            // COLONNE SQL      HTML
            // "titre"          name="titre"
            "titre"         =>  $_REQUEST["titre"] ?? "",
            "description"   =>  $_REQUEST["description"] ?? "",
            "statut"        =>  $_REQUEST["statut"] ?? "",
        ];
    
        $requetePrepareeSQL = "INSERT INTO `todo` 
        (`id`, `titre`, `description`, `statut`) 
        VALUES 
        (NULL, :titre, :description, :statut)";
    

        
        $pdoStatement = Model::envoyerRequeteSQL($requetePrepareeSQL, $tabAssoColonneValeur);
    
        // ON FAIT AUSSI UN READ APRES LE CREATE POUR RENVOYER LA NOUVELLE LISTE 
        // AVEC LA TACHE QUI VIENT D'ETRE CREE... 
        Crudite::lire();

    }

    // READ
    static function lire ()
    {
        // ON VA AJOUTER LE CODE PHP
        // POUR FAIRE UN READ
        // POUR ENVOYER LA LISTE DES TACHES AU NAVIGATEUR
        $tabAssoColonneValeur = [];
    
        $requetePrepareeSQL = "SELECT * FROM todo
    ORDER BY id DESC";
    
    
        // ON PASSE PAR LA METHODE envoyerRequeteSQL QUI EST DANS LA CLASSE Model
        $pdoStatement = Model::envoyerRequeteSQL($requetePrepareeSQL, $tabAssoColonneValeur);

        // ON RECUPERE LES LIGNES SQL EN PHP DANS UN TABLEAU ASSOCIATIF
        $tabAssoLigne = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        // JE L'AJOUTE DANS LE TABLEAU DE REPONSE A ENVOYER AU NAVIGATEUR
        Crudite::$tabAssoReponse["tableauArticle"] = $tabAssoLigne;

    }
}


class Model
{
    // METHODE STATIC DE CLASSE
    static function envoyerRequeteSQL ($requetePrepareeSQL, $tabAssoColonneValeur)
    {
        // POUR AJOUTER LA LIGNE DANS LA TABALE SQL
        // ETAPE1: SE CONNECTER A LA BASE DE DONNEES
        // https://www.php.net/manual/fr/pdo.construct.php
        $pdo = new PDO("mysql:host=localhost;dbname=datas;charset=utf8", "root", "");
    
        // SECURITE: POUR SE PROTEGER CONTRE LES INJECTIONS SQL
        // POUR ENVOYER LA REQUETE
        // ON SEPARE LES INFOS DE LA REQUETE SQL PREPAREE
        $pdoStatement = $pdo->prepare($requetePrepareeSQL);
        $pdoStatement->execute($tabAssoColonneValeur);

        // DEBUG: A ACTIVER SEULEMENT EN CAS DE PROBLEME
        // https://www.php.net/manual/fr/pdostatement.debugdumpparams.php
        // $pdoStatement->debugDumpParams();

        // POUR POUVOIR FAIRE LE READ...
        return $pdoStatement;
    }
}


// POUR ACTIVER MON CODE
// => J'APPELLE LA METHODE STATIC DE LA CLASSE
Crudite::cruder();

