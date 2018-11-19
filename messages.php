<?php require 'connexion.php'; 


// insertion 
if(isset($_POST['nom'])){// si on a reçu un nouveau

    if($_POST['nom'] !="" && $_POST['email'] != "" && $_POST['sujet'] != "" && $_POST['message'] != ""){

        $nom = addslashes($_POST['nom']);
        $email = addslashes($_POST['email']);
        $sujet = addslashes($_POST['sujet']);
        $message = addslashes($_POST['message']);
        $pdoCV -> exec("INSERT INTO t_messages VALUES (NULL, '$nom', '$email', '$sujet', '$message')");

        //pour faire le courriel

		$entete ="From: page damien santo <damien.santo@lepoles.com>\r\n"; 
		$entete.="Reply-To: damien.santo@lepoles.com\r\n";
		$entete.="MIME-version: 1.0\r\n";
		$entete.="Content-Type: text/html; charset=\"UTF-8\""."\n"; //utf 8 pour avoir les accents
		$entete.="Content-Transfer-Encoding: 8bit";
	

		$corps="Nouveau message : ".$nom.' vient d\'écrire.  ';
		$corps.="<br>Nom : <strong>".$nom.'</strong><br> ' ;
		$corps.="Courriel : <em>".$email.'</em><br>';
		$corps.="Sujet : <em>".$sujet.'</em><br>';
		$corps.="Message. : ".$message.'<br>';
	
	    mail('damien.santo@lepoles.com','Message de : '.$nom, $corps, $entete);//on fait un courriel pour Christophe avec le nom du client dans l'objet

        header("location: ../front/index.php");
        exit();

    } // fin if !=""

}// fin $_POST reception

require_once 'inc/haut_page.php';

?>
    <div class="jumbotron text-center mb-4">
        <h1>Contactez moi.</h1>
        <hr class="my-4">
        <p>24H/24 || 7j/7</p>
        <p>Réponse sous 24H</p>
    </div>
    <hr>

    
    
    <!-- Formulaire insertion d'une nouvelle message -->
        <div class="row">
            <div class="formulaireContact text-center mx-auto col-sm-12 col-lg-6">
                <h2 class="text-center" style="color: black; text-shadow: wheat 2px -1px;font-size: 35px;">Formulaire de contact</h2>
                
                <form action="messages.php" method="post" class="px-4 py-3"> 
                    
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="nom">Nom </label>
                            <input type="text" class="form-control" name="nom" placeholder="John" required>
                        </div>
                    
                        <div class="form-group col-md-4">
                            <label for="email">Email </label>
                            <input type="text" class="form-control" name="email" placeholder="xxx@xxx.xx" required>
                        </div>
            
                        <div class="form-group col-md-4">
                            <label for="sujet">Sujet </label>
                            <input type="text" class="form-control" name="sujet" placeholder="Sujet" required>
                        </div>        
                        
                        <div class="form-group col-md-12">
                            <label for="message" >Message </label>
                            <textarea type="text" name="message" id="message" class="form-control"></textarea>
                        </div>
                    
                        <div class="form-group mx-auto">
                            <button type="submit" class="btn btn-primary">Envoyer le message</button>
                        </div>
                    </div>
                
                </form>
            </div>
        </div>
    
<?php
require_once 'inc/bas_page.php';