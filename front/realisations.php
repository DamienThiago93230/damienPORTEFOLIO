<?php require 'connexion.php'; 

// Récupère les données de l'utilisateur par son id
$sql = $pdoCV -> query(" SELECT * FROM t_utilisateurs where id_utilisateur = '1'"); 
$ligne_utilisateur = $sql-> fetch();




// codes pour filtrer les données du tableau (croissant / décroissant)

$order = '';
if(isset($_GET['order']) && isset($_GET['column'])){

	if($_GET['column'] == 'titre_real'){$order = ' ORDER BY titre_real';}
	elseif($_GET['column'] == 'stitre_real'){$order = ' ORDER BY stitre_real';}
	elseif($_GET['column'] == 'dates_real'){$order = ' ORDER BY dates_real';}
	elseif($_GET['column'] == 'description_real'){$order = ' ORDER BY dates_real';}
	if($_GET['order'] == 'asc'){$order.= ' ASC';}
	elseif($_GET['order'] == 'desc'){$order.= ' DESC';}
}

require_once 'inc/haut_page.php';
require_once 'inc/navigation.php';

// requête pour compter et cherhcer plusieurs enregistrements
$sql = $pdoCV -> prepare("SELECT * FROM t_realisations WHERE id_utilisateur = '1' $order");
$sql -> execute();
$nbr_realisations = $sql -> rowCount(); ?>

        <main>
    <div class="jumbotron text-center mb-4">
        <h1 class="display-4">Vous êtes sur la page des réalisations</h1>
        <hr class="my-4">
        <p>Découvrez les....</p>
    </div>

        <!-- div pour le tableau -->
        <div class="text-center table-responsive table-hover mt-4 ">
    
            <h1 class="mb-4">Gestion des réalisations</h1>
    
            <table class="table table-bordered mb-4 mx-auto">
            <caption>La liste des réalisations : <?php echo $nbr_realisations; ?></caption>
                <thead class="thead-dark">
                    <tr>
                        <th style="color: wheat">Titre réalisations <a href="realisations.php?column=titre_real&order=asc"><i class="fas fa-arrow-up"></i></a> | <a href="realisations.php?column=titre_real&order=desc"><i class="fas fa-arrow-down"></i></a> </th>
                        <th style="color: wheat">Sous-titre <a href="realisations.php?column=stitre_real&order=asc"><i class="fas fa-arrow-up"></i></a> | <a href="realisations.php?column=stitre_real&order=desc"><i class="fas fa-arrow-down"></i></a> </th>
                        <th style="color: wheat">Dates <a href="realisations.php?column=dates_real&order=asc"><i class="fas fa-arrow-up"></i></a> | <a href="realisations.php?column=dates_real&order=desc"><i class="fas fa-arrow-down"></i></a> </th>
                        <th style="color: wheat">Descriptions <a href="realisations.php?column=description_real&order=asc"><i class="fas fa-arrow-up"></i></a> | <a href="realisations.php?column=description_real&order=desc"><i class="fas fa-arrow-down"></i></a> </th>
                        <th style="color: wheat">Modification</th>
                        <th style="color: wheat">Suppression</th>
                    </tr>
                </thead>
                <tbody>
                <?php while($ligne_realisation = $sql -> fetch()) {
                ?>
                    <tr>
                        <td><?= $ligne_realisation['titre_real']; ?></td>
                        <td><?= $ligne_realisation['stitre_real']; ?></td>
                        <td><?= $ligne_realisation['dates_real']; ?></td>
                        <td><?= $ligne_realisation['description_real']; ?></td>
                        <td> <a href="modif_realisation.php?id_realisation=<?= $ligne_realisation['id_realisation'];?>"><i class="fas fa-edit"></i></a></td>
                        <td> <a href="realisations.php?id_realisation=<?= $ligne_realisation['id_realisation'];?>"><i class="fas fa-trash-alt text-danger"></i></a></td>
                    </tr>
                    
                <?php 
                    } // Fin de la boucle while
                ?>
                </tbody>
            </table>
            
        </div> <!-- Fin div tableau -->
    </main>
    
<?php
require_once 'inc/bas_page.php';