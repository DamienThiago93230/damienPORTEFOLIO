<?php require 'connexion.php'; 


// insertion 
if(isset($_POST['nom'])){// si on a reçu un nouveau

    if($_POST['nom'] !="" && $_POST['email'] != "" && $_POST['sujet'] != "" && $_POST['message'] != ""){

        $nom = addslashes($_POST['nom']);
        $email = addslashes($_POST['email']);
        $sujet = addslashes($_POST['sujet']);
        $message = addslashes($_POST['message']);
        $pdoCV -> exec("INSERT INTO t_messages VALUES (NULL, '$nom', '$email', '$sujet', '$message')");

        header("location: ../admin/index.php");
        exit();

    } // fin if !=""

}// fin $_POST reception
// ----------------------------------


// Suppression d'une message dans la BDD
if(isset($_GET['id_message'])){// on récupère ce que je supprime dans l'url par son id

    $efface = $_GET['id_message'];  // je passe l'id dans une variable $efface

    $sql = "DELETE FROM t_messages WHERE id_message = '$efface' "; // delete de la base 
    $pdoCV -> query($sql); // on peut faire aussi avec exec

    header("location: ../admin/messages.php");
    
}


require_once 'inc/haut_page.php';

?>
    <div class="jumbotron text-center mb-4">
        <h1 class="display-4">Contacter moi.</h1>
        <p class="lead">Vous etes sur la page messages.</p>
        <hr class="my-4">
    </div>
    <hr>

    
    
    <!-- Formulaire insertion d'une nouvelle message -->
    
        <div class="formulaire text-center mx-auto">
            <h2 class="text-center">Remplissez le formulaire</h2>
            
            <form action="messages.php" method="post" class="px-4 py-3">
                
                <div class="form-group">
                    <label for="nom">Nom </label>
                    <input type="text" class="form-control" name="nom" placeholder="John" required>
                </div>
            
                <div class="form-group">
                    <label for="email">Email </label>
                    <input type="text" class="form-control" name="email" placeholder="xxx@xxx.xx" required>
                </div>
    
                <div class="form-group">
                    <label for="sujet">Sujet </label>
                    <input type="text" class="form-control" name="sujet" placeholder="Sujet" required>
                </div>        
                
    
                <div class="form-group">
                    <label for="message" class="d-block">Message </label>
                    <textarea type="text" name="message" id="message" class="form-control"></textarea>
                </div>
            
                <div>
                    <button type="submit" class="btn btn-primary">Insérer la message</button>
                </div>
            
            </form>
        </div>
    
<?php
require_once 'inc/bas_page.php';