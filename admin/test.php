<?php require 'connexion.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php 
    $sql = $pdoCV->query(" SELECT * FROM t_users ");
    $line_user = $sql->fetch();

    
    ?>
    <title>Admin : <?php echo $line_user['pseudo']; ?></title>
    <link rel="stylesheet" href="test_style.css">
</head>
<body>
    <h1>Test en cours</h1>
    <?php echo $line_user['first_name']; ?>
    
</body>
</html>