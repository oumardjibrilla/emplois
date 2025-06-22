<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profil-recruteur</title>
    <link rel="stylesheet" href="{{asset ('frondend/css/page_profil_recruteur.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
</head>
<body>
    <header>
         <h2>the jobs </h2>
         <nav>
            <a href="{{route('accueil')}}">Accueil</a>
            <a href="{{route('profilrecruteur')}}" style="color: #B98250">dashboard</a>
            <a href="{{route('gestion-offres')}}">gestion des offres</a>
            <a href="{{route('voir-candidature-recruteur')}}">les candidatures reçue</a>
         </nav>
         <a href="{{route('deconnexion_profil')}}" class="boutton-connexion"><button > deconnexion</button></a>
    </header>
    <!--la partie du nain le contenuer du code-->
    <main>
       <!--le main a deux section
           - la section pour afficher les information sur le candidat
           - et la section pour les differente fonctionnalite que le candidat peux faire -->
           <!--section fonctionnaliter-->
           <section class="section-fonctionnaliter">
                   <div class="div-contenaire-performance">
                      <h2> performances de votre compte</h2>
                      <p>Découvrez ici tous les principaux indicateurs pour réussir vos recrutements.</p>
                      <div class="div-global-performence">
                            <div class="div-nbre-vue">
                                <h3> {{$offre_count->total_candidatures}} </h3>
                                <p>candidature reçue(s)</p>
                            </div>
                            <div class="div-nbre-vue">
                                <h3>{{$offre_count->total_valider}}</h3>
                                <p>offre(s) active(s)</p>
                            </div>
                            <div class="div-nbre-vue">
                                <h3>{{$offre_count->total_attente}} </h3>
                                <p> offre(s) en attente(s)</p>
                            </div>

                            <div class="div-nbre-vue">
                                <h3>{{$offre_count->total_refuser}}</h3>
                                <p>offre(s) rejettee(s)</p>
                            </div>
                      </div>
                   </div>
                   <div class="div-card-fonctionnaliter">
                          <a href="{{route('gestion-offres')}}" class="div-card-fonct">
                               <i class="fa-solid fa-school"></i>
                               <h2> gestion des offres<i class="fa-solid fa-chevron-right"></i></h2>
                               <p> publiez et gerez vos offres d'emploi en cours...</p>
                          </a>
                          <a href="{{route('voir-candidature-recruteur')}}" class="div-card-fonct">
                               <i class="fa-solid fa-folder"></i>
                               <h2>candidatures <i class="fa-solid fa-chevron-right"></i></h2>
                               <p>gerer les candidatures des candidats interesses par votre entreprise</p>
                          </a>
                          <a href="{{route('information-recruteur')}}" class="div-card-fonct">
                                <i class="fa-solid fa-id-card"></i>
                                <h2> les informations sur le recruteur <i class="fa-solid fa-chevron-right"></i></h2>
                                <p>Renseignez vos informations personnelles</p>
                          </a>
                          <a href="#" class="div-card-fonct" id="card-boster">
                              <i class="fa-solid fa-rocket"></i>
                              <h2>boostez votre profil <i class="fa-solid fa-chevron-right"></i></h2>
                              <p>activez votre compte premium pour plus de visibilite aupres des recruteurs</p>
                          </a>
                   </div>
           </section>
           <section class="section-info-candidat">
            <div class="div-card-image-profil">
                <div class="div-image">
                   <img src="{{ asset('storage/' . $offre_count->photo) }}" alt="Photo de profil" >
                   <a href="#">modifier mon profil</a>
                </div>
                <div class="div-profil-visible">
                     <h2>{{$offre_count->prenom}}  {{$offre_count->nom}}</h2>
                     <h3>recruteur</h3>
                </div>
            </div>
            <div class="div-card-info-profil">
                <h3>J'accélère ma recherche:</h3>
                <ul class="div-card-infos">
                        @if ($offre_count->photo)
                             <li> <h4>photo</h4> <i class="fa-solid fa-check"></i></li>
                        @else
                             <li> <h4>photo</h4> <i class="fa-solid fa-xmark" style="color: red "></i></li>
                        @endif
                       <li> <h4>CVtheque</h4> <i class="fa-solid fa-check"></i></li>
                       <li> <h4>Mes offres</h4> <i class="fa-solid fa-check"></i></li>
                       <li> <h4>candidatures reçue</h4> <i class="fa-solid fa-check"></i></li>
               </ul>
            </div>
      </section>
    </main>
</body>
</html>
