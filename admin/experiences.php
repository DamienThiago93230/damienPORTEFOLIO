<?php require 'connexion.php';

// insertion d'un formulaire
if (isset($_POST['titre_exp'])) { // si on a reçu une nouvelle expation
    if ($_POST['titre_exp'] !='' && $_POST['stitre_exp'] !='' && $_POST['stitre_exp'] !='' && $_POST['dates_exp'] !='' && $_POST['description_exp'] !='' ) {

        $titre_exp = addslashes($_POST['titre_exp']);
        $stitre_exp = addslashes($_POST['stitre_exp']);
        $dates_exp = addslashes($_POST['dates_exp']);
        $description_exp = addslashes($_POST['description_exp']);
        $pdoCV -> exec(" INSERT INTO t_experiences VALUES (NULL, '$titre_exp', '$stitre_exp', '$dates_exp', '$description_exp', '1') ");

        header("location: ../admin/experiences.php");
        exit(); 

    } // ferme le if n'est pas vide
} // fin de isset($_POST['experience'])

// Suppression d'un élément(ici : experience) de la BDD
if (isset($_GET['id_experience'])) // On récupére ce que je supprime dans l'url par son id
{
    $efface = $_GET['id_experience']; // je passe l'id dans une variable $efface
    $sql = " DELETE FROM t_experiences WHERE id_experience='$efface' "; // Requête pur supprimer un élément de la BDD

    $pdoCV -> query($sql); // On peut le faire avec exec() également

    header("location: ../admin/experiences.php");
}// ferme le if isset $_GET pour suppression

?>

<!-- Je inc tous le haut de page le Doctype, les meta et les liens -->
<?php require 'inc/haut_page.php';?> 

<!-- Je inc la bar de navigation -->
<?php require 'inc/navigation.php';?> 


    <h1 class="text-center mb-4 mt-4">Les experiences et insertion d'une nouvelle experience</h1>
        <?php 
            // Requête pour compter et chercher plusieurs enregistrements on ne peut compter qui si on a préparer(avec : prepare) la rrequête
            $sql = $pdoCV -> prepare("SELECT * FROM t_experiences");
            $sql -> execute();
            $nbr_experiences = $sql -> rowCount();
        ?>
    
        <div class="text-center table-responsive table-hover mt-4 ">
            <table class="table table-bordered mb-4 mx-auto">
            <caption>La liste des experiences : <?php echo $nbr_experiences; ?></caption>
                <thead class="thead-dark">
                    <tr>
                        <th>Titre experience</th>
                        <th>Sous titre</th>
                        <th>Date de experience</th>
                        <th>Description experience</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>        
                </thead>
                <?php 
                while($ligne_experience = $sql -> fetch())
                    {
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $ligne_experience['titre_exp']; ?></td>
                        <td><?php echo $ligne_experience['stitre_exp']; ?></td>
                        <td><?php echo $ligne_experience['dates_exp']; ?></td>
                        <td><?php echo $ligne_experience['description_exp']; ?></td>
                        <td>
                            <a class="href" href="modif_experience.php?id_experience=<?php echo $ligne_experience['id_experience']; ?> "><i class="fas fa-edit"></i></a> 
                        </td>
                        <td class="td">
                            <a class="href" href="experiences.php?id_experience=<?php echo $ligne_experience['id_experience']; ?>"><i class="fas fa-trash-alt text-danger"></i></a> 
                        </td>
                    </tr>
                <?php 
                    } 
                ?>
                </tbody>
            </table>
        </div>
        
        <hr>
        <h2 class="text-center mb-4">Formulaire d'insertion d'un formation</h2>
        <!-- Insertion d'un nouveau formation -->
        <div class="formulaire">
            <form action="experiences.php" method="post">
                <div class="form-group">
                    <label for="titre_exp">Titre experience</label>
                    <input type="text" name="titre_exp" placeholder="Nouvelle experience" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="stitre_exp">Experience</label>
                    <input type="text" name="stitre_exp" placeholder="Experience" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="dates_exp">Date experience</label>
                    <input type="text" name="dates_exp" placeholder="Date experience" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description_exp">Description experience</label>
                    <input type="text" name="description_exp" placeholder="Description" class="form-control" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Insérer un experience</button>
                </div>
            </form>
        </div>
<!-- Je inc le footer et les lien JQuery, JS et bootstrap  -->
<?php require 'inc/bas_page.php';?> 
