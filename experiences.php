<?php require 'connexion.php';

    // Récupère les données de l'utilisateur par son id
    $sql = $pdoCV -> query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur = '1'"); 
    $ligne_utilisateur = $sql-> fetch();

    // insertion d'un formulaire
    if (isset($_POST['titre_exp'])) { // si on a reçu une nouvelle expation
        if ($_POST['titre_exp'] !='' && $_POST['stitre_exp'] !='' && $_POST['stitre_exp'] !='' && $_POST['dates_exp'] !='' && $_POST['description_exp'] !='' ) {

            $titre_exp = addslashes($_POST['titre_exp']);
            $stitre_exp = addslashes($_POST['stitre_exp']);
            $dates_exp = addslashes($_POST['dates_exp']);
            $description_exp = addslashes($_POST['description_exp']);
            $pdoCV -> exec(" INSERT INTO t_experiences VALUES (NULL, '$titre_exp', '$stitre_exp', '$dates_exp', '$description_exp', '$id_utilisateur') ");

            header("location: ../admin/experiences.php");
            exit(); 

        } // ferme le if n'est pas vide
    } // fin de isset($_POST['experience'])

    // Suppression d'un élément(ici : experience) de la BDD
    if (isset($_GET['id_experience'])) // On récupére ce que je supprime dans l'url par son id
    {
        $efface = $_GET['id_experience']; // je passe l'id dans une variable $efface
        $sql = " DELETE FROM t_experiences WHERE id_experience='$efface' "; // Requête pur supprimer un élément de la BDD

        $pdoCV -> query($sql); // On peut le faire avec exec() également

        header("location: ../admin/experiences.php");
    }// ferme le if isset $_GET pour suppression

?>

<!-- Je inc tous le haut de page le Doctype, les meta et les liens -->
<?php require 'inc/haut_page.php';?> 

<!-- Je inc la bar de navigation -->
<?php require 'inc/navigation.php';?> 

    <main>
        <div class="jumbotron text-center mb-4">
            <h1 class="display-4">Découvrez mon parcours professionel .</h1>
            
            <hr class="my-4">
            <p>Découvrez les....</p>
        </div>
        
        <?php 
            // Requête pour compter et chercher plusieurs enregistrements on ne peut compter qui si on a préparer(avec : prepare) la rrequête
            $sql = $pdoCV -> prepare("SELECT * FROM t_experiences WHERE id_utilisateur = '1'");
            $sql -> execute();
            $nbr_experiences = $sql -> rowCount();
        ?>
        
        <div class="text-center mt-4">
            <h1 class="text-center mb-4 mt-4">Mes experiences</h1>
            <div class="row mx-auto">
                <?php 
                /* Boucle pour récupérer chaque experience et l'afficher dans une card propre a chacune */
                while($ligne_experience = $sql -> fetch())
                    {
                ?>
                <div class="col-lg-3">
                    <div class="card mb-5 mt-4 mx-2 cardForm mx-auto" style="max-width: 40rem; color: wheat">
                        <div class="card-header"><h1><?php echo $ligne_experience['titre_exp'];?> </h1><?php echo $ligne_experience['stitre_exp'];?>//<?php echo $ligne_experience['dates_exp'];?><br></div>
                        <div class="card-body text-left" style="color:black">
                            <?php echo $ligne_experience['description_exp'];?>
                        </div>
                    </div>
                </div><!-- Fin .lg-3 --> 
                <?php 
                    } // Fin de la boucle while
                ?>    
            </div> <!-- Fin .row -->  
        </div><!-- Fin .text-center -->
    </main>
       
<!-- Je inc le footer et les lien JQuery, JS et bootstrap -->
<?php require 'inc/bas_page.php';?> 
