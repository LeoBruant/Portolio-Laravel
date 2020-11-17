@extends('base')

@section('title')
	Léo Bruant | Portfolio
@endsection

@section('head')
	<link rel="stylesheet" href="css/home.css">

	<?php
		// connexion à la base de données

        $servername = "mysql-lyceestvincent.alwaysdata.net";
        $username = "116313_lbruant";
        $password = "%!sRY8b?[G:}";
        $connexion = new PDO("mysql:host=$servername;dbname=lyceestvincent_lbruant", $username, $password);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	?>
@endsection

@section('content')

<!-- barre de navigation -->

<nav id="navbar" class="navbar fixed-top navbar-dark">
	<ul class="nav navbar-nav">
		<li class="nav-item dropdown">
			<a class="nav-link" v-on:click="show=!show"><i class="fas fa-bars fa-2x"></i></a>
			<transition name="fade">
				<div class="dropdown-menu col-3 col-lg-2 bg-light" v-if="show">
					<a class="dropdown-item" href="#nav_projets">Mes réalisations</a>
					<a class="dropdown-item" href="#nav_parcours">Mon parcours</a>
					<a class="dropdown-item" href="#nav_contact">Me contacter</a>
				</div>
			</transition>
		</li>
	</ul>
</nav>

<!-- presentation -->

<header id="header">
	<div class="presentation text-center col-11 text-light">
		<h1 class="nom">LEO BRUANT</h1>
		<h3 class="description">Etudiant en BTS-SIO au lycée Saint-Vincent à Senlis</h3>
		<a href="fichiers/Leo BRUANT.pdf" class="lien_cv text-light" target="_blank">Voir le CV</a>
		<br><br>
		<div class="reseaux">
			<a href="https://github.com/LeoBruant?tab=repositories" target="blank" title="Ma page Github"><i class="fab fa-github fa-3x"></i></a>
			<a href="https://www.linkedin.com/in/l%C3%A9o-bruant-3870321bb/" target="blank" title="Ma page Linkedin"><i class="fab fa-linkedin fa-3x"></i></a>
		</div>
		<br>
		<p class="email">adresse de contact: <a href="mailto:bruantleo@gmail.com" class="text-light">bruantleo@gmail.com</a></p>
	</div>
</header>

<!-- main -->

