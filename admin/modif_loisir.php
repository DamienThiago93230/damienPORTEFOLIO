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
    <title>Admin : mise à jour loisir</title>
</head>
<body>
<?php require 'inc/navigation.php'; ?>
        <!-- Mise à jour d'un loisir -->
        <div class="formulaire">
            <form action="modif_loisir.php" method="post">
                <div class="form-group">
                    <label for="loisir"><h1>Modifier loisir</h1></label>
                    <input class="form-control" type="text" name="loisir" value="<?php echo $ligne_loisir['loisir']; ?>" required>
                </div>
                <div class="form-group">
                    <input class="form-control" type="hidden" name="id_loisir" value="<?php echo $ligne_loisir['id_loisir']; ?>">
                    <button class="btn btn-primary" type="submit">Mise à jour d'un loisir</button>
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