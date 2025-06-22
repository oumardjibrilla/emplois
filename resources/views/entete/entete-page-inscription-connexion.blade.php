<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titre-page')</title>
    <link rel="stylesheet" href="{{asset('frondend/css/page-entete.css')}}">
     @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
     <header>
        <h2> the jobs</h2>
        <nav>
              <a href="{{route('accueil')}}">Accueil</a>
              <a href="#">offres d'emploi</a>
              <a href="#">guides & conseils </a>
              <a href="#">metiers</a>
              <a href="#">contacter nous</a>
        </nav>
     <!--   <a href="" class="boutton-connexion"><button > connexion</button></a> -->
    </header>
    <main>
           @yield('section')

    </main>
</body>
</html>
