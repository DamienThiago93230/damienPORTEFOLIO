<?php

require 'inc/haut_page.php'; 
$message = '';

$inscription = false; // Pour savoir si l'internaute vien de s'inscrire (on mettra la variable à true) et ne plus afficher le formulaire d'inscription

// var_dump($_POST);

// Traitement du formulaire :
if (!empty($_POST)) { // Si le formulaire est soumis
    
    // Validation des champs du formulaire: 

        if (!isset($_POST['prenom']) || strlen($_POST["prenom"]) < 2 || strlen($_POST["prenom"]) > 50) 
        $message .= '<div> Le prénom doit comporter entre 3 et 20 caractéres.<div>';

        if (!isset($_POST['nom']) || strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 50) 
        $message .= '<div>Le nom doit contenir entre 2 et 20 caractères.</div>';

        if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL ) ) $contenu .='<div class="bg-danger">Email est incorrect.</div>'; // filter_var() avec l'argument FILTER_VALIDATE_EMAIL valide que $_POST['email'] est bien de format d'un email. Notez que cela marche aussi pour valider les URL avec FILTER_VALIDATE_URL

        if (!isset($_POST['telephone']) || strlen($_POST['telephone']) == 10 ) 
        $message .= '<div>Le telephone doit contenir entre 2 et 20 caractères.</div>'; 
        
        if (!isset($_POST['portable']) || strlen($_POST['portable']) == 10 ) 
        $message .= '<div>Le portable doit contenir entre 2 et 20 caractères.</div>'; 
        
        if (!isset($_POST['mdp']) || strlen($_POST['mdp']) < 2 || strlen($_POST['mdp']) > 50) 
        $message .= '<div>Le mdp doit contenir entre 2 et 20 caractères.</div>'; 

        if (!isset($_POST['pseudo']) || strlen($_POST['pseudo']) < 2 || strlen($_POST['pseudo']) > 50) 
        $message .= '<div>Le pseudo doit contenir entre 2 et 20 caractères.</div>'; 

        if (!isset($_POST['age']) || strlen($_POST['age']) == 10 ) 
        $message .= '<div>Le age doit contenir entre 2 et 20 caractères.</div>'; 

        if (!isset($_POST['anniversaire']) || strlen($_POST['anniversaire']) == 10 ) 
        $message .= '<div>Le anniversaire doit contenir entre 2 et 20 caractères.</div>'; 

       if (!isset($_POST['genre']) || ($_POST['genre'] != 'homme' && $_POST['genre'] != 'femme'))
       $message .='<div>Ce n\'est pas le bon type.</div>';

       if (!isset($_POST['civilite']) || ($_POST['civilite'] != 'h' && $_POST['civilite'] != 'f'))
       $message .='<div>Ce n\'est pas le bon type.</div>';

       if (!isset($_POST['adresse']) || strlen($_POST['adresse']) < 2 || strlen($_POST['adresse']) > 20) 
       $message .= '<div>Le adresse entre 2 et 20 caractères.</div>';

       if (!isset($_POST['code_postal']) || strlen($_POST['code_postal']) == 5) 
       $message .= '<div>Le code_postal entre 2 et 20 caractères.</div>';

       if (!isset($_POST['ville']) || strlen($_POST['ville']) < 2 || strlen($_POST['ville']) > 20) 
       $message .= '<div>Le ville entre 2 et 20 caractères.</div>';

       if (!isset($_POST['pays']) || strlen($_POST['pays']) < 2 || strlen($_POST['pays']) > 20) 
       $message .= '<div>Le adresse entre 2 et 20 caractères.</div>';

       if (!isset($_POST['commentaire']) || strlen($_POST['commentaire']) < 2 || strlen($_POST['commentaire']) > 20) 
       $message .= '<div>Le commentaire entre 2 et 20 caractères.</div>';


    //***************
    // Si pas d'erreur sur le formulaire, on vérifie que le pseudo est disponible dans la BDD :
    if(empty($contenu)){ // Si $contenu est vide c'est qu'il n'y à pas d'erreur

        // Vérification du pseudo :
        $membre = executeRequete("SELECT * FROM utilisateur WHERE pseudo = :pseudo", array(':pseudo' => $_POST['pseudo'])); // On sélectionne en base les éventuels membres dont le pseudo correspond au pseudo donné par l'internaute lors de l'inscription.


        if ($membre->rowCount()) {  // si la requ^te retourne 1 ou plusieurs résultats, c'est que le pseudo existe en BDD
            $contenu .= '<div class="bg-danger">Le pseudo est indisponible. Veuillez en choisir un autre</div>';
        } else {
            // sinon, le pseudo étant disponible, on enregistre le membre dans la BDD :
            executeRequete("INSERT INTO utilisateur (prenom, nom, email, telephone, portable, mdp, pseudo, age, anniversaire, genre, civilite, adresse, code_postal, ville, pays, commentaire) values(:prenom, :nom, :email, :telephone, :portable,:mdp, :pseudo, :age, :anniversaire, :genre, :civilite, :adresse, :code_postal, :ville, :pays, :commentaire, 0)", 
                            array( 
                                ':prenom'           => $_POST['prenom'],
                                ':nom'              => $_POST['nom'],
                                ':email'            => $_POST['email'],
                                ':telephone'        => $_POST['telephone'],
                                ':portable'         => $_POST['portable'],
                                ':mdp'              => $_POST['mdp'],
                                ':pseudo'           => $_POST['pseudo'],
                                ':age'              => $_POST['age'],
                                ':anniversaire'     => $_POST['anniversaire'],
                                ':genre'            => $_POST['genre'],
                                ':civilite'         => $_POST['civilite'],
                                ':adresse'          => $_POST['adresse'],
                                ':code_postal'      => $_POST['code_postal'],
                                ':ville'            => $_POST['ville'],
                                ':pays'             => $_POST['pays'],
                                ':commentaire'      => $_POST['commentaire']
                                
                            )); 
            $contenu .= '<div class="bg-success">Super vous êtes inscrit à notre site. <a href="connexion.php"</a>Cliquez ici pour vous connecter.</div>';
            $inscription = true; // Pour ne plus afficher le formulaire sur cette page
        } // Fin du else


    }// Fin du if (empty($contenu))




} // Fin du if (!empty($_POST))


