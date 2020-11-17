<!DOCTYPE html>
<?php
session_start();

// vérification de la session

    if($_SESSION['session'] === 'deco'){
        header('Location: ' . route('back-office-connexion'));
        exit();
    }
?>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/back_office.css">
	<title>Back office</title>
    </head>
    <body>
        <?php

        //connexion à la base de données et récupération des données

        $servername = "mysql-lyceestvincent.alwaysdata.net";
        $username = "116313_lbruant";
        $password = "%!sRY8b?[G:}";
        $connexion = new PDO("mysql:host=$servername;dbname=lyceestvincent_lbruant", $username, $password);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $projet = $connexion->query('SELECT * FROM projet')->fetchAll();
		?>
		
		<!-- retour -->

    <div class="retour"><a href="{{ route('accueil') }}">Retour</a></div>

        <!-- projets -->

        <table class="table container-fluid col-xl-10">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">nom</th>
                    <th scope="col">description</th>
                    <th scope="col">date de début</th>
                    <th scope="col">date de fin</th>
                </tr>
            </thead>
            <tbody>
                <?php

                // affichage des réalisations

                for($ind = 0; $ind < count($projet); $ind++){
                    echo'<tr>
                        <th scope="row">'.($ind+1).'</th>
                        <td>'.$projet[$ind]['nom_projet'].'</td>
                        <td>'.$projet[$ind]['description_projet'].'</td>
                        <td>'.$projet[$ind]['date_debut_projet'].'</td>
                        <td>'.$projet[$ind]['date_fin_projet'].'</td>
                        <td><a href="'.route('modifier-projet').'?id='.$projet[$ind]['id_projet'].'" class="bouton modifier">modifier projet</a></td>
                        <td><a href="'.route('supprimer-projet').'?id='.$projet[$ind]['id_projet'].'" class="bouton supprimer">supprimer projet</a></td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>

        <!-- retour -->

		<div class="retour"><a href="{{ route('accueil') }}">Retour</a></div>
    </body>
</html>