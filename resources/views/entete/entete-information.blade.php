<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('titres')</title>
  <link rel="stylesheet" href="{{asset('frondend/css/entete_information.css')}}" />
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
  <header>

                <h2>jobs</h2>
                <nav>
                        <a href="{{route('profilcandidat')}}">Dashboard</a>
                        <a href="{{route('page-offres')}}">Offres</a>
                </nav>

  </header>
  <main>
            <section class="section1-lien">
                    <ul>
                            <li><a href="{{route('information_personnelle')}}" class="information"> <i class="fa-solid fa-id-card"></i> Mes Informations</a></li>
                            <li><a href="{{route('cv_candidat')}}" class="cv"> <i class="fa-solid fa-file-pdf"></i> Mon CV</a></li>
                            <li><a href="{{route('photo_candidat')}}" class="photo"> <i class="fa-solid fa-images"></i> Ma Photo</a></li>
                            <li><a href="{{route('info-personnelleModif')}}" class="modifier"> <i class="fa-solid fa-pen"></i> modifier</a></li>
                            {{-- <li><a href="contrat.html">Type de contrat</a></li>
                            <li><a href="formation.html">Formation</a></li>
                            <li><a href="poste.html">Poste recherché</a></li> --}}
                            <li>
                                <a href="{{route('deconnexion_profil')}}" class="boutton-connexion"> deconnexion</a>
                            </li>
                    </ul>
            </section>
            <section class="class-elementInformation">
                    @yield('section2')
            </section>
</main>
</body>
</html>
