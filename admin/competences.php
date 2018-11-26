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
// Pour vider les variables de session destroy !
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
$sql = $pdoCV -> query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur = '$id_utilisateur'"); 
$ligne_utilisateur = $sql-> fetch();


// Insertion d'un élément en BDD
if (isset($_POST['competence']) && $_POST['niveau'] != '' && $_POST['categorie'] != '') // Si on à reçu une nouvelle compétence
{
    $competence = addslashes ($_POST['competence']);
    $niveau = addslashes ($_POST['niveau']);
    $categorie = addslashes ($_POST['categorie']);

    $pdoCV -> exec(" INSERT INTO t_competences VALUES (NULL, '$competence', '$niveau', '$categorie', '$id_utilisateur')");

    header("location: ../admin/competences.php");
     
    exit();     
}// ferme le if isset $_POST
//******************************/

// Suppression d'un élément(ici : competence) de la BDD
if (isset($_GET['id_competence'])) // On récupére ce que je supprime dans l'url par son id
{
    $efface = $_GET['id_competence']; // je passe l'id dans une variable $efface
    $sql = " DELETE FROM t_competences WHERE id_competence='$efface' "; // Requête pur supprimer un élément de la BDD

    $pdoCV -> query($sql); // On peut le faire avec exec() également

    header("location: ../admin/competences.php");
}// ferme le if isset $_GET pour suppression


$order = '';
if(isset($_GET['order']) && isset($_GET['column'])){

	if($_GET['column'] == 'competence'){
		$order = ' ORDER BY competence';
	}
	elseif($_GET['column'] = 'niveau'){
		$order = ' ORDER BY niveau';
	}
	elseif($_GET['column'] == 'categorie'){     
		$order = ' ORDER BY categorie';
	}
	if($_GET['order'] == 'asc'){      
		$order.= ' ASC';
	}
	elseif($_GET['order'] == 'desc'){
		$order.= ' DESC';
	}
}

?>

<!-- Je inc tous le haut de page le Doctype, les meta et les liens -->
<?php require 'inc/haut_page.php'; ?>

<!-- Je inc la bar de navigation -->
<?php require 'inc/navigation.php';?> 

    <div class="jumbotron text-center mb-4">
        <h1>Vous êtes sur la page des compétences </h1>
    </div>

    <h1 class="text-center mb-4 mt-4">Gestion des compétences</h1>
    
        <?php 
            // Requête pour compter et chercher plusieurs enregistrements on ne peut compter qui si on a préparer(avec : prepare) la rrequête
            $sql = $pdoCV -> prepare("SELECT * FROM t_competences WHERE id_utilisateur = '$id_utilisateur' $order" );
            $sql -> execute();
            $nbr_competence = $sql -> rowCount();
        ?>
    
       
    <table class="table table-bordered table-hover text-center mx-auto">
            <caption>La liste des compétences : <?php echo $nbr_competence; ?></caption>
            <thead class="thead-dark">
                <tr class="text-center">
                    <th style="color: wheat">Compétences trier de : <a href="competences.php?column=competence&order=asc" class="href"><i class="fas fa-sort-alpha-up"></i>
                    </a> | <a href="competences.php?column=competence&order=desc" class="href"><i class="fas fa-sort-alpha-down"></i></a> </th> 
                    <th style="color: wheat">Niveaux trier de : <a href="competences.php?column=niveau&order=asc" class="href">0 à 100</a> | <a href="competences.php?column=niveau&order=desc" class="href"> 100 à 0</a></th> 
                    <th style="color: wheat">Catégories trier de : <a href="competences.php?column=categorie&order=asc" class="href"><i class="fas fa-sort-alpha-up"></i></a> | <a href="competences.php?column=categorie&order=desc" class="href"><i class="fas fa-sort-alpha-down"></i></a></th> 
                    <th style="color: wheat">Modifier </th> 
                    <th style="color: wheat">Supprimer </th> 
                </tr>        
            </thead>
            <?php 
            while($ligne_competence = $sql -> fetch())
                {
            ?>
            <tbody>
                <tr>
                    <td><?php echo $ligne_competence['competence']; ?></td>
                    <td><?php echo $ligne_competence['niveau']; ?>/100</td>
                    <td><?php echo $ligne_competence['categorie']; ?></td>
                    <td>
                        <a href="modif_competence.php?id_competence=<?php echo $ligne_competence['id_competence']; ?>" onclick="return(confirm('Etes-vous certain de vouloir modifier cette compétence ?'))"><i class="fas fa-edit"></i></a> 
                    </td>
                    <td class="td">
                        <a href="competences.php?id_competence=<?php echo $ligne_competence['id_competence']; ?>" onclick="return(confirm('Etes-vous certain de vouloir supprimer cette compétence ?'))"><i class="fas fa-trash-alt text-danger"></i></a> 
                    </td>
                </tr>
            <?php 
                } // Fin du while 
            ?>
            </tbody>
        </table>        
        
        <hr>
        <!-- Insertion d'un nouveau compétence -->
        <div class="row">  
            <div class="formulaire col-sm-12 col-lg-6 text-center mx-auto">
                <h1 class="text-center" style="color: black; text-shadow: wheat 2px -1px;font-size: 35px;" >Formulaire d'insertion</h2>    
                <form action="competences.php" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="competence">Compétence</label>
                            <input type="text" name="competence" placeholder="Nouvelle compétence" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="niveau">Niveau</label>
                            <input type="text" name="niveau" placeholder="Niveau en chiffre sur 100" class="form-control"  required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="categorie">Catégorie</label>
                            <select name="categorie" id="categorie" class="form-control">
                                <option value="Développement">Développement</option>
                                <option value="Infographie">Infographie</option>
                                <option value="Gestion de projet">Gestion de projet</option>
                            </select>
                        </div>
                        
                        <div class="form-group mx-auto">
                            <button type="submit" class="btn btn-primary form-control">Insérer la compétence</button>
                        </div>
                    </div><!-- Fin .form-row -->
                </form>
            </div><!-- Fin .formulaire -->
    </div><!-- Fin .row -->

<!-- Je inc le footer et les lien JQuery, JS et bootstrap  -->
<?php require 'inc/bas_page.php'; ?>