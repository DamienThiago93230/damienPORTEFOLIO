<?php require 'connexion.php'; 

// Récupère les données de l'utilisateur par son id
$sql = $pdoCV -> query(" SELECT * FROM t_utilisateurs where id_utilisateur = '1'"); 
$ligne_utilisateur = $sql-> fetch();

// codes pour filtrer les données du tableau (croissant / décroissant)

$order = '';
if(isset($_GET['order']) && isset($_GET['column'])){

	if($_GET['column'] == 'titre_form'){$order = ' ORDER BY titre_form';}
	elseif($_GET['column'] == 'stitre_form'){$order = ' ORDER BY stitre_form';}
	elseif($_GET['column'] == 'dates_form'){$order = ' ORDER BY dates_form';}
	elseif($_GET['column'] == 'description_form'){$order = ' ORDER BY dates_form';}
	if($_GET['order'] == 'asc'){$order.= ' ASC';}
	elseif($_GET['order'] == 'desc'){$order.= ' DESC';}
}

?>

<!-- Je inc tous le haut de page le Doctype, les meta et les liens -->
<?php require 'inc/haut_page.php';?>

<!-- Je inc la bar de navigation -->
<?php require 'inc/navigation.php';?>



<?php
// requête pour compter et cherhcer plusieurs enregistrements
$sql = $pdoCV -> prepare("SELECT * FROM t_formations WHERE id_utilisateur = '1' $order");
$sql -> execute();
$nbr_formations = $sql -> rowCount(); ?>

    <div class="jumbotron text-center mb-4">
        <h1 class="display-4">Vous êtes sur la page <br> formations</h1>
        
        <hr class="my-4">
        <p>Découvrez les....</p>
    </div>

    
    <div class="text-center mt-4">
        <h1 class="mb-4">Mes formations</h1>
        <div class="row mx-auto">
                <?php while($ligne_formation = $sql -> fetch())
                   {
                ?>
                    <div class="col-lg-3">
                        <div class="card mb-5 mt-4 mx-2 cardForm mx-auto" style="max-width: 40rem; color: wheat">
                            <div class="card-header"><h1><?php echo $ligne_formation['stitre_form'];?> </h1><?php echo $ligne_formation['titre_form'];?>//<?php echo $ligne_formation['dates_form'];?><br></div>
                            <div class="card-body" style="color:black">
                                <?php echo $ligne_formation['description_form'];?>
                            </div>
                        </div>
                    </div>
                <?php 
                   } // Fin de la boucle while
                ?>
        </div><!-- Fin .row -->
    </div> 

<!-- Je inc le footer avec les lien -->
<?php require 'inc/bas_page.php';?>