<main id="main" class="text-center">

	<!-- réalisations -->

	<span id="nav_projets"></span>
	<section id="projets" class="section bg-light text-center">
		<div class="col-11 contenu_projets">
			<div class="navigation border-bottom border-dark">
				<h2 class="col-12">Mes réalisations</h2>
			</div>
			<div class="diapo">
				<div id="diaporama" class="carousel slide" data-ride="carousel" data-interval="3000">

					<!-- indicateurs du carousel -->

					<ol class="carousel-indicators">
						<li data-target="#diaporama" data-slide-to="0" class="active bg-dark"></li>
						@php
						$projets = $connexion->query('SELECT * FROM projet')->fetchAll();

						for ($nb_projets = 0; $nb_projets < count($projets) - 1; $nb_projets++) {
							echo '<li data-target="#diaporama" data-slide-to="' . ($nb_projets + 1) . '" class="bg-dark"></li>';
						}
						@endphp
					</ol>

					<!-- flèches du carousel -->

					<div>
						<a class="carousel-control-prev text-dark" href="#diaporama" data-slide="prev">
							<i class="fa fa-chevron-left fa-5x"></i>
						</a>
					</div>
					<div>
						<a class="carousel-control-next text-dark" href="#diaporama" data-slide="next">
							<i class="fa fa-chevron-right fa-5x"></i>
						</a>
					</div>

					<!-- slides du carousel -->

					<div class="carousel-inner">
						@php

						// affichage des réalisations

						for ($nb_projets = 0; $nb_projets < count($projets); $nb_projets++) {

							echo '<div class="carousel-item';

							if ($nb_projets == 0) {
								echo ' active';
							}

							echo '">
									<div class="titre_projet">
										<h3 class="col-12">
											<a href= "' . route("fiche-projet").'?id=' . $projets[$nb_projets]['id_projet'] . '" class="text-dark" target="blank">' . $projets[$nb_projets]['nom_projet'] . '</a>
										</h3>
									</div>
								</div>
							';
						}
						@endphp
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- parcours -->

	<span id="nav_parcours"></span>
	<section id="parcours">
		<div class="container col-11">
			<div class="navigation border-bottom border-light text-light">
				<h2 class="col-12">Mon parcours</h2>
			</div>
			<ul class="timeline">
				<li>
					<div class="tl-circ"></div>
					<div class="timeline-panel">
						<div class="tl-heading">
							<h4><a href="http://www.lyc-baudelaire-fosses.ac-versailles.fr" target="blank" title="Lien vers le site du lycée Charles Baudelaire à Fosses">Première/Terminale scientifique</a></h4>
							<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>Septembre 2016 - Juin 2019</small></p>
						</div>
						<div class="tl-body">
						</div>
					</div>
				</li>
				<li>
					<div class="tldate">2019</div>
				</li>
				<li class="timeline-inverted">
					<div class="tl-circ"></div>
					<div class="timeline-panel">
						<div class="tl-heading">
							<h4><a href="http://enseignement-superieur.lycee-stvincent.fr/" target="blank" title="Lien vers le site du lycée Saint Vincent">BTS-SIO option slam 1ère année</a></h4>
							<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> Septembre 2019 - Juin 2020</small></p>
							<p><i class="glyphicon glyphicon-time"></i><span class="competences">Compétences aquises :</span><br>
								<br>- HTML5
								<br>- CSS3
								<br>- PHP7
								<br>- C#
								<br>- Python
								<br>
								<br>- Bootstrap
								<br>- jQuery
								<br>
								<br>- GIT
							</p>
						</div>
						<div class="tl-body">
						</div>
					</div>
				</li>
				<li>
					<div class="tldate">2020</div>
				</li>
				<li>
					<div class="tl-circ"></div>
					<div class="timeline-panel">
						<div class="tl-heading">
							<h4><a href="http://enseignement-superieur.lycee-stvincent.fr/" target="_blank" title="Lien vers le site du lycée Saint Vincent">BTS-SIO option slam 2ème année</a></h4>
							<p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> Septembre 2020 - Juin 2021</small></p>
							<p><i class="glyphicon glyphicon-time"></i><span class="competences">Compétences aquises :</span><br>
								<br>- Symfony
								<br>- Laravel
								<br>- Vue.js
								<br>
								<br>- Développement en couches C#
							</p>
						</div>
						<div class="tl-body">
						</div>
					</div>
				</li>
			</ul>
		</div>
	</section>

	<!-- contact -->

	<span id="nav_contact"></span>
	<section id="contact" class="bg-light">
		<div class="col-11 contenu_contact">
			<div class="navigation border-bottom border-dark text-dark">
				<h2 class="col-12">Me contacter</h2>
			</div>
			<form method="POST">
				<input type="text" placeholder="nom" name="nom" class="col-12 col-sm-10 form-control">
				<input type="text" placeholder="prenom" name="prenom" class="col-12 col-sm-10 form-control">
				<input type="email" placeholder="email" name="email" class="col-12 col-sm-10 form-control">
				<textarea placeholder="Votre message" name="message" class="col-12 col-sm-10 form-control"></textarea>
				<br>
				<input type="submit" name="valider" value="envoyer" class="col-12 col-sm-10 valider btn btn-dark">
			</form>

			@php
			if (isset($_POST['valider'])) {
				if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['message'])) {

					$query = $connexion->prepare('INSERT INTO contact (nom_contact, prenom_contact, email_contact, message_contact) VALUES (:nom, :prenom, :email, :message)');

					$query->bindParam(':nom', $_POST["nom"]);
					$query->bindParam(':prenom', $_POST["prenom"]);
					$query->bindParam(':email', $_POST["email"]);
					$query->bindParam(':message', $_POST["message"]);

					$query->execute();
				} else {
					echo '<p class="text-center text-danger">Veuillez remplir tous les champs</p>';
				}
			}
			@endphp
		</div>
	</section>
</main>

<script>
	var vm = new Vue({
		el: ".dropdown",
		data: {
			show: false
		}
	})
</script>
@endsection