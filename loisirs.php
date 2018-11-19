<?php require 'connexion.php';

// Récupère les données de l'utilisateur par son id
$sql = $pdoCV -> query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur = '1'"); 
$ligne_utilisateur = $sql-> fetch();

?>
<!-- Je inc le footer et les lien JQuery, JS et bootstrap  -->
<?php require 'inc/haut_page.php'; ?>


<?php require 'inc/navigation.php';?> 

    <div class="jumbotron text-center mb-4">
        <h1 class="display-4">Vous êtes sur la page <br> loisirs</h1>
        <hr class="my-4">
        <p>Découvrez les....</p>
    </div>


    <div class="text-center table-responsive table-hover mt-4 ">
        <h1 class="text-center mb-4">Mes loisirs</h1>
            <?php 
                // Requête pour compter et chercher plusieurs enregistrements on ne peut compter qui si on a préparer(avec : prepare) la rrequête
                $sql = $pdoCV -> prepare("SELECT * FROM t_loisirs WHERE id_utilisateur ='1'");
                $sql -> execute();
                $nbr_loisirs = $sql -> rowCount();
            ?>
        
            
            <div class="row taille mx-auto">
                <div class="col-lg-4">
                    <table class="table table-bordered l">
                    <caption>La liste des loisirs : <?php echo $nbr_loisirs; ?></caption>
                        <thead class="thead-dark">
                            <tr>
                                <th style="color: wheat">Loisirs</th>
                            </tr>        
                        </thead>
                        <?php 
                        while($ligne_loisir = $sql -> fetch())
                            {
                        ?>
                        <tbody>
                            <tr>
                                <td class="td"><?php echo $ligne_loisir['loisir']; ?></td>
                            </tr>
                        <?php 
                            } 
                        ?>
                        </tbody>
                    </table>
                </div><!-- fin col-lg-4 -->
                <div class="col-lg-8 col-sm-12">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="w-100" src="img/psg.jpg" alt="Football">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="img/ufc.png" alt="UFC">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="img/cross2.jpg" alt="Cross">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="img/rally2.png" alt="Rallye">
                            </div>
                        </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div> 
                </div><!-- fin col-lg-8 -->
            </div><!-- fin row -->

<!-- Je inc le footer et les lien JQuery, JS et bootstrap  -->
<?php require 'inc/bas_page.php'; ?>