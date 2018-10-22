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


// Insertion d'un loisir en BDD
if (isset($_POST['loisir']) && $_POST['loisir'] != '') // Si on à reçu un nouveau loisir
{
    $loisir = addslashes ($_POST['loisir']);
    $pdoCV -> exec(" INSERT INTO t_loisirs VALUES (NULL, '$loisir', '$id_utilisateur')");

    header("location: ../admin/loisirs.php");
     
    exit();     
}// ferme le if isset $_POST

// Suppression d'un élément(ici : loisir) de la BDD
if (isset($_GET['id_loisir'])) // On récupére ce que je supprime dans l'url par son id
{
    $efface = $_GET['id_loisir']; // je passe l'id dans une variable $efface
    $sql = " DELETE FROM t_loisirs WHERE id_loisir='$efface' "; // Requête pur supprimer un élément de la BDD

    $pdoCV -> query($sql); // On peut le faire avec exec() également

    header("location: ../admin/loisirs.php");
}// ferme le if isset $_GET pour suppression

?>
<!-- Je inc le footer et les lien JQuery, JS et bootstrap  -->
<?php require 'inc/haut_page.php'; ?>


<?php require 'inc/navigation.php';?> 

    <div class="jumbotron text-center mb-4">
        <h1 class="display-4">Admin : <?php echo $ligne_utilisateur['pseudo']; ?></h1>
        <p class="lead">Vous etes sur la page loisirs.</p>
        <hr class="my-4">
        <p>Découvrez mes passions .</p>
    </div>


    <div class="text-center table-responsive table-hover mt-4 ">
        <h1 class="text-center mb-4">Mes loisirs</h1>
            <?php 
                // Requête pour compter et chercher plusieurs enregistrements on ne peut compter qui si on a préparer(avec : prepare) la rrequête
                $sql = $pdoCV -> prepare("SELECT * FROM t_loisirs WHERE id_utilisateur ='$id_utilisateur'");
                $sql -> execute();
                $nbr_loisirs = $sql -> rowCount();
            ?>
        
            
            <div class="row taille">
                <div class="col-lg-4">
                    <table class="table table-bordered l">
                    <caption>La liste des loisirs : <?php echo $nbr_loisirs; ?></caption>
                        <thead class="thead-dark">
                            <tr>
                                <th>Loisirs</th>
                            </tr>        
                        </thead>
                        <?php 
                        while($ligne_loisir = $sql -> fetch())
                            {
                        ?>
                        <tbody>
                            <tr>
                                <td class="td"><?php echo $ligne_loisir['loisir']; ?></td>
                            </tr>
                        <?php 
                            } 
                        ?>
                        </tbody>
                    </table>
                </div><!-- fin col-lg-4 -->
                <div class="col-lg-8">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="w-100" src="img/psg.jpg" alt="Football">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="img/ufc.png" alt="UFC">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="img/cross1.jpg" alt="Cross">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="img/cross1.jpg" alt="Boxe">
                            </div>
                        </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div> 
                </div><!-- fin col-lg-8 -->
            </div><!-- fin row -->

<!-- Je inc le footer et les lien JQuery, JS et bootstrap  -->
<?php require 'inc/bas_page.php'; ?>