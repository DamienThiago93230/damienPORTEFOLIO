<?php require 'connexion.php';

session_start(); // à mettre dans toutes les pages de l'admin 

if (isset($_SESSION['connexion_admin'])) { // Si on est connecter on récupère les variables de sesion 
    $id_utilisateur=$_SESSION['id_utilisateur'];
    $email=$_SESSION['email'];
    $mdp=$_SESSION['mdp'];
    $nom=$_SESSION['nom'];
    // echo $id_utilisateur;
}else { // Si on est pas connecté on ne peut peut pas se connecter
    header('location:authentification.php');
}
// Pour vider les variables de session destruy !
if (isset($_GET['quitter'])) { // On récupère le terme quitter en GET
    $_SESSION['connexion_admin'] = '';
    $_SESSION['id_utilisateur'] = '';
    $_SESSION['email'] = '';
    $_SESSION['nom'] = '';
    $_SESSION['mdp'] = '';

    unset($_SESSION['connexion_admin']); // unset détruit la variable connexion_admin
    session_destroy(); // On detruit la session

    header('location:authentification.php');
}

// Récupère les données de l'utilisateur par son id
$sql = $pdoCV -> query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur = '$id_utilisateur'"); 
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

<div class=" mt-4 bg-primary" >

    <div class="row ">
            <div class="col-lg-3 text-center" >
                <h1><i>Qui suis-je ?</i></h1>
                <img src="img/moi.jpg" class="rounded mx-auto d-block" alt="...">
                <h3><?php echo $ligne_utilisateur['nom'];?> <?php echo $ligne_utilisateur['prenom'];?></h3>
                <p>6 mois d'experiences</p>
                <p></p>
            </div>
            <div class="col-lg-9 ">
            <h1 class="text-center mb-5 m-4"><i>Présentation</i></h1>
            <div class="presentation"><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime reprehenderit asperiores culpa, laborum, ullam nisi deserunt cumque labore voluptates quod at impedit id quisquam nobis consequatur itaque. Dolor, rem nostrum!</p></div>
            </div>
    </div><!-- Fin .row -->

</div> 



<h1 class="display-4 text-center">
    <img src="img/developpement-web-aris-web.jpg" width='80%' alt="developpement-web-aris-web">
</h1>

  






<!-- Je inc le footer et les lien JQuery, JS et bootstrap  -->
<?php require 'inc/bas_page.php'; ?>
    

 