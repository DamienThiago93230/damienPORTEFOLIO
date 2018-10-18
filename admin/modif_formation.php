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
if(isset($_POST['titre_form'])){ 
    $titre_form = addslashes($_POST['titre_form']);
    $stitre_form = addslashes($_POST['stitre_form']);
    $dates_form = addslashes($_POST['dates_form']);
    $description_form = addslashes($_POST['description_form']);
    $id_formation = $_POST['id_formation'];
    
    $pdoCV -> exec("UPDATE t_formations SET titre_form = '$titre_form', stitre_form = '$stitre_form', dates_form = '$dates_form', description_form = '$description_form' WHERE id_formation = '$id_formation' ");

    header('location: ../admin/formations.php');
    exit();
} 


// je récupère l'id de ce que je mets à jour
$id_formation = $_GET['id_formation']; // par son id et avec GET

$sql = $pdoCV -> query("SELECT * FROM t_formations WHERE id_formation = '$id_formation'");
$ligne_form = $sql -> fetch(); // va chercher dans la bdd


require_once 'inc/haut_page.php';
require_once 'inc/navigation.php';

?>
       
    
        
        <h1 class="text-center mb-4">Mise à jour de la formation</h1>
        <div class="formulaire mx-auto text-center">
        <!-- Mise à jour d'un titre_form -->
        <form action="modif_formation.php" method="post" class="px-4 py-3">
            <div class="form-group">
                <label for="titre_form">Titre</label>
                <input type="text" name="titre_form" class="form-control" value="<?= $ligne_form['titre_form']; ?>" required>
            </div>
        
            <div class="form-group">
                <label for="stitre_form">Sous-titre</label>
                <input type="text" name="stitre_form" class="form-control" value="<?= $ligne_form['stitre_form']; ?>">
            </div>
            
            <div class="form-group">
                <label for="dates_form">Dates</label>
                <input type="text" name="dates_form" class="form-control" value="<?= $ligne_form['dates_form']; ?>">
            </div>

            <div class="form-group">
                <label for="description_form">description</label>
                <textarea type="text" name="description_form" class="form-control"><?= $ligne_form['description_form']; ?></textarea>
                <script>
                        // Replace the <textarea id="description_form"> with a CKEditor
                        // instance, using default configuration.
                        CKEDITOR.replace( 'description_form' );
                    </script>
            </div>
        
        
            <div>
                <input type="hidden" name="id_formation" value="<?= $ligne_form['id_formation']; ?>">
                <button type="submit" class="btn btn-primary">Mise à jour d'une formation</button>
            </div>
        
        </form>
        </div>



<?php
require_once 'inc/bas_page.php';