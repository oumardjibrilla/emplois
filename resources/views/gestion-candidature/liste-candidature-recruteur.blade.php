<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profil-recruteur</title>
    <link rel="stylesheet" href="{{asset ('frondend/css/page_profil_recruteur.css')}}">
    <link rel="stylesheet" href="{{asset('frondend/css/profil-admin.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/profil-admin.css' ,'resources/css/page_profil_recruteur.css'])
        @endif
</head>
<body>
    <header>
         <h2>the jobs </h2>
         <nav>
           <a href="{{route('accueil')}}">Accueil</a>
            <a href="{{route('profilrecruteur')}}">dashboard</a>
            <a href="{{route('gestion-offres')}}">gestion des offres</a>
            <a href="{{route('voir-candidature-recruteur')}}" style="color: #B98250">les candidatures reçue</a>
         </nav>
         <a href="{{route('deconnexion_profil')}}" class="boutton-connexion"><button > deconnexion</button></a>
    </header>

   <section class="liste-candidature">
   <div class="div-table-recruteur" style="margin-top: 100px; padding:20px;)">
              <div class="div-titre-tableau" > <h2>  la liste des candidatures</h2> </div>
              <table >
                   <tr class="tr-titre-tableau">
                        <th  class="auteur-th" width="220px">Auteur</th>
                        <th width="200px">Titre-Offres</th>
                        <th width="200px">Description</th>
                        <th width="20px">Date</th>
                        {{-- <th width="20px">nom-emtreprise</th>
                        <th width="20px">date expiration</th> --}}
                   </tr>
                    @if ($candidatures->isEmpty())
                        <tr>
                            <td colspan="7">il y a aucune candidature</td>
                        </tr>
                    @endif
                   @foreach ($candidatures as $candidature)
                            <tr class="tr-element" style="height: 100px;box-shadow:opx 0px 3px rgba(0,0,0,0.6)">
                                    <td class="auteur-td">
                                         <img src="{{ asset('storage/' . $candidature->photo) }}" alt="Photo de profil" style="border-radius: 50% "  >
                                        <div class="di-auteur-email">
                                            <p class="p-nom"> {{$candidature->prenom}} {{$candidature->nom}}</p>
                                              <p class="p-email">{{$candidature->email}}</p>
                                            <p class="p-email">{{$candidature->telephone}}</p>
                                        </div>
                                    </td>
                                    <td>{{$candidature->titreOffre}}</td>
                                    <td class="description-td" ><textarea name="description" readonly>  {{$candidature->description}}</textarea></td>
                                    <td>{{$candidature->date_candidature}}</td>
                                    <td width="50px"><a href="{{route('voir-cv' ,['id'=>$candidature->users_id])}}" target="_blank" rel="noopener noreferrer" class="refuser" style="color: green">voir cv</a></td>
                            </tr>
            @endforeach
              </table>
       </div>
   </section>
</body>
</html>
