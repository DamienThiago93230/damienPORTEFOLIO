<?php require 'connexion.php'; 

// gestion mise à jour d'une information
if (isset($_POST['competence'])) { 

    $competence = addslashes($_POST['competence']);
    $niveau = addslashes($_POST['niveau']);
    $categorie = addslashes($_POST['categorie']);

    $id_competence = $_POST['id_competence'];

    $pdoCV -> exec(" UPDATE t_competences SET competence = '$competence', niveau='$niveau', categorie = '$categorie' WHERE id_competence = '$id_competence' ");
    header('location: ../admin/competences.php');
    exit();
} // fin du (isset($_POST['competence']))

// je récupère l'id de ce que je mets à jour
$id_competence = $_GET['id_competence']; // par son id et avec GET 
$sql = $pdoCV -> query (" SELECT * FROM  t_competences WHERE id_competence='$id_competence' ");
$ligne_competence = $sql -> fetch(); // va récupérer les données 

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin : mise à jour d'une compétence</title>
    <!-- Lien Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- Mon style CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
     <!-- Ici, j'inclus ma page naviagtion.php -->
    <?php require 'inc/navigation.php'; ?>

    <div class="container-fluid">
        <h1>Mise à jour d'une compétence</h1>
        <!-- Mise à jour d'une nouvelle compétence formulaire  -->
        <div class="formulaire">
            <form action="modif_competence.php" method="post">
               <div class="form-group">
                    <label for="competence">Compétences</label>                
                    <input class="form-control" type="text" name="competence" value="<?php echo $ligne_competence['competence']; ?>" required>    
               </div>
        
               <div class="form-group">
                    <label for="niveau">Niveau</label>                
                    <input class="form-control" type="text" name="niveau" value="<?php echo $ligne_competence['niveau']; ?>" required>
               </div>
        
               <div class="form-group">
                    <label for="categorie">Catégorie</label>                
                    <select name="categorie">
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
               </div><!-- Fin du menu déroulant pour les catégories -->
        
                <div class="form-group">
                <input class="form-control" type="hidden" name="id_competence" value="<?php echo $ligne_competence['id_competence']; ?>">
                    <button class="btn btn-primary" type="submit">Modifier</button>
                </div>
            </form><!-- fin form -->
        </div>
    </div>
    <!-- lien bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>

</body>
</html>