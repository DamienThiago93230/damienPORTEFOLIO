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
<div class="jumbotron text-center mb-4">
  <h1 class="display-4">Développeur intégrateur <br> Web</h1>
  <hr class="my-4">
  <p style="color: black">Bienvenue sur mon siteCV .</p>
</div>

<div class=" mt-2" >
    <div class="row ">
            <div class="col-lg-3 text-center" >
                <h1 class="h1index"><i>Qui suis-je ?</i></h1>
                <img src="img/moi.jpg" class="rounded mx-auto d-block" alt="...">
                <h1><?php echo $ligne_utilisateur['nom'];?> <?php echo $ligne_utilisateur['prenom'];?></h1>
                <h4><?php echo date('Y') - 1987?> ans</h4>
                <p>Localisation : Paris-Romainville</p>
            </div>
            <div class="col-lg-9 ">
                <div class="row col-lg-12">
                    <div class="presentation">
                            <h1 class="text-center mb-5 m-4 h1index"><i>Présentation</i></h1>
                        <div class="col-lg-4">
                        <div class="text-center form"><i class="fas fa-graduation-cap text-center" style="color: orange"></i></div>
                            <p>Je suis actuellement en <i style="color: orange">formation intensive</i> de 10 mois au PoleS de Pantin où j'apprends à maîtriser tous les langages de programmation dans le but de devenir un <i style="color: orange">développeur integrateur WEB</i> .</p>
                        </div>
                        <div class="col-lg-4">
                        <div class="text-center form"><i class="fas fa-heart" style="color: red"></i></div>
                            <p><i style="color: red">Passionné</i> par l'informatique, en quête de nouvelles <i style="color: red">connaissances</i>, je suis <i style="color: red">polyvalent</i>,<i style="color: red"> motivé</i> et <i style="color: red">détérminé</i> dans mes projets, je pratique le football donc le <i style="color: red">travail d'équipe</i> est un de mes atout majeur .</p>
                        </div>
                        <div class="col-lg-4">
                        <div class="text-center form"><i class="fas fa-check-square" style="color: blue"></i></div>
                            <p><i style="color: blue">Autodidacte</i> je pratique le <i style="color: blue">développement web</i> lors de mes temps libres, je développe mes <i style="color: blue">compétences</i> grâces aux outils tels que: <i style="color: blue">PHP</i>, <i style="color: blue">MySQL</i>, <i style="color: blue">JavaScript</i>, <i style="color: blue">Ajax</i>, <i style="color: blue">HTML</i> ou encore le <i style="color: blue">CSS</i> .</p>
                        </div>
                    </div>
                </div>
            </div>
    </div><!-- Fin .row -->

</div><!-- Fin mt-4 --> 

<div class="display-4 text-center">
    <img src="img/developpement-web-aris-web.jpg" width='80%' alt="developpement-web-aris-web">
</div>



<!-- Je inc le footer et les lien JQuery, JS et bootstrap  -->
<?php require 'inc/bas_page.php'; ?>
    

 