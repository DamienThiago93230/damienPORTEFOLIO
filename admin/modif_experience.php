<?php require 'connexion.php'; 

// gestion mise à jour d'une information
if (isset($_POST['titre_exp'])) { 

    $titre_exp = addslashes($_POST['titre_exp']);
    $stitre_exp = addslashes($_POST['stitre_exp']);
    $dates_exp = addslashes($_POST['dates_exp']);
    $description_exp = addslashes($_POST['description_exp']);

    $id_experience = $_POST['id_experience'];

    $pdoCV -> exec(" UPDATE t_experiences SET titre_exp = '$titre_exp', stitre_exp='$stitre_exp', dates_exp = '$dates_exp', description_exp = '$description_exp' WHERE id_experience = '$id_experience' ");
    header('location: ../admin/experiences.php');
    exit();
} // fin du (isset($_POST['experience']))




// je récupère l'id de ce que je mets à jour
$id_experience = $_GET['id_experience']; // par son id et avec GET 
$sql = $pdoCV -> query (" SELECT * FROM t_experiences WHERE id_experience='$id_experience' ");
$ligne_experience = $sql -> fetch(); // va récupérer les données 

?>
<?php require 'inc/haut_page.php'; ?>

<!-- Ici, j'inclus ma page navigation.php -->
<?php require 'inc/navigation.php'; ?>

    <h1 class="text-center mb-4">Mise à jour d'une expérience</h1>
    <!-- Mise à jour d'une nouvelle compétence formulaire  -->
    <div class="formulaire">
        <div class="form-group"><!-- Début .form-group -->
            <form action="modif_experience.php" method="post">
               <div class="form-group">
                    <label for="titre_exp">Titre de l'expérience </label>                
                    <input type="text" class="form-control" name="titre_exp" value="<?php echo $ligne_experience['titre_exp']; ?>" required>    
               </div>
        
               <div class="form-group">
                    <label for="stitre_exp">Sous titre de l'expérience</label>                
                    <input type="text" class="form-control" name="stitre_exp" value="<?php echo $ligne_experience['stitre_exp']; ?>" required>
               </div>
        
               <div class="form-group">
                    <label for="dates_exp">Date de la expérience</label>                
                    <input type="text" class="form-control" name="dates_exp" value="<?php echo $ligne_experience['dates_exp']; ?>" required>
               </div>
    
               <div class="form-group">
                    <label for="description_exp">Description de l'expérience</label>                
                    <input class="form-control" name="description_exp" value="<?php echo $ligne_experience['description_exp']; ?>"></textarea>
               </div>
        
                <div class="form-group">
                    <button class="btn btn-danger" type="submit">MAJ</button>
                    <input type="hidden" name="id_experience" value="<?php echo $ligne_experience['id_experience']; ?>">
                </div>
            </form><!-- fin form -->
        </div><!-- Fin .form-group -->
    </div>

<?php require 'inc/bas_page.php'; ?>