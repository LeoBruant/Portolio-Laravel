@extends('base')

@section('head')
	<link rel="stylesheet" href="css/fiche_projet.css">

	<?php
		// connexion à la base de données

        $servername = "mysql-lyceestvincent.alwaysdata.net";
        $username = "116313_lbruant";
        $password = "%!sRY8b?[G:}";
        $connexion = new PDO("mysql:host=$servername;dbname=lyceestvincent_lbruant", $username, $password);
		$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		// récupération des données du projet

		$projet = $connexion->query('SELECT * FROM projet where id_projet = ' . $_GET['id'])->fetchAll();
		$technos_projet = $connexion->query('SELECT * FROM technos_' . $_GET['id'])->fetchAll();
	?>
@endsection

@section('title')
	Fiche projet <?php echo $projet[0]['nom_projet']; ?>
@endsection

@section('content')
	<!-- header -->

	<header id="header" class="text-center text-light">
		<div class="projet col-12">
			<h1 class="titre"><?php echo $projet[0]['nom_projet']; ?></h1>
			<?php
			if (!empty($projet[0]['route_projet'])) {
				echo '<a href="' . route($projet[0]['route_projet']) . '" target="_blank" class="lien_projet text-light">Lien vers le projet</a>';
			}
			?>
		</div>
	</header>

	<main>

		<!-- main -->

		<div id="main" class="text-center text-dark col-md-10 col-xl-8">

			<!-- contexte -->

			<section class="section contexte">
				<h2 class="rubriques">Contexte</h2>
				<p class="col-lg-8"><?php echo $projet[0]['contexte_projet']; ?></p>
			</section>

			<!-- description -->

			<section class="section description">
				<h2 class="rubriques">Description</h2>
				<p class="col-lg-8"><?php echo $projet[0]['description_projet']; ?></p>
			</section>

			<!-- technos -->

			<section class="section technos">
				<h2 class="rubriques">Technos utilisées</h2>
				<?php
				for ($ind = 0; $ind < count($technos_projet); $ind++) {
					$technos = $connexion->query('SELECT * FROM technos where id_techno = ' . $technos_projet[$ind]['techno'])->fetchAll();

					echo '
					<i alt="' . $technos[0]['nom_techno'] . '" title="' . $technos[0]['nom_techno'] . '" class="fab fa-' . $technos[0]['image_techno'] . ' fa-10x technos_images"></i>
				';
				}
				?>
			</section>

			<!-- periode -->

			<section class="section periode">
				<h2 class="rubriques">Période de réalisation</h2>
				<p class="col-lg-8">Le projet a commencé le <?php echo $projet[0]['date_debut_projet']; ?> et
					<?php
					if (empty($projet[0]['date_fin_projet'])) {
						echo 'est encore en cours de réalisation.</p>';
					} else {
						echo 'a été terminé le ' . $projet[0]['date_fin_projet'] . '.</p>';
					}
					?>
			</section>

			<!-- captures -->

			<section class="section captures">
				<h2 class="rubriques">Captures d'écran</h2>
				<div class="diapo">
					<div id="diaporama" class="carousel slide col-lg-10" data-ride="carousel" data-interval="3000">

						<!-- indicateurs du carousel -->

						<ol class="carousel-indicators">
							<li data-target="#diaporama" data-slide-to="0" class="active bg-dark"></li>
							<li data-target="#diaporama" data-slide-to="1" class="bg-dark"></li>
							<li data-target="#diaporama" data-slide-to="2" class="bg-dark"></li>
						</ol>

						<!-- images du carousel -->

						<div class="carousel-inner">
							<div class="carousel-item active">
								<img src="images/<?php echo $projet[0]['nom_projet']; ?>/capture1.jpg" class="d-block w-100" data-toggle="modal" data-target="#modal1" alt="capture 1">
							</div>
							<div class="carousel-item">
								<img src="images/<?php echo $projet[0]['nom_projet']; ?>/capture2.jpg" class="d-block w-100" data-toggle="modal" data-target="#modal2" alt="capture 2">
							</div>
							<div class="carousel-item">
								<img src="images/<?php echo $projet[0]['nom_projet']; ?>/capture3.jpg" class="d-block w-100" data-toggle="modal" data-target="#modal3" alt="capture 3">
							</div>
						</div>

						<!-- flèches du carousel -->

						<a class="carousel-control-prev text-dark" href="#diaporama" data-slide="prev">
							<span class="fa fa-chevron-left fa-5x"></span>
						</a>
						<a class="carousel-control-next text-dark" href="#diaporama" data-slide="next">
							<span class="fa fa-chevron-right fa-5x"></span>
						</a>
					</div>

					<!-- modals du carousel -->

					<div class="modal fade" id="modal1">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-body">
									<img src="images/<?php echo $projet[0]['nom_projet']; ?>/capture1.jpg">
								</div>
							</div>
						</div>
					</div>
					<div class="modal fade" id="modal2">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-body">
									<img src="images/<?php echo $projet[0]['nom_projet']; ?>/capture2.jpg">
								</div>
							</div>
						</div>
					</div>
					<div class="modal fade" id="modal3">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-body">
									<img src="images/<?php echo $projet[0]['nom_projet']; ?>/capture3.jpg">
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<!-- bilan -->

			<section class="section">
				<h2 class="rubriques">Bilan</h2>
				<p><?php echo $projet[0]['bilan_projet']; ?></p>
			</section>

			<?php
				if($projet[0]['documentation_projet'] == 1){
					echo'
						<!-- documentation -->

						<section id="documentation" class="section">
							<h2 class="rubriques">Documentation</h2>
							<p><a href="documentation/'.$projet[0]['nom_projet'].'/dossier_fonctionnel.pdf" target="_blank">Accéder à la documentation fonctionnelle</a></p>
							<p><a href="documentation/'.$projet[0]['nom_projet'].'/dossier_technique.pdf" target="_blank">Accéder à la documentation technique</a></p>
							<p><a href="documentation/'.$projet[0]['nom_projet'].'/fixtures.sql" target="_blank">Télécharger le fichier fixtures.sql</a></p>
						</section>
					';
				}
			?>
		</div>
	</main>
@endsection