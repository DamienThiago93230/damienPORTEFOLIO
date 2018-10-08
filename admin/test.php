<?php require 'connexion.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php 
        // Requête pour une seul info
        $sql = $pdoCV->query(" SELECT * FROM t_utilisateurs "); 
        $ligne_utilisateur = $sql->fetch();    
    ?>
    <title>Admin : <?php echo $ligne_utilisateur['pseudo']; ?></title>
    <link rel="stylesheet" href="test_style.css">
</head>
<body>
    <h1>Test en cours</h1>
    <p> <?php echo $ligne_utilisateur['nom'].' '. $ligne_utilisateur['prenom']; ?> </p> 
    <hr>   
    <?php
        // Requête pour compter et chercher plusieurs enregistrements on ne peut compter qui si on a préparer(avec : prepare) la rrequête
        $sql = $pdoCV -> prepare("SELECT * FROM t_loisirs");
        $sql -> execute();
        $nbr_loisirs = $sql -> rowCount();
    ?>
    <h5>Il y a <?php echo $nbr_loisirs; ?> loisirs</h5>
    <ul>
        <?php
            while ($ligne_loisir = $sql -> fetch()) 
            {
        ?>
            <li><?php echo $ligne_loisir['loisir']; ?></li>
        <?php 
            }// Fin du while  
        ?>
    </ul>





     
    
    
</body>
</html>