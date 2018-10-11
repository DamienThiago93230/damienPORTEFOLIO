<?php require 'connexion.php';

// insertion d'un formulaire
if (isset($_POST['titre_exp'])) { // si on a reçu une nouvelle expation
    if ($_POST['titre_exp'] !='' && $_POST['stitre_exp'] !='' && $_POST['stitre_exp'] !='' && $_POST['dates_exp'] !='' && $_POST['description_exp'] !='' ) {

        $titre_exp = addslashes($_POST['titre_exp']);
        $stitre_exp = addslashes($_POST['stitre_exp']);
        $dates_exp = addslashes($_POST['dates_exp']);
        $description_exp = addslashes($_POST['description_exp']);
        $pdoCV -> exec(" INSERT INTO t_formations VALUES (NULL, '$titre_exp', '$stitre_exp', '$dates_exp', '$description_exp', '1') ");

        header("location: ../admin/formations.php");
        exit(); 

    } // ferme le if n'est pas vide
} // fin de isset($_POST['formation'])

// Suppression d'un élément(ici : formation) de la BDD
if (isset($_GET['id_experience'])) // On récupére ce que je supprime dans l'url par son id
{
    $efface = $_GET['id_experience']; // je passe l'id dans une variable $efface
    $sql = " DELETE FROM t_experiences WHERE id_experience='$efface' "; // Requête pur supprimer un élément de la BDD

    $pdoCV -> query($sql); // On peut le faire avec exec() également

    header("location: ../admin/experiences.php");
}// ferme le if isset $_GET pour suppression

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Lien bootstrap CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Lien fontawasome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Admin : les formations</title>
</head>
<body>
<?php require 'inc/navigation.php';?> 

<div class="container-fluid">
    <h1>Les informations et insertion d'une nouvelle experience</h1>
        <?php 
            // Requête pour compter et chercher plusieurs enregistrements on ne peut compter qui si on a préparer(avec : prepare) la rrequête
            $sql = $pdoCV -> prepare("SELECT * FROM t_experiences");
            $sql -> execute();
            $nbr_experiences = $sql -> rowCount();
        ?>
    
        <div>
            <table class="table-bordered table">
            <caption>La liste des experiences : <?php echo $nbr_experiences; ?></caption>
                <thead>
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
                        <td class="td"><?php echo $ligne_experience['titre_form']; ?></td>
                        <td class="td"><?php echo $ligne_experience['stitre_form']; ?></td>
                        <td class="td"><?php echo $ligne_experience['dates_form']; ?></td>
                        <td class="td"><?php echo $ligne_experience['description_form']; ?></td>
                        <td>
                            <a class="href" href="modif_experience.php?id_experience=<?php echo $ligne_experience['id_experience']; ?> ">Modifier</a> 
                        </td>
                        <td class="td">
                            <a class="href" href="experiences.php?id_experience=<?php echo $ligne_experience['id_experience']; ?>">Supprimer</a> 
                        </td>
                    </tr>
                <?php 
                    } 
                ?>
                </tbody>
            </table>
        </div>
        
        <hr>
        <h2>Formulaire d'insertion d'un formation</h2>
        <!-- Insertion d'un nouveau formation -->
        <div class="formulaire">
            <form action="experiences.php" method="post">
                <div class="form-group">
                    <label for="titre_exp">Titre experience</label>
                    <input type="text" name="titre_exp" placeholder="Nouvelle formation" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="stitre_exp">experience</label>
                    <input type="text" name="stitre_exp" placeholder="Nouvelle formation" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="dates_exp">Date de formation</label>
                    <input type="text" name="dates_exp" placeholder="Date de formation" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description_exp">Description formation</label>
                    <input type="text" name="description_exp" placeholder="Description" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="id_utilisateur">Id utilisateur</label>
                    <input type="text" name="id_utilisateur" placeholder="id utilisateur" class="form-control" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Insérer un formation</button>
                </div>
            </form>
        </div>
</div>
<!-- lien bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>