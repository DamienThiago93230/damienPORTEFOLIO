<?php 
// connexion à la BDD via le fichier connexion.php situé dans admin 
require 'connexion.php'; 
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
    <!-- Lien Googlefont -->
    <link href="https://fonts.googleapis.com/css?family=Cinzel|Diplomata" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Fredericka+the+Great" rel="stylesheet">  
    <!-- CK Editor 4. -->
    <script src="ckeditor/ckeditor.js"></script>
    <!-- Lien pour la page authentification -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    
    <!-- Mon style CSS -->
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
    
    <title>SiteCV</title>
</head>
<body>
    <div class="container-fluid">
        <?php
        // insertion de la nav-bar
        require 'inc/navigation.php';

        // requête pour chercher toutes les compétences
        $sql = $pdoCV -> prepare("SELECT * FROM t_competences WHERE id_utilisateur = 1 ORDER BY niveau DESC");
        $sql -> execute();

        // Récupère les données de l'utilisateur par son id
        $sql2 = $pdoCV -> query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur = '1'"); 
        $ligne_utilisateur = $sql2-> fetch();
        ?>
    
        <div class="jumbotron text-center mb-4">
            <h1 class="display-4">Découvrez les compétences que j'ai acquis au court de ma formation .</h1>
            <hr>
        </div>
    
        <!-- ANIMATION PROGRESSION -->
        <section class="row rowcomp light">    
            <?php 
                while($ligne_competence = $sql -> fetch())
                {
            ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <!-- cercle de chaque compétence avec son titre en h3 -->
                    <h1 class="competence"><?= $ligne_competence['competence']; ?></h1>
                    <svg class="radial-progress" data-percentage="<?= $ligne_competence['niveau']; ?>" viewBox="0 0 80 80">
                    <!-- la partie du cercle incomplète -->
                        <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                        <!-- la partie du cercle complète -->
                        <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 39.58406743523136;"></circle>
                        <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">
                        <!-- le niveau est affiché ici -->
                        <?= $ligne_competence['niveau']; ?>%</text>
                    </svg> 
                </div><!-- Fin .col-lg.3 -->
            <?php 
                } // Fin de la boucle while
            ?>
        </section><!-- Fin section -->         

        <footer class="text-center p-2">
            <div class="row mx-auto">
                <div class="col-lg-4">
                <h4 style="color: gold">Me contacter</h4>
                    <p>Téléphone : <i style="color: #f47f33"><strong><?= $ligne_utilisateur['portable'];?></strong></i></p>
                    <p>Email : <a href="messages.php" target="_blank" style="color: #f47f33"><i style="color: #f47f33"><strong><?= $ligne_utilisateur['email'];?></strong></i></a></p>
                </div>
                <div class="col-lg-4">
                <h4 style="color: gold">Réseaux</h4>
                    <p class="reseaux">
                        <a style="color: white" href="https://github.com/DamienThiago93230" target="_blank"><i class="fab fa-github"></i></a>
                        <a href="https://www.linkedin.com/feed/" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    </p>
                </div>
                <div class="col-lg-4">
                <h4 style="color: gold">Message</h4>
                    <a class="reseaux" href="messages.php" style="color:wheat"><i class="fas fa-envelope"></i></a>
                </div>
            </div><!-- Fin .row -->
                
            <div class="col-lg-12">
                <p style="color: #f47f33">Copyright &copy; Mon siteCV - 2018</p>
            </div>
        </footer>
    </div> <!-- Fin container-fluid -->

    <!-- lien CDN jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
    <!-- lien bootstrap -->  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>