<?php require 'connexion.php';?>
  <!-- Footer--> 
      <hr>
      <footer class="text-center p-2">
        <div class="row">
            <div class="col-lg-6">
            <h4 style="color: gold">Me contacter</h4>
                <p>Téléphone : <i style="color: #1682c9"><strong><?php echo $ligne_utilisateur['portable'];?></strong></i></p>
                <p>Email : <a href="messages.php" target="_blank" ><i style="color: #1682c9"><strong><?php echo $ligne_utilisateur['email'];?></strong></i></a></p>
            </div>
            <div class="col-lg-6">
            <h4 style="color: gold">Réseaux</h4>
                <p class="reseaux">
                    <a style="color: white" href="https://github.com/DamienThiago93230" target="_blank"><i class="fab fa-github"></i></a>
                    <a href="https://www.linkedin.com/in/damien-santo-58418a169/" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                </p>
            </div>
        </div><!-- Fin .row -->
        <div class="col-lg-12">
            <p style="color: #1682c9">Copyright &copy; Mon siteCV - 2018</p>
        </div>
    </footer>
</div> <!-- Fin container-fluid -->
  <!-- lien bootstrap -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>