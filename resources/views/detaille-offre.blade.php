<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jobs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('frondend/css/page_principale.css')}}">
     @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
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
          <h2> the jobs</h2>
          <nav>
                <a href="{{route('accueil')}}">Accueil</a>
                <a href="{{route('page-offres')}}" style="color: #B98250">offres d'emploi</a>
                <a href="#">guides & conseils </a>
                <a href="#">metiers</a>
                <a href="#">contacter nous</a>
          </nav>
         @if ($connecte == 0)
                <a href="{{route('pageconnexion')}}" class="boutton-connexion"><button > connexion</button></a>
          @else
                <a href="{{route('profil-accuille')}}" class="boutton-connexion"><button > profil</button></a>
          @endif
    </header>


    <section class="offres-select-detaille">
         @foreach ($offres_select as $offre)

            <div class="cards-detaille">
                    <div class="div-offres offres-lien" data-id="{{$offre->id}}" id="div-offresdetaille">
                                            <div class="logo-entreprise"><img src="{{ asset('storage/' . $offre->photo) }}" alt="Photo de profil" style="border-radius: 50% "  ></div>
                                            <div class="div-ellement-offres">
                                                    <h1>{{$offre->titreOffre}}</h1>
                                                    <p>{{$offre->nom}}</p>
                                                    <div class="div-lieu-offres">
                                                        <p> <i class="fa-solid fa-location-dot"></i>{{$offre->lieuOffre}}</p>
                                                        <p> <i class="fa-solid fa-file-signature"></i>{{$offre->typecontrat_Offre}}</p>
                                                    </div>
                                                    <div class="div-heurePublier" id="div-heurePublier"> <i class="fa-solid fa-calendar-days"></i> {{ \Carbon\Carbon::parse($offre->created_at)->diffForHumans() }} </div>
                                            </div>
                    </div>
           </div>
           <div class="cards-detaille-description">
                   <h1> description</h1>
                   <p> {{$offre->descriptionOffres}}</p>
           </div>
           <div class="div-envoie">
                <a href="{{route('envoyer_candidature' , ['id'=>$offre->id ])}}"> envoyer ma candidature</a>
           </div>
         @endforeach

    </section>
      <div class="detailleoffres-titre">
              <h1>D’autres offres qui vous correspondent !</h1>
      </div>
    <section class="section-offres">
                <div class="div-section-offres">
                    @foreach ($offres as $offre)
                            <a href="{{route('affiche_offres' , ['id' => $offre->id])}}" class="div-offres">
                                        <div class="logo-entreprise"><img src="{{ asset('storage/' . $offre->photo) }}" alt="Photo de profil" style="border-radius: 50% "  ></div>
                                        <div class="div-ellement-offres">
                                                <h1>{{$offre->titreOffre}}</h1>
                                                <p>{{$offre->nom_entreprise}}</p>
                                                <div class="div-lieu-offres">
                                                    <p> <i class="fa-solid fa-location-dot"></i>{{$offre->lieuOffre}}</p>
                                                    <p> <i class="fa-solid fa-file-signature"></i> {{$offre->type}}</p>
                                                </div>
                                                <div class="div-heurePublier"> <i class="fa-solid fa-calendar-days"></i>  {{ \Carbon\Carbon::parse($offre->created_at)->diffForHumans() }}</div>
                                        </div>
                              </a>
                    @endforeach
                </div>

        </section>





       <footer>
                <div class="div-footer">
                    <div class="lien-footer">
                        <a href=""><i class="fa-brands fa-facebook"></i></a>
                        <a href=""><i class="fa-brands fa-tiktok"></i></a>
                        <a href=""><i class="fa-brands fa-instagram"></i></a>
                        <a href=""><i class="fa-brands fa-whatsapp"></i></a>
                    </div>
                    <div class="divfooter-email"> oumardjibrilla18@gmail.com</div>
                </div>
      </footer>

</body>
</html>
