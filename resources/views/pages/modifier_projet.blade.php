<!DOCTYPE html>
<?php
session_start();

// vérification de la session

if ($_SESSION['session'] == 'deco') {
	header('Location: back_office_connexion.php');
	exit();
}

// récupération des données

require_once('traitement/connexion_bdd.php');
$projets = $connexion->query('SELECT id_projet FROM projet')->fetchAll();
$projet = $connexion->query('SELECT nom_projet, lien_projet, contexte_projet, description_projet, date_debut_projet, date_fin_projet, bilan_projet, documentation_projet FROM projet where id_projet = ' . $_GET['id'])->fetchAll();

// vérification de l'id

$trouve = false;

for ($ind = 0; $ind < count($projets) && $trouve == false; $ind++) {
	if ($projets[$ind]['id_projet'] == $_GET['id']) {
		$trouve = true;
	}
}

if ($trouve == false) {
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
	<title>Modifier <?php echo $projet[0]['nom_projet']; ?>
	</title>
</head>

<body>
	<p class="text-center"><a class="text-dark" href="back_office.php">Retour</a></p>

	<h1 class="text-center m-5">Modification de <?php echo $projet[0]['nom_projet']; ?></h1>

	<!-- formulaire -->

	<form method="POST" class="container-fluid text-center col-md-5 col-xl-3">
		<div class="champ">
			<input type="text" name="nom" placeholder="nom du projet">
			<p><span class="actuel">actuel : <?php echo $projet[0]['nom_projet']; ?> </span></p>
		</div>

		<div class="champ">
			<input type="text" name="lien" placeholder="lien vers le projet (laisser vide si aucun)">
			<p><span class="actuel">actuel : <?php echo $projet[0]['lien_projet']; ?> </span></p>
		</div>

		<br>

		<div class="champ">
			<input type="text" name="contexte" placeholder="contexte du projet">
			<p><span class="actuel">actuel : <?php echo $projet[0]['contexte_projet']; ?> </span></p>
		</div>

		<br>

		<div class="champ">
			<input type="text" name="description" placeholder="description du projet">
			<p><span class="actuel">actuel : <?php echo $projet[0]['description_projet']; ?> </span></p>
		</div>

		<div class="champ">
			<input type="text" name="debut" placeholder="début du projet format (yyyy-mm-dd)">
			<p><span class="actuel">actuelle : <?php echo $projet[0]['date_debut_projet']; ?> </span></p>
		</div>

		<br>

		<div class="champ">
			<input type="text" name="fin" placeholder="fin du projet format (yyyy-mm-dd) (laisser vide si projet non terminé)">
			<p><span class="actuel">actuelle : <?php echo $projet[0]['date_fin_projet']; ?> </span></p>
		</div>

		<br>

		<div class="champ">
			<input type="text" name="bilan" placeholder="bilan du projet">
			<p><span class="actuel">actuel : <?php echo $projet[0]['bilan_projet']; ?> </span></p>
		</div>

		<br>

		<div class="champ documentation">
			<label for documentation>projet documenté (oui ou non)</label>

			<?php
				if($projet[0]['documentation_projet'] == 0){
					echo '<input type="checkbox" name="documentation">';
				}else{
					echo '<input type="checkbox" checked name="documentation">';
				}
			?>
		</div>

		<br>

		<input type="submit" value="valider" name="valider">

		<?php
		if (isset($_POST['valider'])) {
			if (preg_match("^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$^", $_POST['debut']) == 0 && !empty($_POST['debut'])) {
				echo "<p>La date de début saisie est invalide</p>";
			} elseif (preg_match("^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$^", $_POST['fin']) == 0 && !empty($_POST['fin'])) {
				echo "<p>La date de fin saisie est invalide</p>";
			} else {
				$modifier = $connexion->prepare('UPDATE projet set nom_projet = :nom_projet, lien_projet = :lien_projet, contexte_projet = :contexte_projet, description_projet = :description_projet, date_debut_projet = :date_debut_projet, date_fin_projet = :date_fin_projet, bilan_projet = :bilan_projet, documentation_projet = :documentation_projet where id_projet = ' . $_GET['id']);

				if (!empty($_POST['nom'])) {
					$modifier->bindParam(':nom_projet', $_POST['nom']);
				} else {
					$modifier->bindParam(':nom_projet', $projet[0]['nom_projet']);
				}

				if (!empty($_POST['lien'])) {
					$modifier->bindParam(':lien_projet', $_POST['lien']);
				} else {
					$modifier->bindParam(':lien_projet', $projet[0]['lien_projet']);
				}

				if (!empty($_POST['contexte'])) {
					$modifier->bindParam(':contexte_projet', $_POST['contexte']);
				} else {
					$modifier->bindParam(':contexte_projet', $projet[0]['contexte_projet']);
				}

				if (!empty($_POST['description'])) {
					$modifier->bindParam(':description_projet', $_POST['description']);
				} else {
					$modifier->bindParam(':description_projet', $projet[0]['description_projet']);
				}

				if (!empty($_POST['debut'])) {
					$modifier->bindParam(':date_debut_projet', $_POST['debut']);
				} else {
					$modifier->bindParam(':date_debut_projet', $projet[0]['date_debut_projet']);
				}

				if (!empty($_POST['fin'])) {
					$modifier->bindParam(':date_fin_projet', $_POST['fin']);
				} else {
					$modifier->bindParam(':date_fin_projet', $projet[0]['date_fin_projet']);
				}

				if (!empty($_POST['bilan'])) {
					$modifier->bindParam(':bilan_projet', $_POST['bilan']);
				} else {
					$modifier->bindParam(':bilan_projet', $projet[0]['bilan_projet']);
				}

				if(isset($_POST['documentation'])){
					$documentation = 1;
					$modifier->bindParam(':documentation_projet', $documentation);
				} else{
					$documentation = 0;
					$modifier->bindParam(':documentation_projet', $documentation);
				}

				$modifier->execute();
				header('Location: modifier_projet.php?id='.$_GET['id']);
				echo'<p>Vos modifications ont bien étées enregistrées</p>';
				exit();
			}
		}
		?>
	</form>

	<br>
	<p class="text-center"><a class="text-dark" href="back_office.php">Retour</a></p>

</body>

</html>