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


// insertion d'un competence
if(isset($_POST['titre_form'])){// si on a reçu un nouveau competence

    if($_POST['titre_form'] !="" && $_POST['stitre_form'] != "" && $_POST['dates_form'] != ""){

        $titre_form = addslashes($_POST['titre_form']);
        $stitre_form = addslashes($_POST['stitre_form']);
        $dates_form = addslashes($_POST['dates_form']);
        $description_form = addslashes($_POST['description_form']);
        $pdoCV -> exec("INSERT INTO t_formations VALUES (NULL, '$titre_form', '$stitre_form', '$dates_form', '$description_form', '$id_utilisateur')");

        header("location: ../admin/formations.php");
        exit();

    } // fin if !=""

}// fin $_POST reception
// ----------------------------------

// codes pour filtrer les données du tableau (croissant / décroissant)

$order = '';
if(isset($_GET['order']) && isset($_GET['column'])){

	if($_GET['column'] == 'titre_form'){$order = ' ORDER BY titre_form';}
	elseif($_GET['column'] == 'stitre_form'){$order = ' ORDER BY stitre_form';}
	elseif($_GET['column'] == 'dates_form'){$order = ' ORDER BY dates_form';}
	elseif($_GET['column'] == 'description_form'){$order = ' ORDER BY dates_form';}
	if($_GET['order'] == 'asc'){$order.= ' ASC';}
	elseif($_GET['order'] == 'desc'){$order.= ' DESC';}
}


// Suppression d'une formation dans la BDD
if(isset($_GET['id_formation'])){// on récupère ce que je supprime dans l'url par son id

    $efface = $_GET['id_formation'];  // je passe l'id dans une variable $efface

    $sql = "DELETE FROM t_formations WHERE id_formation = '$efface' "; // delete de la base 
    $pdoCV -> query($sql); // on peut faire aussi avec exec

    header("location: ../admin/formations.php");
    
}


require_once 'inc/haut_page.php';
require_once 'inc/navigation.php';
?>



<?php
// requête pour compter et cherhcer plusieurs enregistrements
$sql = $pdoCV -> prepare("SELECT * FROM t_formations WHERE id_utilisateur = '$id_utilisateur' $order");
$sql -> execute();
$nbr_formations = $sql -> rowCount(); ?>

    <div class="jumbotron text-center mb-4">
        <h1 class="display-4">Admin : <?php echo $ligne_utilisateur['pseudo']; ?></h1>
        <p class="lead">Vous etes sur la page formations.</p>
        <hr class="my-4">
        <p>Découvrez mes formations.</p>
    </div>

    <!-- div pour le tableau -->
    <div class="text-center table-responsive table-hover mt-4 ">

        <h1 class="mb-4">Mes formations</h1>

        <table class="table table-bordered mb-4 mx-auto">
        <caption>La liste des formations : <?php echo $nbr_formations; ?></caption>
            <thead class="thead-dark">
                <tr>
                    <th>Titre Formations <a href="formations.php?column=titre_form&order=asc"><i class="fas fa-arrow-up"></i></a> | <a href="formations.php?column=titre_form&order=desc"><i class="fas fa-arrow-down"></i></a> </th>
                    <th>Sous-titre <a href="formations.php?column=stitre_form&order=asc"><i class="fas fa-arrow-up"></i></a> | <a href="formations.php?column=stitre_form&order=desc"><i class="fas fa-arrow-down"></i></a> </th>
                    <th>Dates <a href="formations.php?column=dates_form&order=asc"><i class="fas fa-arrow-up"></i></a> | <a href="formations.php?column=dates_form&order=desc"><i class="fas fa-arrow-down"></i></a> </th>
                    <th>Descriptions <a href="formations.php?column=description_form&order=asc"><i class="fas fa-arrow-up"></i></a> | <a href="formations.php?column=description_form&order=desc"><i class="fas fa-arrow-down"></i></a> </th>
                    <th>Modification</th>
                    <th>Suppression</th>
                </tr>
            </thead>
            <tbody>
            <?php while($ligne_formation = $sql -> fetch()) {
            ?>
                <tr>
                    <td><?= $ligne_formation['titre_form']; ?></td>
                    <td><?= $ligne_formation['stitre_form']; ?></td>
                    <td><?= $ligne_formation['dates_form']; ?></td>
                    <td><?= $ligne_formation['description_form']; ?></td>
                    <td> <a href="modif_formation.php?id_formation=<?= $ligne_formation['id_formation'];?>"><i class="fas fa-edit"></i></a></td>
                    <td> <a href="formations.php?id_formation=<?= $ligne_formation['id_formation'];?>"><i class="fas fa-trash-alt text-danger"></i></a></td>
                </tr>
                
            <?php 
                } // Fin de la boucle while
            ?>
            </tbody>
        </table>
        <hr>
        
    </div> <!-- Fin div tableau -->
    
    <!-- Formulaire insertion d'une nouvelle formation -->
    
        <div class="formulaire text-center mx-auto">
            <h2 class="text-center">Formulaire d'insertion d'une formation</h2>
            
            <form action="formations.php" method="post" class="px-4 py-3">
                
                <div class="form-group">
                    <label for="titre_form">Titre </label>
                    <input type="text" class="form-control" name="titre_form" placeholder="Développeur Intégrateur Web" required>
                </div>
            
                <div class="form-group">
                    <label for="stitre_form">Sous-titre </label>
                    <input type="text" class="form-control" name="stitre_form" placeholder="ThiagoKaylie.co Paris" required>
                </div>
    
                <div class="form-group">
                    <label for="dates_form">Dates </label>
                    <input type="text" class="form-control" name="dates_form" placeholder="01/2017 à 11/2017" required>
                </div>        
                
    
                <div class="form-group">
                    <label for="description_form" class="d-block">Description </label>
                    <textarea type="text" name="description_form" id="description_form" class="form-control"></textarea>
                    <script>
                        // Replace the <textarea id="description_form"> with a CKEditor
                        // instance, using default configuration.
                        CKEDITOR.replace( 'description_form' );
                    </script>
                </div>
            
                <div>
                    <button type="submit" class="btn btn-primary">Insérer la formation</button>
                </div>
            
            </form>
        </div>
    
<?php
require_once 'inc/bas_page.php';