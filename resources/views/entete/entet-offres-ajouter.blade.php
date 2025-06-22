<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Plateforme Recruteur - Gestion Offres</title>
    <link rel="stylesheet" href="{{asset('frondend/css/ajot-offre-recruteur.css')}}">
     @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/ajot-offre-recruteur.css'])
        @endif
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    .flash-message{
        color: green;
        text-align: center;
        text-transform: capitalize;

}
</style>
<body>
<header>
        <h2>jobs</h2>
        <nav>
         <a href="{{route('profilrecruteur')}}">Dashboard</a>
         <a href="{{route('deconnexion_profil')}}" class="boutton-connexion">deconnexion</a>
        </nav>
</header>

<main class="globale-main">
       <section class="lien-offres">
           <h2>gestion des offres</h2>
            <div class="div-lien-offres">
                  <a href="{{route('gestion-offres')}}" class="ajouter-offres"><i class="fa-solid fa-lock"></i> ajouter une offres</a>
                  <a href="{{route('OffreValider-recruteur')}}" class="valider-offres"><i class="fa-solid fa-list"></i>  offres valider</a>
                  <a href="{{route('OffreRejetter-recruteur')}}" class="rejetter-offres"> <i class="fa-solid fa-trash"></i>  offres rejetter</a>
                  <a href="{{route('liste-offres-recruteur')}} " class="liste-offres"> <i class="fa-solid fa-list"></i>  offres en attente </a>
                  <a href="{{route('corbeille-recruteur')}} " class="corbeille-offres"> <i class="fa-solid fa-list"></i>  corbeille </a>
                  <a href="{{route('deconnexion_profil')}}" class="boutton-deconnexion">deconnexion</a>
            </div>

       </section>
       <section class="contenaire-lien">
              <div class="flash-message">
                        @include('flash::message')
              </div>
             @yield('ajoue-offre')
       </section>
</main>
<script src="{{asset('frondend/js/js-recruteur.js')}}"></script>
 @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/js/js-recruteur.js'])
        @endif
</body>
</html>
