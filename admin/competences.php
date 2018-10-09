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


$order = '';
if(isset($_GET['order']) && isset($_GET['column'])){

	if($_GET['column'] == 'competence'){
		$order = ' ORDER BY competence';
	}
	elseif($_GET['column'] = 'niveau'){
		$order = ' ORDER BY niveau';
	}
	elseif($_GET['column'] == 'categorie'){     
		$order = ' ORDER BY categorie';
	}
	if($_GET['order'] == 'asc'){      
		$order.= ' ASC';
	}
	elseif($_GET['order'] == 'desc'){
		$order.= ' DESC';
	}
}

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
    <title>Admin : les compétences</title>
</head>
<body>

<h1>Les compétences et insertion d'un nouvelle compétence</h1>

    <?php 
        // Requête pour compter et chercher plusieurs enregistrements on ne peut compter qui si on a préparer(avec : prepare) la rrequête
        $sql = $pdoCV -> prepare("SELECT * FROM t_competences" . $order);
        $sql -> execute();
        $nbr_competence = $sql -> rowCount();
    ?>

    <div class="voir">
        <table border="1" class="table-bordered">
            <thead>
                <caption>La liste des compétences : <?php echo $nbr_competence; ?></caption>
                <tr>
                    <th>Compétences trier de : <a href="competences.php?column=competence&order=asc">A à Z</a> | <a href="competences.php?column=competence&order=desc">Z à A</a> </th> 
                    <th>Niveaux trier de : <a href="competences.php?column=niveau&order=asc">0 à 100</a> | <a href="competences.php?column=niveau&order=desc"> 100 à 0</a></th> 
                    <th>Catégories trier de : <a href="competences.php?column=categorie&order=asc">A à Z</a> | <a href="competences.php?column=categorie&order=desc">Z à A</a></th> 
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
                    <td class="td"><?php echo $ligne_competence['competence']; ?></td>
                    <td class="td"><?php echo $ligne_competence['niveau']; ?>/100</td>
                    <td class="td"><?php echo $ligne_competence['categorie']; ?></td>
                    <td class="td">
                        <a href="competences.php?id_competence=<?php echo $ligne_competence['id_competence']; ?>" class="a">Supprimer</a> 
                    </td>
                    <td class="td">
                        <a href="modif_competence.php?id_competence=<?php echo $ligne_competence['id_competence']; ?>" class="a">Modifier</a> 
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
    <div class="formulaire">
        <form action="competences.php" method="post">
            <div class="form-group">
                <label for="competence">Compétence</label>
                <input type="text" name="competence" placeholder="Nouvelle compétence" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="niveau">Niveau</label>
                <input type="text" name="niveau" placeholder="Niveau en chiffre sur 100"class="form-control"  required>
            </div>
            <div class="form-group">
                <label for="categorie">Catégorie</label>
                <select name="categorie" id="categorie" class="form-control">
                    <option value="Développement">Développement</option>
                    <option value="Infographie">Infographie</option>
                    <option value="Gestion de projet">Gestion de projet</option>
                </select>
            </div>
            <div class="">
                <button type="submit" class="btn btn-primary">Insérer une compétence</button>
            </div>  
        </form>
    </div>
</body>
</html>