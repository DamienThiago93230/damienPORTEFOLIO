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
        <h1 class="display-4">Vous êtes sur la page des loisirs</h1>
    </div>


    <div class="text-center table-responsive table-hover mt-4">
        <h1 class="text-center mb-4">Gestion des loisirs</h1>
            <?php 
                // Requête pour compter et chercher plusieurs enregistrements on ne peut compter qui si on a préparer(avec : prepare) la rrequête
                $sql = $pdoCV -> prepare("SELECT * FROM t_loisirs WHERE id_utilisateur ='$id_utilisateur'");
                $sql -> execute();
                $nbr_loisirs = $sql -> rowCount();
            ?>
        
            
            <table class="table table-bordered mx-auto">
            <caption>La liste des loisirs : <?php echo $nbr_loisirs; ?></caption>
                <thead class="thead-dark">
                    <tr>
                        <th style="color: wheat">Loisirs</th>
                        <th style="color: wheat">Modifier</th>
                        <th style="color: wheat">Supprimer</th>
                    </tr>        
                </thead>
                <?php 
                while($ligne_loisir = $sql -> fetch())
                    {
                ?>
                <tbody>
                    <tr>
                        <td class="td"><?php echo $ligne_loisir['loisir']; ?></td>
                        <td>
                            <a class="href" href="modif_loisir.php?id_loisir=<?php echo $ligne_loisir['id_loisir']; ?>" onclick="return(confirm('Etes-vous certain de vouloir modifier ce loisir ?'))"><i class="fas fa-edit"></i></a> 
                        </td>
                        <td class="td">
                            <a class="href" href="loisirs.php?id_loisir=<?php echo $ligne_loisir['id_loisir']; ?>" onclick="return(confirm('Etes-vous certain de vouloir supprimer ce loisir ?'))"><i class="fas fa-trash-alt text-danger"></i></a> 
                        </td>
                    </tr>
                <?php 
                    } 
                ?>
                </tbody>
            </table>
            
            <hr>
            <!-- Insertion d'un nouveau loisir -->
            <div class="formulaire mx-auto">
            <h2 class="text-center" style="color: black">Formulaire d'insertion</h2>
            
                <form action="loisirs.php" method="post">
                    <div class="form-group">
                        <label for="loisir">Loisir</label>
                        <input type="text" name="loisir" placeholder="Nouveau loisir" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" >Insérer le loisir</button>
                    </div>
                </form>
            </div>

    </div> 

<!-- Je inc le footer et les lien JQuery, JS et bootstrap  -->
<?php require 'inc/bas_page.php'; ?>