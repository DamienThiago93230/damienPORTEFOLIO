<?php require 'connexion.php'; 
// Gestion mise à jour d'une formation
if (isset($_POST['titre_exp'])) { // si on a reçu une nouvelle expation

    $titre_exp = addslashes($_POST['titre_exp']);
    $stitre_exp = addslashes($_POST['stitre_exp']);
    $dates_exp = addslashes($_POST['dates_exp']);
    $description_exp = addslashes($_POST['description_exp']);

    $id_experience = $_POST['id_experience'];

    $pdoCV -> exec(" UPDATE t_experiences SET titre_form='$titre_exp', stitre_exp='$stitre_exp', dates_exp='$dates_exp', description_exp='$description_exp' WHERE id_experience='$id_experience'");
    header("location: ../admin/experiences.php");
    exit();     
} 

// Je récupère l'id de ce que je met à jour
$id_experience = $_GET['id_experience']; // par son id et avec get
$sql = $pdoCV -> query(" SELECT * FROM t_experiences WHERE id_experience='$id_experience'"); 
$ligne_experience = $sql -> fetch(); // Va récupérer les donné 

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
    <title>Modif formation</title>
</head>
<body>
<?php require 'inc/navigation.php'; ?>

    <!-- Modificationd'une formation -->
    <div class="formulaire">
        <h1>Modification d'une formation</h1>
        <form action="formations.php" method="post">
            <div class="form-group">
                <label for="titre_exp">Titre experience</label>
                <input type="text" name="titre_exp" placeholder="Titre experience" class="form-control" value="<?php echo $ligne_experience['titre_exp']; ?>" required>
            </div>
            <div class="form-group">
                <label for="stitre_exp">Experience</label>
                <input type="text" name="stitre_exp" placeholder="Infos experience" class="form-control" value="<?php echo $ligne_expation['stitre_exp']; ?>" required>
            </div>
            <div class="form-group">
                <label for="dates_exp">Date experience</label>
                <input type="text" name="dates_exp" placeholder="Date experience" class="form-control" value="<?php echo $ligne_formation['dates_exp']; ?>" required>
            </div>
            <div class="form-group">
                <label for="description_exp">Description experience</label>
                <input type="text" name="description_exp" placeholder="Description" class="form-control" value="<?php echo $ligne_formation['description_exp']; ?>" required>
            </div>
            
            <div class="form-group">
                <input class="form-control" type="hidden" name="id_experience" value="<?php echo $ligne_experience['id_experience']; ?>">
                <button type="submit" class="btn btn-primary">Modifier une formation</button>
            </div>
        </form>
    </div>
    <!-- lien bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>