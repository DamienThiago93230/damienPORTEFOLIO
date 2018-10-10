<?php require 'connexion.php'; 
// Gestion mise à jour d'une formation
if (isset($_POST['formation'])) { // si on a reçu une nouvelle formation

        $titre_form = addslashes($_POST['titre_form']);
        $stitre_form = addslashes($_POST['stitre_form']);
        $dates_form = addslashes($_POST['dates_form']);
        $description_form = addslashes($_POST['description_form']);

        $id_formation = $_POST['id_formation'];

        $pdoCV -> exec(" UPDATE t_formations SET titre_form='$titre_form', stitre_form='$stitre_form', dates_form='$dates_form', description_form='$description_form' WHERE id_formation='$id_formation' ");
        header("location: ../admin/formations.php");
        exit();     
} 

// Je récupère l'id de ce que je met à jour
$id_formation = $_GET['id_formation']; // par son id et avec get
$sql = $pdoCV -> query(" SELECT * FROM t_formations WHERE id_formation='$id_formation'"); 
$ligne_formation = $sql -> fetch(); // Va récupérer les donné 

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
                <label for="titre_form">Titre formation</label>
                <input type="text" name="titre_form" placeholder="Nouvelle formation" class="form-control" value="<?php echo $ligne_formation['titre_form'] ?>" required>
            </div>
            <div class="form-group">
                <label for="stitre_form">formation</label>
                <input type="text" name="stitre_form" placeholder="Nouvelle formation" class="form-control" value="<?php echo $ligne_formation['stitre_form'] ?>" required>
            </div>
            <div class="form-group">
                <label for="dates_form">Date de formation</label>
                <input type="text" name="dates_form" placeholder="Date de formation" class="form-control" value="<?php echo $ligne_formation['dates_form'] ?>" required>
            </div>
            <div class="form-group">
                <label for="description_form">Description formation</label>
                <input type="text" name="description_form" placeholder="Description" class="form-control" value="<?php echo $ligne_formation['description_form'] ?>" required>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Insérer un formation</button>
            </div>
        </form>
    </div>
    <!-- lien bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>