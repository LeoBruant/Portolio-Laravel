@extends('back_office')

@section('head')
<?php

session_start();

// vérification de la session

if($_SESSION['session'] == 'deco'){
    header('Location: ' . route('connexion-back-office'));
    exit();
}

//connexion à la base de données et récupération des données

$servername = "mysql-lyceestvincent.alwaysdata.net";
$username = "116313_lbruant";
$password = "%!sRY8b?[G:}";
$connexion = new PDO("mysql:host=$servername;dbname=lyceestvincent_lbruant", $username, $password);
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$projet = $connexion->query('SELECT * FROM projet')->fetchAll();
?>
@endsection

@section('title')
    Back office
@endsection

@section('content')

<div class="col-xl-11 text-center mx-auto">

    <!-- retour -->

    <div class="m-3"><a href="{{ route('home') }}" class="btn btn-info">Retour</a></div>

    <!-- projets -->

    <table class="table">
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
                    <td><a href="'.route('modifier-projet').'?id='.$projet[$ind]['id_projet'].'" class="btn btn-primary modifier">modifier projet</a></td>
                    <td><a href="'.route('supprimer-projet').'?id='.$projet[$ind]['id_projet'].'" class="btn btn-danger supprimer">supprimer projet</a></td>
                </tr>';
            }
            ?>
        </tbody>
    </table>

    <!-- retour -->

    <div class="m-3"><a href="{{ route('home') }}" class="btn btn-info">Retour</a></div>
</div>
@endsection