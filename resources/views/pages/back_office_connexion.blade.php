
@extends('back_office')

@section('head')
<?php

//création de la session

session_start();
$_SESSION['session'] = 'deco';

//connexion à la base de données et récupération des données

$servername = "mysql-lyceestvincent.alwaysdata.net";
$username = "116313_lbruant";
$password = "%!sRY8b?[G:}";
$connexion = new PDO("mysql:host=$servername;dbname=lyceestvincent_lbruant", $username, $password);
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$compte = $connexion->query('SELECT * FROM compte')->fetchAll();
?>
@endsection

@section('title')
    Connexion au back office
@endsection

@section('content')
<div class="container col-md-5 col-lg-4 text-center">
    <h1 class="m-5">Connexion au back office</h1>

    <!-- formulaire -->

    <form method="POST">
        @csrf
        <div class="form-group">
            <input type="password" placeholder="mot de passe" name="mdp" class="form-control">
        </div>
        <button type="submit" name="valider" class="btn btn-primary mb-5">Se connecter</button>
    </form>
</div>

<?php
    
//vérification du formulaire

if(empty($_POST['mdp']) && isset($_POST['valider'])){
    echo'<p class="text-center">Veuillez remplir tous les champs</p>';
}
if(!empty($_POST['mdp']) && hash('sha1', $_POST['mdp']) !== $compte[0][0] && isset($_POST['valider'])){
    echo'<p class="text-center">Mot de passe incorrect</p>';
}
if(isset($_POST['valider']) && hash('sha1', $_POST['mdp']) === $compte[0][0]){
    $_SESSION['session'] = 'co';
    header('Location: ' . route('back-office'));
    exit();
}
?>
@endsection