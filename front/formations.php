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
        <h1 class="display-4">Vous êtes sur la page formations</h1>
        
        <hr class="my-4">
        <p>Découvrez les....</p>
    </div>

    <!-- div pour le tableau -->
    <div class="text-center table-responsive table-hover mt-4 mx-auto ">

        <h1 class="mb-4">Mes formations</h1>

        <table class="table table-bordered mb-4 mx-auto">
        
            
            <tbody>
                
                <?php while($ligne_formation = $sql -> fetch())
                   {
                ?>
                    
                    <div class="card bg-light mb-5 col-lg-4 mx-5" style="max-width: 50rem; color:wheat">
                        <div class="card-header" ><?php echo $ligne_formation['titre_form'];?>//<?php echo $ligne_formation['dates_form'];?><br><?php echo $ligne_formation['stitre_form'];?></div>
                        <p ></p>
                        <div  style="color:black">
                            <h5 ><?php echo $ligne_formation['description_form'];?></h5>
                        </div>
                    </div>
                   
                    
                <?php 
                   } // Fin de la boucle while
                ?>
            </tbody>
        </table>
        
    </div> <!-- Fin div tableau -->

    

    
    
<!-- Je inc le footer avec les lien -->
<?php require 'inc/bas_page.php';?>