?>

<h1 class="mt-4">Inscription</h1>

<?php

?>

    <p>Veuillez renseigner le formulaire pour vous inscrire.</p>

    <div class="formulaire">
        <form method="post" action="">
            <label for="prenom">prenom</label><br>
            <input type="text" name="prenom" id="prenom" value=""><br><br>
    
            <label for="nom">nom</label><br>
            <input type="text" name="nom" id="nom" value=""><br><br>
    
            <label for="email">email</label><br>
            <input type="text" name="email" id="email" value=""><br><br>
    
            <label for="telephone">telephone</label><br>
            <input type="text" name="telephone" id="telephone" value=""><br><br>
    
            <label for="portable">portable</label><br>
            <input type="text" name="portable" id="portable" value=""><br><br>
    
            <label for="mdp">mdp</label><br>
            <input type="text" name="mdp" id="mdp" value=""><br><br>
    
            <label for="pseudo">pseudo</label><br>
            <input type="text" name="pseudo" id="pseudo" value=""><br><br>
    
            <label for="age">age</label><br>
            <input type="text" name="age" id="age" value=""><br><br>
    
            <label for="anniversaire">anniversaire</label><br>
            <input type="text" name="anniversaire" id="anniversaire" value=""><br><br>
    
            <label for="genre">genre</label><br>
            <input type="radio" name="genre" value="m" checked> Homme
            <input type="radio" name="genre" value="f"> Femme <br><br>
    
            <label for="civilite">Civilité</label><br>
            <input type="radio" name="civilite" value="m" checked> M
            <input type="radio" name="civilite" value="f"> Mme <br><br>
    
            <label for="adresse">adresse</label><br>
            <input type="text" name="adresse" id="adresse" value=""><br><br>
    
            <label for="code_postal">code_postal</label><br>
            <input type="text" name="code_postal" id="code_postal" value=""><br><br>
    
            <label for="ville">ville</label><br>
            <input type="text" name="ville" id="ville" value=""><br><br>
    
            <label for="pays">pays</label><br>
            <input type="text" name="pays" id="pays" value=""><br><br>
    
            <label for="commentaire">commentaire</label><br>
            <textarea type="text" name="commentaire" id="commentaire" value=""></textarea><br><br>
    
    
            <input type="submit" name="inscription" value="s'inscrire" class="btn">
            
            
        </form>

    </div> 


<?php
    


require_once 'inc/bas_page.php'; // footer et fermetures des balises