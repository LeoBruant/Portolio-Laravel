<!DOCTYPE html>
<?php
	session_start();

	// vérification de la session

		if($_SESSION['session'] == 'deco'){
			header('Location: back_office_connexion.php');
			exit();
		}

	// connexion à la base de donnée

    require_once('traitement/connexion_bdd.php');

	// vérification de l'id

	$trouve = false;

	for($ind = 0; $ind < count($projets) && $trouve == false; $ind++){
		if($projets[$ind]['id_projet'] == $_GET['id']){
			$trouve = true;
		}
	}

	if($trouve == false){
		header('Location: 404.php');
		exit();
	}
?>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/modifier_projet.css">
        <title>Ajouter un projet</title>
    </head>
    <body>
        <h1 class="text-center m-5">Ajouter un projet</h1>

		<?php

            // vérification de la session

            if($_SESSION['session'] === 'deco'){
                header('Location: back_office_connexion.php');
                exit();
            }
            require_once('traitement/connexion_bdd.php');
			$projets = $connexion->query('SELECT * FROM projet')->fetchAll();
		?>

        <!-- formulaire -->

        <form method="POST" class="container-fluid text-center col-md-5 col-xl-3">
			<div class="champ">
				<input type="text" name="nom" placeholder="nom du projet">
			</div>
			<div class="champ">
				<input type="text" name="lien" placeholder="lien du projet">
			</div>
			<div class="champ">
				<input type="text" name="contexte" placeholder="contexte du projet">
			</div>
			<div class="champ">
				<input type="text" name="description" placeholder="description du projet">
			</div>
			<div class="champ">
				<input type="text" name="debut" placeholder="début du projet format (yyyy-mm-dd)">
			</div>
			<div class="champ">
				<input type="text" name="fin" placeholder="fin du projet format (yyyy-mm-dd)">
			</div>
			<div class="champ">
				<input type="text" name="bilan" placeholder="bilan du projet">
			</div>
			<input type="submit" value="valider" name="valider">

			<?php
				if (isset($_POST['valider'])){
					if(empty($_POST['nom']) && empty($_POST['lien']) && empty($_POST['contexte']) && empty($_POST['description']) && empty($_POST['debut']) && empty($_POST['fin']) && empty($_POST['bilan'])){
						echo "<p>Veuillez remplir au moins un champ</p>";
					}
					elseif(preg_match("^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$^", $_POST['debut']) == 0 && !empty($_POST['debut'])){
						echo "<p>La date de début saisie est invalide</p>";
					}
					elseif(preg_match("^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$^", $_POST['fin']) == 0 && !empty($_POST['fin'])){
						echo "<p>La date de fin saisie est invalide</p>";
					}
					else{
						$modifier = $connexion->prepare('UPDATE projet set nom_projet = :nom_projet, lien_projet = :lien_projet, contexte_projet = :contexte_projet, description_projet = :description_projet, date_debut_projet = :date_debut_projet, date_fin_projet = :date_fin_projet, bilan_projet = :bilan_projet where id_projet = '.$_GET['id']);

						if(!empty($_POST['nom'])){
							$modifier->bindParam(':nom_projet', $_POST['nom']);
						}
						else{
							$modifier->bindParam(':nom_projet', $projet[0]['nom_projet']);
						}
						if(!empty($_POST['lien'])){
							$modifier->bindParam(':lien_projet', $_POST['lien']);
						}
						else{
							$modifier->bindParam(':lien_projet', $projet[0]['lien_projet']);
						}
						if(!empty($_POST['contexte'])){
							$modifier->bindParam(':contexte_projet', $_POST['contexte']);
						}
						else{
							$modifier->bindParam(':contexte_projet', $projet[0]['contexte_projet']);
						}
						if(!empty($_POST['description'])){
							$modifier->bindParam(':description_projet', $_POST['description']);
						}
						else{
							$modifier->bindParam(':description_projet', $projet[0]['description_projet']);
						}
						if(!empty($_POST['debut'])){
							$modifier->bindParam(':date_debut_projet', $_POST['debut']);
						}
						else{
							$modifier->bindParam(':date_debut_projet', $projet[0]['date_debut_projet']);
						}
						if(!empty($_POST['fin'])){
							$modifier->bindParam(':date_fin_projet', $_POST['fin']);
						}
						else{
							$modifier->bindParam(':date_fin_projet', $projet[0]['date_fin_projet']);
						}
						if(!empty($_POST['bilan'])){
							$modifier->bindParam(':bilan_projet', $_POST['bilan']);
						}
						else{
							$modifier->bindParam(':bilan_projet', $projet[0]['bilan_projet']);
						}

						$modifier->execute();
						header('Location: back_office.php');
						exit();
					}
				}
			?>
		</form>
    </body>
</html>