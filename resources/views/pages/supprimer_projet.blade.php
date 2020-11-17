<!DOCTYPE html>
<?php
    session_start();
    
    // vérification de la session
            
        if($_SESSION['session'] == 'deco'){
            header('Location: back_office_connexion.php');
            exit();
        }

    // récupération des données

    require_once('traitement/connexion_bdd.php');
    $projet = $connexion->query('SELECT id_projet, nom_projet FROM projet where id_projet = '.$_GET['id'])->fetchAll();
?>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300&display=swap" rel="stylesheet">
        <title>Supprimer 
        <?php echo $projet[0]['nom_projet']; ?>
        </title>
    </head>
    <body>
        <h1 class="text-center m-5">Êtes-vous sûr(e) de supprimer <?php echo $projet[0]['nom_projet']; ?> ?</h1>

        <!-- formulaire -->

        <form method="POST" class="container-fluid text-center">
            <input class="col-xl-2 btn btn-danger" type="submit" name="oui" value="oui"></input>
            <input class="col-xl-2 btn btn-secondary" type="submit" name="non" value="non"></input>
        </form>
        <?php

            // suppression du projet

            if(isset($_POST['oui'])){
                $query = $connexion->prepare('DELETE FROM projet WHERE id_projet = '.$projet[$_GET['id']]['id_projet']);
                $query->execute();
                header('Location: back_office.php');
                exit();
            }

            // retour au back office

            elseif(isset($_POST['non'])){
                header('Location: back_office.php');
                exit();
            }
        ?>
    </body>
</html>