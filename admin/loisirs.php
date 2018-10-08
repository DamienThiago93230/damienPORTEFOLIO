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
    <link rel="stylesheet" href="css/style.css">
    <title>Admin : les loisirs</title>
</head>
<body>

<h1>Les loisirs et insertion d'un nouveau loisir</h1>

    <?php 
        // Requête pour compter et chercher plusieurs enregistrements on ne peut compter qui si on a préparer(avec : prepare) la rrequête
        $sql = $pdoCV -> prepare("SELECT * FROM t_loisirs");
        $sql -> execute();
        $nbr_loisirs = $sql -> rowCount();
    ?>

    <div class="voir">
        <table border="1">
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
                    <td><?php echo $ligne_loisir['loisir']; ?></td>
                    <td>
                        <a href="modif_loisir.php?id_loisir=<?php echo $ligne_loisir['id_loisir']; ?>">Modifier</a> 
                    </td>
                    <td>
                        <a href="loisirs.php?id_loisir=<?php echo $ligne_loisir['id_loisir']; ?>">Supprimer</a> 
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
    <form action="loisirs.php" method="post">
        <div class="">
            <label for="loisir">Loisir</label>
            <input type="text" name="loisir" placeholder="Nouveau loisir" required>
        </div>
        <div class="">
            <button type="submit">Insérer un loisir</button>
        </div>
    </form>
</body>
</html>