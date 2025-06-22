<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jobs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
{{--     <link rel="stylesheet" href="{{asset('frondend/css/page_principale.css')}}">
 --}}    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/page_principale.css', 'resources/js/app.js'])
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
                <a href="{{route('accueil')}}" style="color: #B98250">Accueil</a>
                <a href="{{route('page-offres')}}">offres d'emploi</a>
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
     <!-- le code pour la partie de ma section d'accuille-->
     <section class="acuille-section">
         <div class="accuille-titre-div">
              <h3>reve ton emploi</h3>
              <h1> Trouver le métier de vos reves</h1>
              <p>Découvrez l’offre qui correspond à vos talents et construisez l’avenir que vous méritez</p>
         </div>
         <div class="accuille-barre-recherche">
               <form action="">
                    <div class="div-input-mot-cle">
                         <i class="fa-solid fa-magnifying-glass"></i>
                         <input type="search" name="" id="input-mot-cle" placeholder="Intitule de poste,mots-cles">
                    </div>
                    <div class="div-input-localiter">
                        <i class="fa-solid fa-location-dot"></i>
                        <input type="text" name="" id="intput-" placeholder="Lieu">
                    </div>
                    <div class="div-input-contrat">
                        <i class="fa-solid fa-file-signature"></i>
                        <input type="text" name="" id="input-type-contrat" placeholder="Type de contrat">
                    </div>
                    <button class="boutton-recherche"> rechercher</button>
               </form>
         </div>
         <div class="card-recherche-rapide">
             <h1>recherche rapide</h1>
             <div class="div-recherche-rapide">
                <a href="#">offre de stage pre-embauche en developpement</a>
                <a href="">offre de stage pre-embauche en comtablite</a>
                <a href="">offre de stage pre-embauche en informatique</a>
                <a href="">offre de stage pre-embauche en managemente</a>
                <a href="">offre de stage pre-embauche en developpement</a>
                <a href="">offre de stage pre-embauche en developpement</a>
             </div>
         </div>
         <div class="div-liste-contrat">
             <div class="div-liste-contrat-titre">
                    <h2>type de contrat</h2>
                    <i class="fa-solid fa-xmark"></i>
             </div>

             <form action="">
                <div class="div-input-recherche-liste-contrat">
                    <input type="search">
                </div>
                <div class="div-liste-radio">
                    <div class="div-radio-contrat">
                        <input type="radio" name="typecontrat" id="premier emploi">
                        <label for="premier-emploi">  premier emploi</label>
                    </div>
                    <div class="div-radio-contrat">
                        <input type="radio" name="typecontrat" id="CDI">
                        <label for="CDI">  CDI</label>
                    </div>
                    <div class="div-radio-contrat">
                        <input type="radio" name="typecontrat" id="CDD">
                        <label for="CDD"> CDD</label>
                    </div>
                    <div class="div-radio-contrat">
                        <input type="radio" name="typecontrat" id="stage">
                        <label for="stage">stage</label>
                    </div>
                    <div class="div-radio-contrat">
                        <input type="radio" name="typecontrat" id="job etudiant">
                        <label for="job-etudiant">job etudiant</label>
                    </div>
                </div>
                <div class="div-boutton-liste-contrat">
                    <button type="reset"> annuler</button>
                    <button type="submit"> valider</button>
                </div>
             </form>
         </div>
     </section>

     <!--la partie du main pour le projet-->

     <section class="statistique-site">
            <div class="div-statistique">
                   <h1>Quelques Chiffres Importants</h1>
                   <p>Ce site aide les jeunes à trouver un stage ou un emploi. Voici quelques chiffres sur les utilisateurs, les offres et les entreprises présentes sur la plateforme.</p>
            </div>
            <div class="card-statistiue">
                <div class="div-state1">
                       <h2>2000</h2>
                       <p> candidats</p>
                </div>
                 <div class="div-state1">
                       <h2>2000</h2>
                       <p> Offres d'emploi publiées</p>
                 </div>
                  <div class="div-state1">
                       <h2>2000</h2>
                       <p> Entreprises</p>
                </div>
            </div>
     </section>

     <main>
        <div class="div-titre-offre">
            <h1>Découvrez les opportunités de Stages et Premier Emploi</h1>
            <p>Consultez parmi nos 22.479 OPPORTUNITÉS de stage et premier emploi . Toutes nos offres classées par secteur d'activité, type de contrat, ville, ...</p>
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
                <div class="boutton-explorer">
                      <a href="{{route('page-offres')}}"><button> explorer toutes les offres</button></a>
                </div>
        </section>
     </main>

     <article>
            <section class="section-universiter">
                <h1>Ecoles & Universités à la UNE</h1>
                <p>Voici quelques écoles et universités recommandées. Elles proposent des formations de qualité pour bien préparer votre avenir.</p>
                <div class="contenaire-universiter">
                        <div class="card-universiter">
                                <div class="div-logo-universiter"> <img src="{{asset('frondend/image/supmti.png')}}" alt=""></div>
                                <div class="div-element-universiter">
                                    <h1>supmti</h1>
                                    <span>
                                        <i class="fa-solid fa-location-dot"></i>rabat
                                    </span>
                                    <a href="https://supmti.ac.ma"> plus d'info</a>
                                </div>
                        </div>
                        <div class="card-universiter">
                                <div class="div-logo-universiter"> <img src="{{asset('frondend/image/uir.jpg')}}" alt=""></div>
                                <div class="div-element-universiter">
                                    <h1>uir</h1>
                                    <span>
                                        <i class="fa-solid fa-location-dot"></i>rabat

                                    </span>
                                    <a href="https://www.uir.ac.ma"> plus d'info</a>
                                </div>
                        </div>
                        <div class="card-universiter">
                                <div class="div-logo-universiter"> <img src="{{asset('frondend/image/abiulcasis.png')}}" alt=""></div>
                                <div class="div-element-universiter">
                                    <h1>abulcasis</h1>
                                    <span>
                                        <i class="fa-solid fa-location-dot"></i>rabat
                                    </span>
                                    <a href="https://www.uiass.ma"> plus d'info</a>
                                </div>
                        </div>
                </div>
            </section>
     </article>
     <section class="section-premuim">
          <div class="card-premuim">
                <div class="card-premuimimage">
                      <img src="{{asset('frondend/image/premium.jpg')}}" alt="">
                </div>
                <div class="contenaire-premuim">
                     <h1>Démarquez-vous et transformez vos opportunités</h1>
                     <p>
                        Activez votre compte premium pour accéder à plus d’opportunités, recevoir des conseils personnalisés, et être visible par les recruteurs les plus
                        actifs.
                     </p>
                     <a href="#">activer votre compte premium</a>
                </div>
          </div>
     </section>

     {{-- footer --}}
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

     <script src="{{asset('frondend/js/page-principale.js')}}"></script>
</body>
</html>
