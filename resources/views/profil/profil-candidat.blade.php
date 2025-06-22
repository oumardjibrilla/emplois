<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profil-candidat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('frondend/css/profil_candidat.css')}}">
     @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
</head>
<body>
    <header>
         <h2>the jobs </h2>
         <nav>
            <a href="{{route('accueil')}}">Accueil</a>
            <a href="{{route('profilcandidat')}}"style="color:#B98250">dashboard</a>
            <a href="{{route('page-offres')}}">les offres</a>
            <a href="{{route('mes-candidature')}}">mes candidatutres</a>
         </nav>
         <a href="{{route('deconnexion_profil')}}" class="boutton-connexion"><button > deconnexion</button></a>
    </header>
    <!--la partie du nain le contenuer du code-->
    <main>
       <!--le main a deux section
           - la section pour afficher les information sur le candidat
           - et la section pour les differente fonctionnalite que le candidat peux faire -->
           <section class="section-info-candidat">
                 <div class="div-card-image-profil">
                     <div class="div-image">
                        <img src="{{ asset('storage/' . $data->photo) }}" alt="Photo de profil" style="border-radius: 50%">
                        <a href="#">modifier mon profil</a>
                     </div>
                     <div class="div-profil-visible">
                          <h2>{{$data->prenom}} {{$data->nom}}</h2>
                          <h3> candidat</h3>
                     </div>
                 </div>
                 <div class="div-card-info-profil">
                     <h3>J'accélère ma recherche:</h3>
                     <ul class="div-card-infos">
                        @if ($data->photo)
                             <li> <h4>photo</h4> <i class="fa-solid fa-check"></i></li>
                        @else
                             <li> <h4>photo</h4> <i class="fa-solid fa-xmark" style="color: red "></i></li>
                        @endif
                        <li> <h4>mon cv</h4> <i class="fa-solid fa-check"></i></li>
                    </ul>
                 </div>
           </section>
           <section class="section-fonctionnaliter">
                   <div class="div-contenaire-performance">
                      <h2> performances de votre compte</h2>
                      <p>Découvrez ici tous les principaux indicateurs pour réussir votre recherche d'emploi.</p>
                      <div class="div-global-performence">
                            <div class="div-nbre-vue">
                                <p> CV vu par</p>
                                <h3> 11 </h3>
                                <p>recruteur (s)</p>
                            </div>
                            <div class="div-nbre-vue">
                                <p> Mes candidature</p>
                                <h3> {{$data->total_candidature}} </h3>
                                <p>candidature(s) en cours</p>
                            </div>
                      </div>
                   </div>
                   <div class="div-card-fonctionnaliter">
                          <a href="{{route('information_personnelle')}}" class="div-card-fonct">
                                <i class="fa-solid fa-id-card"></i>
                                <h2>mes informations personnelles <i class="fa-solid fa-chevron-right"></i></h2>
                                <p>Renseignez vos informations personnelles</p>
                           </a>
                           <a href="{{route('photo_candidat')}}" class="div-card-fonct">
                               <i class="fa-solid fa-images"></i>
                               <h2>photo de profil <i class="fa-solid fa-chevron-right"></i></h2>
                               <p>Téléchargez votre photo de profil et augmenter vos chances d'être contacté par un recruteur</p>
                           </a>
                           <a href="{{route('mes-candidature')}}" class="div-card-fonct">
                               <i class="fa-solid fa-folder"></i>
                               <h2>mes candidatures <i class="fa-solid fa-chevron-right"></i></h2>
                               <p>postulez et suivez vos candidatures aux offres d'emploi</p>
                           </a>
                           <a href="{{route('cv_candidat')}}" class="div-card-fonct">
                               <i class="fa-solid fa-file-pdf"></i>
                               <h2>mon cv <i class="fa-solid fa-chevron-right"></i></h2>
                               <p>Deposer votre cv au format PDF. il sera visible sur la CVtheque et partage avec les recruteur apres chaque candidature</p>
                           </a>

                           <a href="#" class="div-card-fonct" id="card-boster">
                              <i class="fa-solid fa-rocket"></i>
                              <h2>boostez votre profil <i class="fa-solid fa-chevron-right"></i></h2>
                              <p>activez votre compte premium pour plus de visibilite aupres des recruteurs</p>
                           </a>
                   </div>
           </section>
    </main>
</body>
</html>
