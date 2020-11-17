<!DOCTYPE html>
<html html="fr">
    <head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Roboto:300&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="css/back_office_connexion.css">
        <title>Back office</title>
    </head>
    <body>
        <h1 class="text-center titre">Connexion au back office</h1>
        <?php

            //création de la session

            session_start();
            $_SESSION['session'] = 'deco';

            //connexion à la base de données

            $servername = "mysql-lyceestvincent.alwaysdata.net";
            $username = "116313_lbruant";
            $password = "%!sRY8b?[G:}";
            $connexion = new PDO("mysql:host=$servername;dbname=lyceestvincent_lbruant", $username, $password);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $compte = $connexion->query('SELECT * FROM compte')->fetchAll();
        ?>

        <!-- formulaire -->

        <form method="POST" class="text-center">
            <input type="password" placeholder="mot de passe" name="mdp" class="col-md-3">
            <br>
            <input type="submit" value="se connecter" name="valider" class="col-md-2">
        </form>
        <?php
            
            //vérification du formulaire

            if(empty($_POST['mdp']) && isset($_POST['valider'])){
                echo'<p class="text-center">Veuillez remplir tous les champs</p>';
            }
            if(!empty($_POST['mdp']) && hash('sha1', $_POST['mdp']) !== $compte[0][0] && isset($_POST['valider'])){
                echo'<p class="text-center">Mot de passe incorrect</p>';
            }
            if(isset($_POST['valider']) && hash('sha1', $_POST['mdp']) === $compte[0][0]){
                header('Location: back_office.php');
                $_SESSION['session'] = 'co';
                exit();
            }
        ?>
    </body>
</html>