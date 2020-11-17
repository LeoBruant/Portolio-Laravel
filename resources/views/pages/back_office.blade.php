<!DOCTYPE html>
<?php
    session_start();
    
    // vérification de la session

        if($_SESSION['session'] === 'deco'){
            header('Location: back_office_connexion.php');
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

            // récupération des données

            require_once('traitement/connexion_bdd.php');
			$projet = $connexion->query('SELECT * FROM projet')->fetchAll();
		?>
		
		<!-- retour -->

		<div class="retour"><a href="index.php">Retour</a></div>

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

                // affichage du titre de la réalisation

                for($ind = 0; $ind < count($projet); $ind++){
                    echo'<tr>
                        <th scope="row">'.($ind+1).'</th>
                        <td>';
                        for ($i = 0; $i < strlen($projet[$ind]['nom_projet']); $i++) {

                            // si le caractère est un tiret

                            if ($projet[$ind]['nom_projet'][$i] == "_" && $projet[$ind]['nom_projet'][$i + 1] != "_") {
                                if ($i >= 0) {
                                    if ($projet[$ind]['nom_projet'][$i - 1] != "_") {
                                        echo ' ';
                                    } elseif ($projet[$ind]['nom_projet'][$i] == "_") {
                                        if ($i >= 1) {
                                            if ($projet[$ind]['nom_projet'][$i - 1] == "_") {
                                                echo '\'';
                                            }
                                        }
                                    } else {
                                        echo $projet[$ind]['nom_projet'][$i];
                                    }
                                }

                                // si deux caractères à la suite sont un tiret

                            } elseif ($projet[$ind]['nom_projet'][$i] == "_") {
                                if ($i >= 1) {
                                    if ($projet[$ind]['nom_projet'][$i - 1] == "_") {
                                        echo '\'';
                                    }
                                }
                            }

                            // sinon

                            else {
                                echo $projet[$ind]['nom_projet'][$i];
                            }
                        }

                        echo'</td>
                        <td>'.$projet[$ind]['description_projet'].'</td>
                        <td>'.$projet[$ind]['date_debut_projet'].'</td>
                        <td>'.$projet[$ind]['date_fin_projet'].'</td>
                        <td><a href="modifier_projet.php?id='.$projet[$ind]['id_projet'].'" class="bouton modifier">modifier projet</a></td>
                        <td><a href="supprimer_projet.php?id='.$projet[$ind]['id_projet'].'" class="bouton supprimer">supprimer projet</a></td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>

        <!-- retour -->

		<div class="retour"><a href="index.php">Retour</a></div>
    </body>
</html>