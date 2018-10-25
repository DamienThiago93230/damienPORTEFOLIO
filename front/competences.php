<?php require 'connexion.php'; 


// Récupère les données de l'utilisateur par son id
$sql = $pdoCV -> query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur = '1'"); 
$ligne_utilisateur = $sql-> fetch();


$order = '';
if(isset($_GET['order']) && isset($_GET['column'])){

	if($_GET['column'] == 'competence'){
		$order = ' ORDER BY competence';
	}
	elseif($_GET['column'] = 'niveau'){
		$order = ' ORDER BY niveau';
	}
	elseif($_GET['column'] == 'categorie'){     
		$order = ' ORDER BY categorie';
	}
	if($_GET['order'] == 'asc'){      
		$order.= ' ASC';
	}
	elseif($_GET['order'] == 'desc'){
		$order.= ' DESC';
	}
}

?>

<!-- Je inc tous le haut de page le Doctype, les meta et les liens -->
<?php require 'inc/haut_page.php'; ?>

<!-- Je inc la bar de navigation -->
<?php require 'inc/navigation.php';?> 

    <div class="jumbotron text-center mb-4">
        <h1 class="display-4">Vous êtes sur la page compétences</h1>
        <hr class="my-4">
        <p >Découvrez les compétences que j'ai acquis au court de ma formation .</p>
        <p class="icon">
            <i class="fab fa-php"></i><i class="fab fa-html5"></i><i class="fab fa-css3-alt"></i><i class="fab fa-js-square"></i><i class="fab fa-wordpress-simple"></i>

        </p>
    </div>

    <h1 class="text-center mb-5 mt-5">Mes compétences</h1>
    
        <?php 
            // Requête pour compter et chercher plusieurs enregistrements on ne peut compter qui si on a préparer(avec : prepare) la rrequête
            $sql = $pdoCV -> prepare("SELECT * FROM t_competences WHERE id_utilisateur = '1' $order" );
            $sql -> execute();
            $nbr_competence = $sql -> rowCount();
        ?>
    
       
    <table class="table table-bordered table-hover text-center mx-auto">
            <caption>La liste des compétences : <?php echo $nbr_competence; ?></caption>
            <thead class="thead-dark">
                <tr class="text-center">
                    <th style="color: wheat">Compétences trier de : <a href="competences.php?column=competence&order=asc" class="href"><i class="fas fa-sort-alpha-up"></i>
                    </a> | <a href="competences.php?column=competence&order=desc" class="href"><i class="fas fa-sort-alpha-down"></i></a> </th> 
                    <th style="color: wheat">Niveaux trier de : <a href="competences.php?column=niveau&order=asc" class="href">0 à 100</a> | <a href="competences.php?column=niveau&order=desc" class="href"> 100 à 0</a></th> 
                    <th style="color: wheat">Catégories trier de : <a href="competences.php?column=categorie&order=asc" class="href"><i class="fas fa-sort-alpha-up"></i></a> | <a href="competences.php?column=categorie&order=desc" class="href"><i class="fas fa-sort-alpha-down"></i></a></th>  
                </tr>        
            </thead>
            <?php 
            while($ligne_competence = $sql -> fetch())
                {
            ?>
            <tbody>
                <tr >
                    <td class="td"><?php echo $ligne_competence['competence']; ?></td>
                    <td class="td"><?php echo $ligne_competence['niveau']; ?>/100</td>
                    <td class="td"><?php echo $ligne_competence['categorie']; ?></td>
                </tr>
            <?php 
                } // Fin du while 
            ?>
            </tbody>
        </table>        
        
        

<!-- Je inc le footer et les lien JQuery, JS et bootstrap  -->
<?php require 'inc/bas_page.php'; ?>