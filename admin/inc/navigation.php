<?php require 'connexion.php';?> 

<nav class="navbar navbar-expand-sm navbar-dark text-white">
  <!-- Brand -->
  <a class="navbar-brand" href="index.php">SiteCV</a>

  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="connexion.php">Connexion</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Inscription</a>
    </li>

    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Profil
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="competences.php">Compétences</a>
        <a class="dropdown-item" href="loisirs.php">Loisirs</a>
        <a class="dropdown-item" href="formations.php">Formations</a>
        <a class="dropdown-item" href="experiences.php">Experiences pro</a>
      </div>
    </li>
  </ul>
</nav> 