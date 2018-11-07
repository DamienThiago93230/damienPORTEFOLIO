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
  <p>Bienvenue sur mon siteCV .</p>
</div>

<div class=" mt-2" >
    <div class="row ">
            <div class="col-lg-3 text-center" >
                <h1 class="h1index"><i>Qui suis-je ?</i></h1>
                <img src="img/moi.jpg" class="rounded mx-auto d-block" alt="...">
                <h3><?php echo $ligne_utilisateur['nom'];?> <?php echo $ligne_utilisateur['prenom'];?></h3>
                <h4><?php echo date('Y') - 1987?> ans</h4>
                <p>6 mois d'experiences</p>
                <p></p>
            </div>
            <div class="col-lg-9 ">
                <div class="row col-lg-12">
                    <div class="presentation">
                            <h1 class="text-center mb-5 m-4 h1index"><i>Présentation</i></h1>
                        <div class="col-lg-4">
                        <div class="text-center form"><i class="fas fa-graduation-cap text-center"></i></div>
                            <p>Je suis actuellement en formation intensive de 10 mois au PoleS de Pantin où j'apprends à maîtriser tous les langages de programmation dans le but de devenir un développeur WEB.</p>
                        </div>
                        <div class="col-lg-4">
                        <div class="text-center form"><i class="fas fa-heart" style="color: red"></i></div>
                            <p>Je suis actuellement en formation intensive de 10 mois au PoleS de Pantin où j'apprends à maîtriser les langages de programmation dans le but de devenir un développeur WEB.</p>
                        </div>
                        <div class="col-lg-4">
                        <div class="text-center form"><i class="fas fa-check-square"></i>
</div>
                            <p>Je suis actuellement en formation intensive de 10 mois au PoleS de Pantin où j'apprends à maîtriser les langages de programmation dans le but de devenir un développeur WEB.</p>
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
    

 