<?php require 'connexion.php'; 
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
        <div class="formulaire mt-4">
            <form action="modif_loisir.php" method="post">
                <div class="form-group">
                    <label for="loisir"><h1 class="text-center mb-4">Modifier loisir</h1></label>
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