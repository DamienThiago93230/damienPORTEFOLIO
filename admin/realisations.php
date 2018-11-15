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

// Récupère les données de l'utilisateur par son id
$sql = $pdoCV -> query(" SELECT * FROM t_utilisateurs where id_utilisateur = '$id_utilisateur'"); 
$ligne_utilisateur = $sql-> fetch();


// insertion d'une réalisation
if(isset($_POST['titre_real'])){// si on a reçu un nouveau competence

    if($_POST['titre_real'] !="" && $_POST['stitre_real'] != "" && $_POST['dates_real'] != ""){

        $titre_real = addslashes($_POST['titre_real']);
        $stitre_real = addslashes($_POST['stitre_real']);
        $dates_real = addslashes($_POST['dates_real']);
        $description_real = addslashes($_POST['description_real']);
        $pdoCV -> exec("INSERT INTO t_realisations VALUES (NULL, '$titre_real', '$stitre_real', '$dates_real', '$description_real', '$id_utilisateur')");

        header("location: ../admin/realisations.php");
        exit();

    } // fin if !=""

}// fin $_POST reception
// ----------------------------------

// codes pour filtrer les données du tableau (croissant / décroissant)

$order = '';
if(isset($_GET['order']) && isset($_GET['column'])){

	if($_GET['column'] == 'titre_real'){$order = ' ORDER BY titre_real';}
	elseif($_GET['column'] == 'stitre_real'){$order = ' ORDER BY stitre_real';}
	elseif($_GET['column'] == 'dates_real'){$order = ' ORDER BY dates_real';}
	elseif($_GET['column'] == 'description_real'){$order = ' ORDER BY dates_real';}
	if($_GET['order'] == 'asc'){$order.= ' ASC';}
	elseif($_GET['order'] == 'desc'){$order.= ' DESC';}
}


// Suppression d'une formation dans la BDD
if(isset($_GET['id_realisation'])){// on récupère ce que je supprime dans l'url par son id

    $efface = $_GET['id_realisation'];  // je passe l'id dans une variable $efface

    $sql = "DELETE FROM t_realisations WHERE id_realisation = '$efface' "; // delete de la base 
    $pdoCV -> query($sql); // on peut faire aussi avec exec

    header("location: ../admin/realisations.php");
    
}


require_once 'inc/haut_page.php';
require_once 'inc/navigation.php';
?>



<?php
// requête pour compter et cherhcer plusieurs enregistrements
$sql = $pdoCV -> prepare("SELECT * FROM t_realisations WHERE id_utilisateur = '$id_utilisateur' $order");
$sql -> execute();
$nbr_realisations = $sql -> rowCount(); ?>

    <div class="jumbotron text-center mb-4">
        <h1 class="display-4">Vous êtes sur la page des réalisations</h1>
    </div>

    <!-- div pour le tableau -->
    <div class="text-center table-responsive table-hover mt-4 ">

        <h1 class="mb-4">Gestion des réalisations</h1>

        <table class="table table-bordered mb-4 mx-auto">
        <caption>La liste des réalisations : <?php echo $nbr_realisations; ?></caption>
            <thead class="thead-dark">
                <tr>
                    <th style="color: wheat">Titre réalisations <a href="realisations.php?column=titre_real&order=asc"><i class="fas fa-arrow-up"></i></a> | <a href="realisations.php?column=titre_real&order=desc"><i class="fas fa-arrow-down"></i></a> </th>
                    <th style="color: wheat">Sous-titre <a href="realisations.php?column=stitre_real&order=asc"><i class="fas fa-arrow-up"></i></a> | <a href="realisations.php?column=stitre_real&order=desc"><i class="fas fa-arrow-down"></i></a> </th>
                    <th style="color: wheat">Dates <a href="realisations.php?column=dates_real&order=asc"><i class="fas fa-arrow-up"></i></a> | <a href="realisations.php?column=dates_real&order=desc"><i class="fas fa-arrow-down"></i></a> </th>
                    <th style="color: wheat">Descriptions <a href="realisations.php?column=description_real&order=asc"><i class="fas fa-arrow-up"></i></a> | <a href="realisations.php?column=description_real&order=desc"><i class="fas fa-arrow-down"></i></a> </th>
                    <th style="color: wheat">Modification</th>
                    <th style="color: wheat">Suppression</th>
                </tr>
            </thead>
            <tbody>
            <?php while($ligne_realisation = $sql -> fetch()) {
            ?>
                <tr>
                    <td><?= $ligne_realisation['titre_real']; ?></td>
                    <td><?= $ligne_realisation['stitre_real']; ?></td>
                    <td><?= $ligne_realisation['dates_real']; ?></td>
                    <td><?= $ligne_realisation['description_real']; ?></td>
                    <td> <a href="modif_realisation.php?id_realisation=<?= $ligne_realisation['id_realisation'];?>" onclick="return(confirm('Etes-vous certain de vouloir modifier cette réalisation ?'))"><i class="fas fa-edit"></i></a></td>
                    <td> <a href="realisations.php?id_realisation=<?= $ligne_realisation['id_realisation'];?>" onclick="return(confirm('Etes-vous certain de vouloir supprimer cette réalisiation ?'))"><i class="fas fa-trash-alt text-danger"></i></a></td>
                </tr>
                
            <?php 
                } // Fin de la boucle while
            ?>
            </tbody>
        </table>
        <hr>
        
    </div> <!-- Fin div tableau -->
    
    <!-- Formulaire insertion d'une nouvelle realisation -->
    <div class="row">
        <div class="formulaire text-center mx-auto col-sm-12 col-lg-6">
            <h2 class="text-center" style="color: black; text-shadow: wheat 2px -1px;font-size: 35px;">Formulaire d'insertion</h2>
            
            <form action="realisations.php" method="post" class="px-4 py-3">
                
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="titre_real">Titre </label>
                        <input type="text" class="form-control" name="titre_real" placeholder="Développeur Intégrateur Web" required>
                    </div>
                
                    <div class="form-group col-md-4">
                        <label for="stitre_real">Sous-titre </label>
                        <input type="text" class="form-control" name="stitre_real" placeholder="ThiagoKaylie.co Paris" required>
                    </div>
        
                    <div class="form-group col-md-4">
                        <label for="dates_real">Dates </label>
                        <input type="text" class="form-control" name="dates_real" placeholder="01/2017 à 11/2017" required>
                    </div>        
                    
        
                    <div class="form-group col-md-12">
                        <label for="description_real" class="d-block">Description </label>
                        <textarea type="text" name="description_real" id="description_real" class="form-control"></textarea>
                        <script>
                            // Replace the <textarea id="description_form"> with a CKEditor
                            // instance, using default configuration.
                            CKEDITOR.replace( 'description_real' );
                        </script>
                    </div>
                
                    <div class="form-group mx-auto">
                        <button type="submit" class="btn btn-primary">Insérer la réalisation</button>
                    </div>
                </div><!-- Fin .form-row -->
            
            </form>
        </div><!-- Fin .formulaire -->
    </div><!-- Fin .row -->
    
<?php
require_once 'inc/bas_page.php';