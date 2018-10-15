<?php require 'connexion.php';

// Insertion d'un loisir en BDD
if (isset($_POST['loisir']) && $_POST['loisir'] != '') // Si on à reçu un nouveau loisir
{
    $loisir = addslashes ($_POST['loisir']);
    $pdoCV -> exec(" INSERT INTO t_loisirs VALUES (NULL, '$loisir', '1')");

    header("location: ../admin/loisirs.php");
     
    exit();     
}// ferme le if isset $_POST

// Suppression d'un élément(ici : loisir) de la BDD
if (isset($_GET['id_loisir'])) // On récupére ce que je supprime dans l'url par son id
{
    $efface = $_GET['id_loisir']; // je passe l'id dans une variable $efface
    $sql = " DELETE FROM t_loisirs WHERE id_loisir='$efface' "; // Requête pur supprimer un élément de la BDD

    $pdoCV -> query($sql); // On peut le faire avec exec() également

    header("location: ../admin/loisirs.php");
}// ferme le if isset $_GET pour suppression

?>
<!-- Je inc le footer et les lien JQuery, JS et bootstrap  -->
<?php require 'inc/haut_page.php'; ?>


<?php require 'inc/navigation.php';?> 


    <div class="text-center table-responsive table-hover mt-4">
        <h1 class="text-center mb-4">Les loisirs et insertion d'un nouveau loisir</h1>
            <?php 
                // Requête pour compter et chercher plusieurs enregistrements on ne peut compter qui si on a préparer(avec : prepare) la rrequête
                $sql = $pdoCV -> prepare("SELECT * FROM t_loisirs");
                $sql -> execute();
                $nbr_loisirs = $sql -> rowCount();
            ?>
        
            
            <table class="table table-bordered mx-auto">
            <caption>La liste des loisirs : <?php echo $nbr_loisirs; ?></caption>
                <thead class="thead-dark">
                    <tr>
                        <th>Loisirs</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>        
                </thead>
                <?php 
                while($ligne_loisir = $sql -> fetch())
                    {
                ?>
                <tbody>
                    <tr>
                        <td class="td"><?php echo $ligne_loisir['loisir']; ?></td>
                        <td>
                            <a class="href" href="modif_loisir.php?id_loisir=<?php echo $ligne_loisir['id_loisir']; ?> "><i class="fas fa-edit"></i></a> 
                        </td>
                        <td class="td">
                            <a class="href" href="loisirs.php?id_loisir=<?php echo $ligne_loisir['id_loisir']; ?>"><i class="fas fa-trash-alt text-danger"></i></a> 
                        </td>
                    </tr>
                <?php 
                    } 
                ?>
                </tbody>
            </table>
            
            <hr>
            <h2 class="text-center">Formulaire d'insertion d'un loisir</h2>
            <!-- Insertion d'un nouveau loisir -->
            <div class="formulaire">
                <form action="loisirs.php" method="post">
                    <div class="form-group">
                        <label for="loisir">Loisir</label>
                        <input type="text" name="loisir" placeholder="Nouveau loisir" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Insérer un loisir</button>
                    </div>
                </form>
            </div>

    </div> 

<!-- Je inc le footer et les lien JQuery, JS et bootstrap  -->
<?php require 'inc/bas_page.php'; ?>