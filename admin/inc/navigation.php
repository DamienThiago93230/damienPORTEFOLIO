<?php require 'connexion.php';?> 


<nav class="navbar navbar-expand-sm navbar-dark text-white mb-0">
    <!-- Brand -->
    <a class="navbar-brand" href="index.php">Accueil </a>

    <!-- Links -->
    <ul class="navbar-nav">

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Profil <?php echo $ligne_utilisateur['prenom']; ?>
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="competences.php">Compétences</a>
        <a class="dropdown-item" href="loisirs.php">Loisirs</a>
        <a class="dropdown-item" href="formations.php">Formations</a>
        <a class="dropdown-item" href="experiences.php">Experiences pro</a>
        <a class="dropdown-item" href="messages.php">Message</a>
      </div>
    </li>

    
    <li class="nav-item">
      <a class="nav-link" href="#">Inscription</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="connexion.php">Connexion</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="../admin/index.php?quitter=oui" title="déconnecter vous ! ">Déconnexion <i style="color: red" class="fas fa-sign-out-alt"></i></a>
    </li>
  
    <!-- Dropdown -->
    
  </ul>
</nav> 