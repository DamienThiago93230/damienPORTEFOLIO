<?php require 'connexion.php';

// insertion d'un formulaire
if (isset($_POST['titre_form'])) { // si on a reçu une nouvelle formation
    if ($_POST['titre_form'] !='' && $_POST['stitre_form'] !='' && $_POST['stitre_form'] !='' && $_POST['dates_form'] !='' && $_POST['description_form'] !='' ) {

        $titre_form = addslashes($_POST['titre_form']);
        $stitre_form = addslashes($_POST['stitre_form']);
        $dates_form = addslashes($_POST['dates_form']);
        $description_form = addslashes($_POST['description_form']);
        $pdoCV -> exec(" INSERT INTO t_formations VALUES (NULL, '$titre_form', '$stitre_form', '$dates_form', '$description_form', '1') ");

        header("location: ../admin/formations.php");
        exit(); 

    } // ferme le if n'est pas vide
} // fin de isset($_POST['formation'])

// Suppression d'un élément(ici : formation) de la BDD
if (isset($_GET['id_formation'])) // On récupére ce que je supprime dans l'url par son id
{
    $efface = $_GET['id_formation']; // je passe l'id dans une variable $efface
    $sql = " DELETE FROM t_formations WHERE id_formation='$efface' "; // Requête pur supprimer un élément de la BDD

    $pdoCV -> query($sql); // On peut le faire avec exec() également

    header("location: ../admin/formations.php");
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
    <h1>Les informations et insertion d'une nouvelle formation</h1>
        <?php 
            // Requête pour compter et chercher plusieurs enregistrements on ne peut compter qui si on a préparer(avec : prepare) la rrequête
            $sql = $pdoCV -> prepare("SELECT * FROM t_formations");
            $sql -> execute();
            $nbr_formations = $sql -> rowCount();
        ?>
    
        <div>
            <table class="table-bordered table">
            <caption>La liste des formations : <?php echo $nbr_formations; ?></caption>
                <thead>
                    <tr>
                        <th>Titre formation</th>
                        <th>Sous titre</th>
                        <th>Date de formation</th>
                        <th>Description formation</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>        
                </thead>
                <?php 
                while($ligne_formation = $sql -> fetch())
                    {
                ?>
                <tbody>
                    <tr>
                        <td class="td"><?php echo $ligne_formation['id_formation']; ?></td>
                        <td class="td"><?php echo $ligne_formation['titre_form']; ?></td>
                        <td class="td"><?php echo $ligne_formation['stitre_form']; ?></td>
                        <td class="td"><?php echo $ligne_formation['description_form']; ?></td>
                        <td>
                            <a class="href" href="modif_formation.php?id_formation=<?php echo $ligne_formation['id_formation']; ?> ">Modifier</a> 
                        </td>
                        <td class="td">
                            <a class="href" href="formations.php?id_formation=<?php echo $ligne_formation['id_formation']; ?>">Supprimer</a> 
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
            <form action="formations.php" method="post">
                <div class="form-group">
                    <label for="titre_form">Titre formation</label>
                    <input type="text" name="titre_form" placeholder="Nouvelle formation" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="stitre_form">formation</label>
                    <input type="text" name="stitre_form" placeholder="Nouvelle formation" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="dates_form">Date de formation</label>
                    <input type="text" name="dates_form" placeholder="Date de formation" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description_form">Description formation</label>
                    <input type="text" name="description_form" placeholder="Description" class="form-control" required>
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