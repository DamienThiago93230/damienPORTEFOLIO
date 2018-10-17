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

// gestion mise à jour d'une information
if (isset($_POST['competence'])) { 

    $competence = addslashes($_POST['competence']);
    $niveau = addslashes($_POST['niveau']);
    $categorie = addslashes($_POST['categorie']);

    $id_competence = $_POST['id_competence'];

    $pdoCV -> exec(" UPDATE t_competences SET competence = '$competence', niveau='$niveau', categorie = '$categorie' WHERE id_competence = '$id_competence' ");
    header('location: ../admin/competences.php');
    exit();
} // fin du (isset($_POST['competence']))

// je récupère l'id de ce que je mets à jour
$id_competence = $_GET['id_competence']; // par son id et avec GET 
$sql = $pdoCV -> query (" SELECT * FROM  t_competences WHERE id_competence='$id_competence' ");
$ligne_competence = $sql -> fetch(); // va récupérer les données 

?>
<!-- Je inc le footer et les lien JQuery, JS et bootstrap  -->
<?php require 'inc/haut_page.php'; ?>

<!-- Ici, j'inclus ma page naviagtion.php -->
<?php require 'inc/navigation.php'; ?>

    
        <h1 class="text-center">Mise à jour d'une compétence</h1>
        <!-- Mise à jour d'une nouvelle compétence formulaire  -->
        <div class="formulaire mx-auto text-center">
            <form action="modif_competence.php" method="post">
               <div class="form-group">
                    <label for="competence">Compétences</label>                
                    <input class="form-control" type="text" name="competence" value="<?php echo $ligne_competence['competence']; ?>" required>    
               </div>
        
               <div class="form-group">
                    <label for="niveau">Niveau</label>                
                    <input class="form-control" type="text" name="niveau" value="<?php echo $ligne_competence['niveau']; ?>" required>
               </div>
        
               <div class="form-group">
                    <label for="categorie">Catégorie</label>                
                    <select name="categorie" class="form-control">
                        <!-- Développement -->
                        <option value="Développement"
                            <?php // pour ajouter select="selected" à la balise option si c'est la catégorie de la compétence
                                if (!(strcmp("Développement", $ligne_competence['categorie']))) { // strcmp compare les chaînes de caractères
                                    echo "selected=\"selected\"";
                                }
                            ?>>Développement</option>
                        
        
                        <!-- Infographie -->
                        <option value="Infographie"  <?php 
                                if (!(strcmp("Infographie", $ligne_competence['categorie']))) { 
                                    echo "selected=\"selected\"";
                                }
                            ?>>Infographie</option>
        
                        <!-- Gestion de projet -->
                        <option value="Gestion de projet" 
                            <?php 
                                if (!(strcmp("Gestion de projet", $ligne_competence['categorie']))) { 
                                    echo "selected=\"selected\"";
                                }
                            ?>>Gestion de projet</option>                 
                    </select>       
               </div><!-- Fin du menu déroulant pour les catégories -->
        
                <div class="form-group">
                <input class="form-control" type="hidden" name="id_competence" value="<?php echo $ligne_competence['id_competence']; ?>">
                    <button class="btn btn-primary" type="submit">Modifier</button>
                </div>
            </form><!-- fin form -->
        </div>
   

    
<!-- Je inc le footer et les lien JQuery, JS et bootstrap  -->
<?php require 'inc/bas_page.php'; ?>