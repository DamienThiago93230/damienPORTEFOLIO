<?php require 'connexion.php';

// Insertion d'un loisir en BDD
if (isset($_POST['loisir']) && $_POST['loisir'] != '') // Si on à reçu un nouveau loisir
{
    $loisir = addslashes ($_POST['loisir']);
    $pdoCV -> exec(" INSERT INTO t_loisirs VALUES (NULL, '$loisir', '1')");

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
    <title>Admin : les loisirs</title>
</head>
<body>
<?php require 'inc/navigation.php';?> 

<div class="container-fluid">
    <h1>Les loisirs et insertion d'un nouveau loisir</h1>
        <?php 
            // Requête pour compter et chercher plusieurs enregistrements on ne peut compter qui si on a préparer(avec : prepare) la rrequête
            $sql = $pdoCV -> prepare("SELECT * FROM t_loisirs");
            $sql -> execute();
            $nbr_loisirs = $sql -> rowCount();
        ?>
    
        <div>
            <table class="table-bordered table">
            <caption>La liste des loisirs : <?php echo $nbr_loisirs; ?></caption>
                <thead>
                    <tr>
                        <th>Loisirs</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
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
                            <a class="href" href="modif_loisir.php?id_loisir=<?php echo $ligne_loisir['id_loisir']; ?> ">Modifier</a> 
                        </td>
                        <td class="td">
                            <a class="href" href="loisirs.php?id_loisir=<?php echo $ligne_loisir['id_loisir']; ?>">Supprimer</a> 
                        </td>
                    </tr>
                <?php 
                    } 
                ?>
                </tbody>
            </table>
        </div>
        <hr>
        <h2>Formulaire d'insertion d'un loisir</h2>
        <!-- Insertion d'un nouveau loisir -->
        <div class="formulaire">
            <form action="loisirs.php" method="post">
                <div class="form-group">
                    <label for="loisir">Loisir</label>
                    <input type="text" name="loisir" placeholder="Nouveau loisir" class="form-control" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Insérer un loisir</button>
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