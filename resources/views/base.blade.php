<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b3d11193c6.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/base.css">
    
    @yield('head')

    <title>@yield('title')</title>
</head>

<body id="body" data-spy="scroll" data-target=".navbar" data-offset="50">

    @yield('content')

    <!-- footer -->

    <footer id="footer" class="bg-dark text-light">
        <div class="col-12 text-center">
            <div class="remonter">
                <a href="#body"><i class="fa fa-chevron-up fa-2x text-light"></i></a>
            </div>
            @if (Route::currentRouteName() == 'fiche-projet')
                <p><a href={{route('accueil')}} class="text-light retour">Retour</a></p>
            @else
                <p class="bdd"><a href={{route('connexion-back-office')}} class="text-light" target="_blank">Accéder au back office</a></p>
            @endif
            <p>&copy; Copyright {{ date('Y') }}</p>
        </div>
    </footer>
</body>

</html>