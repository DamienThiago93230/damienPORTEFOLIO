<?php require 'connexion.php'; 

// Insertion d'un élément en BDD
if (isset($_POST['competence']) && $_POST['niveau'] != '' && $_POST['categorie'] != '') // Si on à reçu une nouvelle compétence
{
    $competence = addslashes ($_POST['competence']);
    $niveau = addslashes ($_POST['niveau']);
    $categorie = addslashes ($_POST['categorie']);

    $pdoCV -> exec(" INSERT INTO t_competences VALUES (NULL, '$competence', '$niveau', '$categorie', '1')");

    header("location: ../admin/competences.php");
     
    exit();     
}// ferme le if isset $_POST
//******************************/

// Suppression d'un élément(ici : competence) de la BDD
if (isset($_GET['id_competence'])) // On récupére ce que je supprime dans l'url par son id
{
    $efface = $_GET['id_competence']; // je passe l'id dans une variable $efface
    $sql = " DELETE FROM t_competences WHERE id_competence='$efface' "; // Requête pur supprimer un élément de la BDD

    $pdoCV -> query($sql); // On peut le faire avec exec() également

    header("location: ../admin/competences.php");
}// ferme le if isset $_GET pour suppression
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Admin : les compétences</title>
</head>
<body>

<h1>Les compétences et insertion d'un nouvelle compétence</h1>

    <?php 
        // Requête pour compter et chercher plusieurs enregistrements on ne peut compter qui si on a préparer(avec : prepare) la rrequête
        $sql = $pdoCV -> prepare("SELECT * FROM t_competences");
        $sql -> execute();
        $nbr_competence = $sql -> rowCount();
    ?>

    <div class="voir">
        <table border="1">
        <caption>La liste des compétences : <?php echo $nbr_competence; ?></caption>
            <thead>
                <tr>
                    <th>Compétences </th> 
                    <th>Niveaux </th> 
                    <th>Catégorie </th> 
                    <th>Supprimer </th> 
                    <th>Modifier </th> 
                </tr>        
            </thead>
            <?php 
            while($ligne_competence = $sql -> fetch())
                {
            ?>
            <tbody>
                <tr>
                    <td><?php echo $ligne_competence['competence']; ?></td>
                    <td><?php echo $ligne_competence['niveau']; ?>/100</td>
                    <td><?php echo $ligne_competence['categorie']; ?></td>
                    <td>
                        <a href="competences.php?id_competence=<?php echo $ligne_competence['id_competence']; ?>">Supprimer</a> 
                    </td>
                    <td>
                        <a href="modif_competence.php?id_competence=<?php echo $ligne_competence['id_competence']; ?>">Modifier</a> 
                    </td>
                </tr>
            <?php 
                } // Fin du while 
            ?>
            </tbody>
        </table>        
    </div>
    <hr>
    <h2>Formulaire d'insertion d'une compétence</h2>
    <!-- Insertion d'un nouveau compétence -->
    <form action="competences.php" method="post">
        <div class="">
            <label for="competence">Compétence</label>
            <input type="text" name="competence" placeholder="Nouvelle compétence" required>
        </div>
        <div class="">
            <label for="niveau">Niveau</label>
            <input type="text" name="niveau" placeholder="Niveau en chiffre sur 100" required>
        </div>
        <div class="">
            <label for="categorie">Catégorie</label>
            <select name="categorie" id="categorie">
                <option value="developpement">Développement</option>
                <option value="infographie">Infographie</option>
                <option value="gestion_de_projet">Gestion de projet</option>
            </select>
        </div>
        <div class="">
            <button type="submit">Insérer une compétence</button>
        </div>
    
    
    </form>
</body>
</html>