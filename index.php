<?php require 'connexion.php';

// Récupère les données de l'utilisateur par son id
$sql = $pdoCV -> query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur = 1"); 
$ligne_utilisateur = $sql-> fetch();
?>

<!-- Je inc tous le haut de page le Doctype, les meta et les liens -->
<?php require 'inc/haut_page.php'; ?>

<!-- Je inc la bar de navigation -->
<?php require 'inc/navigation.php'; ?>

<!-- Je met le contenu de la page --> 
    <img class="img" src="img/titre.png" alt=""><!-- img du titre "développeur intégrateur web" -->
    <div class="row mt-2">
        <div class="col-lg-3 col-12  text-center">
        <!-- Photo, nom, prénom  -->
            <img src="img/moi.jpg" class="rounded mx-auto d-block" alt="...">
            <h1><?php echo $ligne_utilisateur['nom'].' '.$ligne_utilisateur['prenom'];?></h1>
            <h4><i class="fas fa-birthday-cake"></i> <?php echo date('Y') - 1987?> ans</h4>
            <p><i class="fas fa-map-marker-alt"></i> Paris-Romainville 93</p>
            <p><a class="btn btn-primary" href="img/CV01Final.pdf" ><i class="fa fa-download"></i> Télécharger mon CV</a></p>
        </div>
        <!-- Petite description  -->
        <div class="col-lg-9 col-12 ">
            <div class="presentation">
                <div class="col-lg-4 col-sm-12">
                    <div class="text-center form">
                        <i class="fas fa-graduation-cap text-center" style="color: orange"></i>
                    </div>
                    <p class="pIndex">Je suis actuellement à la fin d'une <i style="color: orange">formation intensive</i> de 10 mois labélisée la Grande école du numérique, où nous sommes encadrés par un formateur (Patrick Isola) du PoleS de Pantin et des formateurs de WebForce 3 afin d'apprendre à maîtriser tous les langages de programmation dans le but de pouvoir créer des sites Web dynamiques et résponsives et de valider les certifications pour devenir un <i style="color: orange">développeur integrateur Web junior</i> .</p>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="text-center form">
                        <i class="fas fa-heart" style="color: red"></i>
                    </div>
                    <p class="pIndex">Pour cela, je vais vous présenter mon site portfolio réalisé avec les langages de développement acquis au cours de cette formation tel que le <i style="color: red">HTML 5</i>, le <i style="color: red">CSS 3</i>, <i style="color: red">JavaScript</i>, ce site est résponsive grâce au framework <i style="color: red">Bootstrap 4</i>, dynamique avec du <i style="color: red">PHP 7 </i>et des requêtes <i style="color: red">SQL</i> ce qui permet de récupérer les infos enregistrées par l'utilisateur dans la base de données créée préalablement dans <i style="color: red">PHPMyAdmin</i> .</p>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="text-center form">
                        <i class="fas fa-check-square" style="color: blue"></i>
                    </div>
                    <p class="pIndex">Tous d'abord le front c'est la parti visible et accéssible par le visiteur. Comme vous pouvez le constater dans la navigation j'ai intégré un logo perso créé avec 'logogenie', des typographies comme 'Fredericka the Great' avec 'googlefont' et des icons avec 'fontawesome' <br>
                    Maintenant le back c'est la parti accéssible seulement par l'administrateurs ceux qui leur permet de 'INSERT', 'DELETE' ou 'UPDATE' des infos dans BDD.
                     </p>
                </div>       
            </div><!-- fin .presentation -->
        </div><!-- Fin .col-lg-12 -->
    </div><!-- Fin .row -->

    <div class="display-4 text-center mt-4">
        <img src="img/developpement-web-aris-web.jpg" width='80%' alt="developpement-web-aris-web">
    </div>



<!-- Je inc le footer et les lien JQuery, JS et bootstrap  -->
<?php require 'inc/bas_page.php'; ?>
    

 