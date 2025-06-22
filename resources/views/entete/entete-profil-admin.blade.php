<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
          @yield('titre-page-admin')
    </title>
    <link rel="stylesheet" href="{{asset('frondend/css/profil-admin.css')}}">
     @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/profil-admin.css'])
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
      <div class="flash-message">
                        @include('flash::message')
      </div>
     <main class="main-admin">
            <section class="section-menu-page">
                   <div class="card-menu-page">
                           <div class="div-menu-titre">
                                <h2> admin page</h2>
                                <div class="div-titre-image-menu">
                                        <div class="div-imge">@yield('image-admin')</div>
                                        <h3 style="text-align: center">@yield('nom-prenom')</h3>
                                </div>
                           </div>
                   </div>
                   <div class="div-liste-menu">
                          <ul class="ul-global-titre">
                            <li> <a href="{{route('liste_recruteur')}}" class="liste_utilisateur"> liste des utilisateur</a></li>
                            <li> <a href="{{route('liste-candidatue-admin')}}" class="liste-candidat" class="liste_candidature"> liste des candidatures</a></li>
                            <li> <a href="{{route('listeOffre-admin')}}" class="liste_offres"> liste des offres</a></li>
                            <li> <a href="{{route('ajouter_utilisateur')}}" class="creer_utilisateur"> creer un utilisateur </a></li>
                            <li> <a href="{{route('corbeille-admin')}}" class="corbeille_admin"> corbeille </a></li>
                            <li><a href="{{route('deconnexion_profil')}}" >deconnexion</a></li>
                          </ul>
                   </div>
            </section>
            {{-- le code pour la deuxiemme sction --}}
            <section class="section-contenue">
                  <header class="admin-header">
                        <div class="div-bord">
                            <div class="div-bord-titre">
                                <a href="{{route('accueil')}}"><i class="fa-solid fa-house"></i></a>
                                <h2>/</h2>
                                <a href="{{route('profiladmin')}}">tableau de bord</a>
                            </div>
                            <p>@yield('titre-page-header')</p>
                        </div>
                        <div class="header-nav">
                            <div class="div-input-header">
                                 <input type="text" name="recherche" placeholder="recherche...">
                                 <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                              <a href="{{route('information-admin')}}"> <i class="fa-solid fa-circle-user"></i></a>
                              <a href="#"><i class="fa-solid fa-bell"></i></a>
                              <a href="{{route('deconnexion_profil')}}"><i class="fa-solid fa-arrow-right-to-bracket"></i></a>
                        </div>
                  </header>
                  {{-- le code qui se trouve juste apres le header  --}}
                  @yield('admin-forme')
            </section>
            {{-- la liste des candidat --}}
     </main>
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
     <script src="{{asset('frondend/js/page-admin.js')}}"></script>
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
                @vite(['resources/js/page-admin.js'])
            @endif
</body>
</html>
