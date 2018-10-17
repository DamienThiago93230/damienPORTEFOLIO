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

// Gestion mise à jour d'une information
if (isset($_POST['loisir']))
{
    $loisir = addslashes($_POST['loisir']);
    $id_loisir = $_POST['id_loisir'];

    $pdoCV -> exec(" UPDATE t_loisirs SET loisir='$loisir' WHERE id_loisir='$id_loisir' "); 
    header('location: ../admin/loisirs.php');
    exit();
} // Fin if isset $_POST




// Je récupère l'id de ce que je met à jour
$id_loisir = $_GET['id_loisir']; // par son id et avec get
$sql = $pdoCV -> query(" SELECT * FROM t_loisirs WHERE id_loisir='$id_loisir'"); 
$ligne_loisir = $sql -> fetch(); // Va récupérer les donné 

?>

<!-- Je inc le footer et les lien JQuery, JS et bootstrap  -->
<?php require 'inc/haut_page.php'; ?>


<?php require 'inc/navigation.php'; ?>

        <!-- Mise à jour d'un loisir -->
        <h1 class="text-center">Mise à jour d'un loisir</h1>
        <div class="formulaire mx-auto text-center mt-4">
            <form action="modif_loisir.php" method="post">
                <div class="form-group">
                    <label for="loisir">Loisir</label>
                    <input class="form-control" type="text" name="loisir" value="<?php echo $ligne_loisir['loisir']; ?>" required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="hidden" name="id_loisir" value="<?php echo $ligne_loisir['id_loisir']; ?>">
                    <button class="btn btn-primary" type="submit">Mise à jour d'un loisir</button>
                </div>
            </form>
        </div>
    

<!-- Je inc le footer et les lien JQuery, JS et bootstrap  -->
<?php require 'inc/bas_page.php'; ?>