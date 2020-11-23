@extends('back_office')

@section('head')
<?php
session_start();

// vérification de la session

if($_SESSION['session'] == 'deco') {
	header('Location:' . route('back-office-connexion'));
	exit();
}

// connexion à la base de données et récupération des données

$servername = "mysql-lyceestvincent.alwaysdata.net";
$username = "116313_lbruant";
$password = "%!sRY8b?[G:}";
$connexion = new PDO("mysql:host=$servername;dbname=lyceestvincent_lbruant", $username, $password);
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$projets = $connexion->query('SELECT id_projet FROM projet')->fetchAll();
$projet = $connexion->query('SELECT * FROM projet where id_projet = ' . $_GET['id'])->fetchAll();
?>
@endsection

@section('title')
	Modifier <?php echo $projet[0]['nom_projet']; ?>
@endsection

@section('content')
<p class="text-center"><a class="btn btn-info mt-3" href="{{ route('back-office') }}">Retour</a></p>

<h1 class="text-center m-5">Modification de <?php echo $projet[0]['nom_projet']; ?></h1>

<!-- formulaire -->

<form method="POST" class="text-center col-sm-7 col-md-6 col-lg-5 col-xl-4 mx-auto">
	@csrf
	<div class="form-group">
		<input class="form-control" type="text" name="nom" placeholder="nom du projet">
		<p><span class="actuel">actuel : <?php echo $projet[0]['nom_projet']; ?> </span></p>
	</div>

	<div class="form-group">
		<input class="form-control" type="text" name="route" placeholder="route vers le projet (laisser vide si aucune)">
		<p><span class="actuel">actuel : <?php echo $projet[0]['route_projet']; ?> </span></p>
	</div>

	<div class="form-group">
		<textarea class="form-control" name="contexte" placeholder="contexte du projet"></textarea>
		<p><span class="actuel">actuel : <?php echo $projet[0]['contexte_projet']; ?> </span></p>
	</div>

	<div class="form-group">
		<textarea class="form-control" name="description" placeholder="description du projet"></textarea>
		<p><span class="actuel">actuel : <?php echo $projet[0]['description_projet']; ?> </span></p>
	</div>

	<div class="form-group">
		<input class="form-control" type="text" name="debut" placeholder="début du projet format (yyyy-mm-dd)">
		<p><span class="actuel">actuelle : <?php echo $projet[0]['date_debut_projet']; ?> </span></p>
	</div>

	<div class="form-group">
		<input class="form-control" type="text" name="fin" placeholder="fin du projet format (yyyy-mm-dd) (laisser vide si projet non terminé)">
		<p><span class="actuel">actuelle : <?php echo $projet[0]['date_fin_projet']; ?> </span></p>
	</div>

	<div class="form-group">
		<textarea class="form-control" name="bilan" placeholder="bilan du projet"></textarea>
		<p><span class="actuel">actuel : <?php echo $projet[0]['bilan_projet']; ?> </span></p>
	</div>

	<div class="form-check">
		<input type="checkbox" class="form-check-input" name="documentation"
		<?php 
		if($projet[0]['documentation_projet'] == 1){
			echo ' checked';
		}
		?>
		>
		<label for="documentation" class="form-check-label">projet documenté (oui ou non)</label>
	</div>

	<br>

	<button type="submit" class="btn btn-primary" name="valider">Valider</button>

	<p class="text-center"><a class="btn btn-info mt-3" href="{{ route('back-office') }}">Retour</a></p>

	<?php
	if (isset($_POST['valider'])) {
		if (preg_match("^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$^", $_POST['debut']) == 0 && !empty($_POST['debut'])) {
			echo "<p>La date de début saisie est invalide</p>";
		} elseif (preg_match("^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$^", $_POST['fin']) == 0 && !empty($_POST['fin'])) {
			echo "<p>La date de fin saisie est invalide</p>";
		} else {
			$modifier = $connexion->prepare('UPDATE projet set nom_projet = :nom_projet, route_projet = :route_projet, contexte_projet = :contexte_projet, description_projet = :description_projet, date_debut_projet = :date_debut_projet, date_fin_projet = :date_fin_projet, bilan_projet = :bilan_projet, documentation_projet = :documentation_projet where id_projet = ' . $_GET['id']);

			if (!empty($_POST['nom'])) {
				$modifier->bindParam(':nom_projet', $_POST['nom']);
			} else {
				$modifier->bindParam(':nom_projet', $projet[0]['nom_projet']);
			}

			if (!empty($_POST['route'])) {
				$modifier->bindParam(':route_projet', $_POST['route']);
			} else {
				$modifier->bindParam(':route_projet', $projet[0]['route_projet']);
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
			header('Location:'.route('modifier-projet').'?id=' . $_GET['id']);
			echo'<p>Vos modifications ont bien étées enregistrées</p>';
			exit();
		}
	}
	?>
</form>
@endsection