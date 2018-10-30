
<?php 
require 'connexion.php'; 


$order = '';
if(isset($_GET['order']) && isset($_GET['column'])){

	if($_GET['column'] == 'competence'){$order = ' ORDER BY competence';}
	elseif($_GET['column'] == 'niveau'){$order = ' ORDER BY niveau';}
	elseif($_GET['column'] == 'categorie'){$order = ' ORDER BY categorie';}
	if($_GET['order'] == 'asc'){$order.= ' ASC';}
	elseif($_GET['order'] == 'desc'){$order.= ' DESC';}
}


// Inclusion des liens cdn (bootstrap, fonts ...) et header depuis DOCTYPE
require 'inc/haut_page.php';
?>
    <!-- Style animation -->
    <link rel="stylesheet" href="css/style2.css">
    <title>Akbar KHAN : competences</title>
</head>
<body>
<main>
    <?php
    require_once 'inc/navigation.php';
    ?>
    
    
    
    <?php
    // requête pour compter et cherhcer plusieurs enregistrements
    $sql = $pdoCV -> prepare("SELECT * FROM t_competences $order");
    $sql -> execute();
    ?>
    
    
        <div class="header jumbotron-fluid jumbotron">
            <h1 class="mb-4">Mes compétences en web <i class="fas fa-code"></i></h1>
        </div>
    


        <!-- ************ ANIMATION ************* -->

    <!-- Début test animation -->
    <div class="row">
        <h1>Animation de niveau avec cercle</h1>
        <p>Scrollez pour voir ...</p>
    </div>

    <!-- debut section -->
    <!-- <div class="arrow down"></div> -->
    <section class="row"> 
        
            <?php 
                while($ligne_competence = $sql -> fetch()) {
                // var_dump($ligne_competence);
                // foreach($ligne_competence as $value) {
            ?>
    <div class="col-3">
            <!-- cercle 1 -->
            <h3 class="competence"><?= $ligne_competence['competence']; ?></h3>
            <svg class="radial-progress" data-percentage="82" viewBox="0 0 80 80">
                <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 39.58406743523136;"></circle>
                <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)"><?= $ligne_competence['niveau']; ?>%</text>
            </svg> 
        </div>
        <?php 
            // }
        } // Fin de la boucle while
    ?>

    </section>

    

   


    <!-- <div class="arrow up"></div> -->
    </main>
    <!-- lien CDN jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script> 

    <!-- lienn script perso -->
    <script>
    
    $(function(){

// Remove svg.radial-progress .complete inline styling
$('svg.radial-progress').each(function( index, value ) { 
    $(this).find($('circle.complete')).removeAttr( 'style' );
});

// Activate progress animation on scroll
$(window).scroll(function(){
    $('svg.radial-progress').each(function( index, value ) { 
        // If svg.radial-progress is approximately 25% vertically into the window when scrolling from the top or the bottom
        if ( 
            $(window).scrollTop() > $(this).offset().top - ($(window).height() * 0.75) &&
            $(window).scrollTop() < $(this).offset().top + $(this).height() - ($(window).height() * 0.25)
        ) {
            // Get percentage of progress
            percent = $(value).data('percentage');
            // Get radius of the svg's circle.complete
            radius = $(this).find($('circle.complete')).attr('r');
            // Get circumference (2πr)
            circumference = 2 * Math.PI * radius;
            // Get stroke-dashoffset value based on the percentage of the circumference
            strokeDashOffset = circumference - ((percent * circumference) / 100);
            // Transition progress for 1.25 seconds
            $(this).find($('circle.complete')).animate({'stroke-dashoffset': strokeDashOffset}, 1250);
        }
    });
}).trigger('scroll');

});
    
    </script>





</main>
<?php
// require_once 'inc/bas_page.php';