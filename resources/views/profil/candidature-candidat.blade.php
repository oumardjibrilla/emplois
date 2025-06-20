<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profil-candidat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('frondend/css/profil_candidat.css')}}">
    <link rel="stylesheet" href="{{asset('frondend/css/page_principale.css')}}">
</head>
<style>
    .p-0candidature{
        text-align: center;
        font-size: 22px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        text-transform: capitalize;
    }
</style>
<body>
    <header>
         <h2>the jobs </h2>
         <nav>
            <a href="{{route('accueil')}}">Accueil</a>
            <a href="{{route('profilcandidat')}}">dashboard</a>
            <a href="{{route('page-offres')}}">les offres</a>
            <a href="{{route('mes-candidature')}}" style="color:#B98250">mes candidatutres</a>
         </nav>
         <a href="{{route('deconnexion_profil')}}" class="boutton-connexion"><button > deconnexion</button></a>
    </header>
        @if ($offres->isEmpty())
            <p class="p-0candidature">vous n'avez aucune candidature merci de postuler pour des offres </p>
        @endif
</section>
         <main class="main-offres">
              <section  class="section-listeoffres">
                       <div class="div-listeoffres">
                          @foreach ($offres as $offre)
                                    <a href="{{route('detaille-offres' ,['id'=>$offre->id])}}" class="div-offres offres-lien" data-id="{{$offre->id}}" id="div-offres">
                                        <div class="logo-entreprise"> <img src="{{ asset('storage/' . $offre->photo) }}" alt="Photo de profil" style="border-radius: 50% "  ></div>
                                        <div class="div-ellement-offres">
                                                <h1>{{$offre->titreOffre}}</h1>
                                                <p>{{$offre->nom_entreprise}}</p>
                                                <div class="div-lieu-offres">
                                                    @if(!empty($offre->lieuOffre))
                                                         <p> <i class="fa-solid fa-location-dot"></i>{{$offre->lieuOffre}}</p>
                                                    @endif
                                                     @if(!empty($offre->type))
                                                         <p> <i class="fa-solid fa-file-signature"></i>  {{$offre->type}}</p>
                                                    @endif
                                                </div>
                                                <div class="div-heurePublier" id="div-heurePublier"> <i class="fa-solid fa-calendar-days"></i> {{ \Carbon\Carbon::parse($offre->created_at)->diffForHumans() }} </div>
                                        </div>
                                   </a>

                          @endforeach

                       </div>
              </section>
              <section class="section-detailleoffres">
                      <div class="div-detailleoffres">
                                 <div class="div-offres" id="offres-div">
                                        <div class="logo-entreprise"><img src="" alt="Photo de profil" style="border-radius: 50% " class="image" ></div>
                                        <div class="div-ellement-offres">
                                                 <h1 class="titre-offres"></h1>
                                                <p class="text-offres"></p>
                                                <div class="div-lieu-offres">
                                                    <p > <i class="fa-solid fa-location-dot"></i><span class="span1"></span></p>
                                                    <p> <i class="fa-solid fa-file-signature"></i> <span class="span2"></span></p>
                                                </div>
                                                <div class="div-heurePublier" id="div-heurePublier" style="background-color: white"><i class="fa-solid fa-calendar-days"></i> il y a 5 heure(s) </div>
                                        </div>
                                    </div>
                                   <div class="div-description">
                                        @if(empty($offres))
                                                     <h1 >description</h1>
                                        @endif
                                       <p class="descriptionoffres"> </p>

                                   </div>
                      </div>
              </section>
         </main>
          <!-- Liens de pagination -->
           <div class="pagination-container">
                <div class="div-pagination">
                   {{ $offres->links('pagination::simple-bootstrap-4') }}
                </div>
          </div>
       <footer>
         <div class="div-footer">
            <a href=""><i class="fa-brands fa-facebook"></i></a>
            <a href=""><i class="fa-brands fa-tiktok"></i></a>
            <a href=""><i class="fa-brands fa-instagram"></i></a>
            <a href=""><i class="fa-brands fa-whatsapp"></i></a>
         </div>
         <div class="divfooter-email"> oumardjibrilla18@gmail.com</div>
     </footer>
     <script>
       function affiche_detalle_offre(id){
                 fetch(`/detaille-offres/${id}`)
                           .then(response => {
                                if (!response.ok) throw new Error('Offre non trouvée');
                                return response.json();
                            })
                            .then(data =>{
                               // Affiche les détails dans la deuxième section
                               document.querySelector('.titre-offres').innerText =data.titreOffre
                               document.querySelector('.text-offres').innerText =data.nom
                               document.querySelector('.span1').innerText =data.lieuOffre
                               document.querySelector('.span2').innerText =data.type
                               document.querySelector('.descriptionoffres').innerText =data.descriptionOffres
                               document.querySelector('.image').src = `/storage/${data.photo}`
                               const publie_lien = document.querySelectorAll('.boutton-postuler')

                            }) .catch(error => {
                                    console.error('Erreur lors de l\'affichage des détails :', error);
                                });
       }
       const offre_lien = document.querySelectorAll('.offres-lien')
                for(offre of offre_lien){
                    offre.addEventListener('click', (e)=> {
                            e.preventDefault();
                            const id = e.currentTarget.dataset.id
                            affiche_detalle_offre(id)
                    })
        }
       if(offre_lien.length >0){
           const id = offre_lien[0].dataset.id
           affiche_detalle_offre(id)
       }
     </script>
</body>
</html>
