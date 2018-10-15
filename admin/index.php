<?php require 'connexion.php';

session_start(); // à mettre dans toutes les pages de l'admin 

if (isset($_SESSION['connexion_admin'])) { // Si on est connecter on récupère les variables de sesion 
    $email=$_SESSION['email'];
    $mdp=$_SESSION['mdp'];
    $nom=$_SESSION['nom'];
}else { // Si on est pas connecté on ne peut peut pas se connecter
    header('location:authentification.php');
}

?>


<!-- Je inc tous le haut de page le Doctype, les meta et les liens -->
<?php require 'inc/haut_page.php'; ?>



<!-- Je inc la bar de navigation -->
<?php require 'inc/navigation.php'; ?>


<!-- Je met le contenu de la page -->
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">Site porte_folio</h1>
        <p class="lead">Formation développeur intégrateur Web</p>
      </div>
    </div>

<!-- Je inc le footer et les lien JQuery, JS et bootstrap  -->
<?php require 'inc/bas_page.php'; ?>
    

 