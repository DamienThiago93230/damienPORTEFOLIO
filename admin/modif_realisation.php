<?php require 'connexion.php'; 

session_start(); // à mettre dans toutes les pages de l'admin 

if (isset($_SESSION['connexion_admin'])) { // Si on est connecter on récupère les variables de sesion 
    $id_utilisateur=$_SESSION['id_utilisateur'];
    $email=$_SESSION['email'];
    $mdp=$_SESSION['mdp'];
    $nom=$_SESSION['nom'];
    // echo $id_utilisateur;
}else { // Si on est pas connecté on ne peut peut pas se connecter
    header('location:authentification.php');
}

// Récupère les données de l'utilisateur par son id
$sql = $pdoCV -> query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur = '$id_utilisateur'"); 
$ligne_utilisateur = $sql-> fetch();


// Pour vider les variables de session destruy !
if (isset($_GET['quitter'])) { // On récupère le terme quitter en GET
    $_SESSION['connexion_admin'] = '';
    $_SESSION['id_utilisateur'] = '';
    $_SESSION['email'] = '';
    $_SESSION['nom'] = '';
    $_SESSION['mdp'] = '';

    unset($_SESSION['connexion_admin']); // unset détruit la variable connexion_admin
    session_destroy(); // On detruit la session

    header('location:authentification.php');
}

//Gestion mise à jour d'une information
if(isset($_POST['titre_real'])){ 
    $titre_real = addslashes($_POST['titre_real']);
    $stitre_real = addslashes($_POST['stitre_real']);
    $dates_real = addslashes($_POST['dates_real']);
    $description_real = addslashes($_POST['description_real']);
    $id_realisation = $_POST['id_realisation'];
    
    $pdoCV -> exec("UPDATE t_realisations SET titre_real = '$titre_real', stitre_real = '$stitre_real', dates_real = '$dates_real', description_real = '$description_real' WHERE id_realisation = '$id_realisation' ");

    header('location: ../admin/realisations.php');
    exit();
} 


// je récupère l'id de ce que je mets à jour
$id_realisation = $_GET['id_realisation']; // par son id et avec GET

$sql = $pdoCV -> query("SELECT * FROM t_realisations WHERE id_realisation = '$id_realisation'");
$ligne_real = $sql -> fetch(); // va chercher dans la bdd


require_once 'inc/haut_page.php';
require_once 'inc/navigation.php';

?>
       
        <h1 class="text-center mb-4">Mise à jour de la formation</h1>
        <div class="formulaire mx-auto text-center">
        <!-- Mise à jour d'un titre_form -->
        <form action="modif_realisation.php" method="post" class="px-4 py-3">
            <div class="form-group">
                <label for="titre_real">Titre</label>
                <input type="text" name="titre_real" class="form-control" value="<?= $ligne_real['titre_real']; ?>" required>
            </div>
        
            <div class="form-group">
                <label for="stitre_real">Sous-titre</label>
                <input type="text" name="stitre_real" class="form-control" value="<?= $ligne_real['stitre_real']; ?>">
            </div>
            
            <div class="form-group">
                <label for="dates_real">Dates</label>
                <input type="text" name="dates_real" class="form-control" value="<?= $ligne_real['dates_real']; ?>">
            </div>

            <div class="form-group">
                <label for="description_real">description</label>
                <textarea type="text" name="description_real" class="form-control"><?= $ligne_real['description_real']; ?></textarea>
                <script>
                        // Replace the <textarea id="description_form"> with a CKEditor
                        // instance, using default configuration.
                        CKEDITOR.replace( 'description_real' );
                    </script>
            </div>
        
            <div>
                <input type="hidden" name="id_realisation" value="<?= $ligne_real['id_realisation']; ?>">
                <button type="submit" class="btn btn-primary">Mise à jour d'une realisation</button>
            </div>
        
        </form>
        </div>



<?php
require_once 'inc/bas_page.php';