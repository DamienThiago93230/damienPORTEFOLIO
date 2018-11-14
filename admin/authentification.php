<?php require 'connexion.php';

session_start(); // à mettre dans toutes les pages de l'admin 
define('RACINE_SITE', '/');

// Traitement pour la connexion a l'admin
if (isset($_POST['connexion'])) { // Connexion est le name du button
    $email = addslashes($_POST['email']);
    $mdp = addslashes($_POST['mdp']);

    // On verifie email et mdp
    $sql = $pdoCV -> prepare(" SELECT * FROM t_utilisateurs where email='$email' AND mdp='$mdp'");

    $sql -> execute();
    $nbr_utilisateur = $sql -> rowCount(); // On compt si il est dans la BDD, le count retourne 0 si il n'y est pas  et répond 1 si c'est le cas

    if ($nbr_utilisateur == 0) { // Il n'y est pas !
        echo '<p>Erreur !!!</p>';
    }else {
        // echo $nbr_utilisateur; // Il y est
        $ligne_utilisateur = $sql -> fetch();

        $_SESSION['connexion_admin'] = 'connecté'; // Connexion pour l'admin

        $_SESSION['id_utilisateur'] = $ligne_utilisateur['id_utilisateur'];
        $_SESSION['email'] = $ligne_utilisateur['email'];
        $_SESSION['nom'] = $ligne_utilisateur['nom'];
        $_SESSION['mdp'] = $ligne_utilisateur['mdp'];
        
        header('location:../admin/index.php');
    }
}

// Je inc tous le haut de page le Doctype, les meta et les liens
require_once 'inc/haut_page.php';

?>
    
	
		<main>
			<div class="container-fluid">
				<div class="row login">
					<div class="col-sm-6 col-md-4 col-md-offset-4">
						<div class="panel panel-default bg-danger">
							<div class="panel-heading">
								<strong>Connectez-vous pour continuer</strong>
							</div>
							<div class="panel-body">
								<form role="form" action="authentification.php" method="POST">
									<fieldset>
										<div class="row">
											<div class="center-block">
												<img class="profile-img"
													src="img/login.jpg?sz=120" alt="">
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12 col-md-10  col-md-offset-1 ">
												<div class="form-group">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="glyphicon glyphicon-user"></i>
														</span> 
														<input type="email" name="email" id="email" placeholder="Votre email" class="form-control" required autofocus>
													</div>
												</div>
												<div class="form-group">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="glyphicon glyphicon-lock"></i>
														</span>
														<input type="password" name="mdp" id="mdp" placeholder="Votre mot de passe" class="form-control" required>
													</div>
												</div>
												<div class="form-group">
													<input type="submit" name="connexion" class="btn btn-lg btn-primary btn-block" value="connexion">
												</div>
											</div>
										</div>
									</fieldset>
								</form>
							</div>
							<div class="panel-footer ">
		                    Vous n'avez pas de compte!<a href="inscription.php" onClick="">  Inscrivez - vous ici  </a>
							</div>
		                </div>
					</div>
				</div>
			</div>
	    
		</main>





    
    
<?php

    
