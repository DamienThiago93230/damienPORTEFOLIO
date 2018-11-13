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
<div class="jumbotron text-center mb-4 col-lg-12">
 
<svg height='200'>
  <filter id='money'>
    <feMorphology in='SourceGraphic' operator='dilate' radius='2' result='expand'/>

    <feOffset in='expand' dx='1' dy='1' result='shadow_1'/>
    <feOffset in='expand' dx='2' dy='2' result='shadow_2'/>
    <feOffset in='expand' dx='3' dy='3' result='shadow_3'/>
    <feOffset in='expand' dx='4' dy='4' result='shadow_4'/>
    <feOffset in='expand' dx='5' dy='5' result='shadow_5'/>
    <feOffset in='expand' dx='6' dy='6' result='shadow_6'/>
    <feOffset in='expand' dx='7' dy='7' result='shadow_7'/>

    <feMerge result='shadow'>
      <feMergeNode in='expand'/>
      <feMergeNode in='shadow_1'/>
      <feMergeNode in='shadow_2'/>
      <feMergeNode in='shadow_3'/>
      <feMergeNode in='shadow_4'/>
      <feMergeNode in='shadow_5'/>
      <feMergeNode in='shadow_6'/>
      <feMergeNode in='shadow_7'/>
    </feMerge>

    <feFlood flood-color='#ebe7e0'/>
    <feComposite in2='shadow' operator='in' result='shadow'/>

    <feMorphology in='shadow' operator='dilate' radius='1' result='border'/>
    <feFlood flood-color='#35322a' result='border_color'/>
    <feComposite in2='border' operator='in' result='border'/>

    <feOffset in='border' dx='1' dy='1' result='secondShadow_1'/>
    <feOffset in='border' dx='2' dy='2' result='secondShadow_2'/>
    <feOffset in='border' dx='3' dy='3' result='secondShadow_3'/>
    <feOffset in='border' dx='4' dy='4' result='secondShadow_4'/>
    <feOffset in='border' dx='5' dy='5' result='secondShadow_5'/>
    <feOffset in='border' dx='6' dy='6' result='secondShadow_6'/>
    <feOffset in='border' dx='7' dy='7' result='secondShadow_7'/>
    <feOffset in='border' dx='8' dy='8' result='secondShadow_8'/>
    <feOffset in='border' dx='9' dy='9' result='secondShadow_9'/>
    <feOffset in='border' dx='10' dy='10' result='secondShadow_10'/>
    <feOffset in='border' dx='11' dy='11' result='secondShadow_11'/>

    <feMerge result='secondShadow'>
      <feMergeNode in='border'/>
      <feMergeNode in='secondShadow_1'/>
      <feMergeNode in='secondShadow_2'/>
      <feMergeNode in='secondShadow_3'/>
      <feMergeNode in='secondShadow_4'/>
      <feMergeNode in='secondShadow_5'/>
      <feMergeNode in='secondShadow_6'/>
      <feMergeNode in='secondShadow_7'/>
      <feMergeNode in='secondShadow_8'/>
      <feMergeNode in='secondShadow_9'/>
      <feMergeNode in='secondShadow_10'/>
      <feMergeNode in='secondShadow_11'/>
    </feMerge>

    <!-- <feImage width='600' height='200' xlink:href='https://s3-us-west-2.amazonaws.com/s.cdpn.io/78779/stripes.svg'/> -->
    <feComposite in2='secondShadow' operator='in' result='secondShadow'/>

    <feMerge>
      <feMergeNode in='secondShadow'/>
      <feMergeNode in='border'/>
      <feMergeNode in='shadow'/>
      <feMergeNode in='SourceGraphic'/>
    </feMerge>
  </filter>

  <text class="titre" dominant-baseline='middle' text-anchor='middle' x='50%' y='50%'>
  Développeur intégrateur Web
  </text>
</svg>
  <hr class="my-4">
  <p style="color: black">Bienvenue sur mon siteCV .</p>
</div>

<div class=" mt-2" >
    <div class="row ">
            <div class="col-lg-3 col-sm-12 text-center" >
                <h1 class="titre1 mt-4"><i>A propos</i></h1>
                <img src="img/moi.jpg" class="rounded mx-auto d-block" alt="...">
                <h1><?php echo $ligne_utilisateur['nom'];?> <?php echo $ligne_utilisateur['prenom'];?></h1>
                <h4><?php echo date('Y') - 1987?> ans</h4>
                <p class="mb-5">Localisation : Paris-Romainville</p>
            </div>
            <div class="col-lg-9 col-sm-12 ">
                <div class="presentation">
                        <h1 class="text-center mb-5 m-4 titre1"><i>Présentation</i></h1>
                    <div class="col-lg-4 col-sm-12">
                        <div class="text-center form">
                            <i class="fas fa-graduation-cap text-center" style="color: orange"></i>
                        </div>
                            <p>Je suis actuellement en <i style="color: orange">formation intensive</i> de 10 mois au PoleS de Pantin où j'apprends à maîtriser tous les langages de programmation dans le but de devenir un <i style="color: orange">développeur integrateur WEB</i> .</p>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="text-center form">
                            <i class="fas fa-heart" style="color: red"></i>
                        </div>
                            <p><i style="color: red">Passionné</i> par l'informatique, en quête de nouvelles <i style="color: red">connaissances</i>, je suis <i style="color: red">polyvalent</i>,<i style="color: red"> motivé</i> et <i style="color: red">détérminé</i> dans mes projets, je pratique le football donc le <i style="color: red">travail d'équipe</i> est un de mes atout majeur .</p>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="text-center form">
                            <i class="fas fa-check-square" style="color: blue"></i>
                        </div>
                            <p><i style="color: blue">Autodidacte</i> je pratique le <i style="color: blue">développement web</i> lors de mes temps libres, je développe mes <i style="color: blue">compétences</i> grâces aux outils tels que: <i style="color: blue">PHP</i>, <i style="color: blue">MySQL</i>, <i style="color: blue">JavaScript</i>, <i style="color: blue">Ajax</i>, <i style="color: blue">HTML</i> ou encore le <i style="color: blue">CSS</i> .</p>
                    </div>       
                </div><!-- fin .presentation -->
            </div><!-- fin lg-12 -->
    </div><!-- Fin .row -->

</div><!-- Fin mt-2 --> 


<div class="display-4 text-center mt-4">
    <img src="img/developpement-web-aris-web.jpg" width='80%' alt="developpement-web-aris-web">
</div>



<!-- Je inc le footer et les lien JQuery, JS et bootstrap  -->
<?php require 'inc/bas_page.php'; ?>
    

 