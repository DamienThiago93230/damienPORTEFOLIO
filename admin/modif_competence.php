<?php require 'connexion.php'; 
// Gestion mise à jour d'une information
if (isset($_POST['competence']))
{
    $competence = addslashes($_POST['competence']);
    $niveau = addslashes($_POST['niveau']);
    $categorie = addslashes($_POST['categorie']);
    
    $id_competence = $_POST['id_competence'];

    $pdoCV -> exec(" UPDATE t_competences SET competence='$competence', niveau='$niveau', categorie='$categorie' WHERE id_competence='$id_competence' "); 
    header('location: ../admin/competences.php');
    exit();
} // Fin if isset $_POST

// Je récupère l'id de ce que je met à jour
$id_competence = $_GET['id_competence']; // par son id et avec get
$sql = $pdoCV -> query(" SELECT * FROM t_competences WHERE id_competence='$id_competence'"); 
$ligne_competence = $sql -> fetch(); // Va récupérer les données 

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Admin : mise à jour d'une compétence</title>
</head>
<body>
    <h1>Mise à jour d'une compétence</h1>

    <!-- Mise à jour d'un loisir -->
    <h2>Formulaire de modification d'une compétence</h2>
    <form action="modif_competence.php" method="post">
        <div class="">
            <label for="competence">Compétence</label>
            <input type="text" name="competence" value="<?php echo $ligne_competence['competence']; ?>" required>
        </div>
        <div class="">
            <label for="niveau">Niveau</label>
            <input type="text" name="niveau" value="<?php echo $ligne_competence['niveau']; ?>" required>
        </div>

        

        <div class="">
            <label for="categorie">Catégorie</label>
            <select name="categorie" id="categorie">
                <!-- Développement -->
                <option value="Développement"
                    <?php // pour ajouter select="selected" à la balise option si c'est la catégorie de la compétence
                    if (!(strcmp("Développement", $ligne_competence['categorie']))) { // strcmp compare les chaînes de caractères
                        echo "selected=\"selected\"";
                    }
                    ?>>Développement</option>


                <!-- Infographie -->
                <option value="Infographie"  <?php 
                    if (!(strcmp("Infographie", $ligne_competence['categorie']))) { 
                        echo "selected=\"selected\"";
                    }
                    ?>>Infographie</option>

                <!-- Gestion de projet -->
                <option value="Gestion de projet" 
                    <?php 
                    if (!(strcmp("Gestion de projet", $ligne_competence['categorie']))) { 
                        echo "selected=\"selected\"";
                    }
                    ?>>Gestion de projet</option> 
            </select>
        </div>


        <div class="">
            <input type="hidden" name="id_competence" value="<?php echo $ligne_competence['id_competence']; ?>">
            <button type="submit">Mise à jour d'un compétence</button>
        </div>
    </form>
    
</body>
</html>