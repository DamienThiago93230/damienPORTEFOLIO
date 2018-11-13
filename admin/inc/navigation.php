<?php require 'connexion.php';?> 


<nav class="navbar navbar-expand-lg navbar-dark text-white mb-0 ">
  <a class="navbar-brand" href="index.php"><img src="img/logo3.png" alt="logo"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item lienPage">
        <a class="nav-link" href="competences.php">Compétences <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item lienPage">
        <a class="nav-link" href="experiences.php">Expériences Pro</a>
      </li>
      <li class="nav-item lienPage">
        <a class="nav-link" href="formations.php">Formations</a>
      </li>
      <li class="nav-item lienPage">
        <a class="nav-link " href="loisirs.php">Loisirs</a>
      </li>
      <li class="nav-item lienPage">
        <a class="nav-link " href="realisations.php">Réalisations</a>
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
    </ul>
  </div>
</nav><!-- Fin nav -->