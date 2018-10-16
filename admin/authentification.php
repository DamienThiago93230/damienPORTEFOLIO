<?php require 'connexion.php';

session_start(); // à mettre dans toutes les pages de l'admin 

// Traitement pour la connexion a l'admin
if (isset($_POST['connexion'])) { // Connexion est le name du button
    $email = addslashes($_POST['email']);
    $mdp = addslashes($_POST['mdp']);

    // On verifie email et mdp
    $sql = $pdoCV -> prepare(" SELECT * FROM t_utilisateurs where email='$email' AND mdp='$mdp'");

    $sql -> execute();
    $nbr_utilisateur = $sql -> rowCount(); // On compt si il est dans la BDD, le count retourne 0 si il n'y est pas  et répond 1 si c'est le cas

    if ($nbr_utilisateur == 0) { // Il n'y est pas !
        echo '<p>Erreur !!!</p>';
    }else {
        // echo $nbr_utilisateur; // Il y est
        $ligne_utilisateur = $sql -> fetch();

        $_SESSION['connexion_admin'] = 'connecté'; // Connexion pour l'admin

        $_SESSION['id_utilisateur'] = $ligne_utilisateur['id_utilisateur'];
        $_SESSION['email'] = $ligne_utilisateur['email'];
        $_SESSION['nom'] = $ligne_utilisateur['nom'];
        $_SESSION['mdp'] = $ligne_utilisateur['mdp'];
        
        header('location:../admin/index.php');
    }
}

// Je inc tous le haut de page le Doctype, les meta et les liens
require_once 'inc/haut_page.php';

?>
    <h1 class="text-center mb-4 mt-4">Admin : authentification</h1>
       <div class="formulaire">
        <form action="authentification.php" method="post">
            <div class="form-group">
                <label for="email">Votre email</label>
                <input type="email" name="email" id="email" placeholder="Votre email" class="form-control" required>
            </div>
    
            <div class="form-group">
                <label for="mdp">Votre mdp</label>
                <input type="password" name="mdp" id="mdp" placeholder="Votre mot de passe" class="form-control" required>
            </div>
    
            <button type="submit" name="connexion" class="btn btn-primary">Se connecter</button>
        </form> 
    </div>
    
<?php

    
