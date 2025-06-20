@extends('entete.entete-information')
@section('titre') mes information @endsection
@section('section2')

{{-- la partie des information personnelle --}}
   <div class="cards-information">
       <div class="card-information">
             <h1>Mes informations</h1>
             <p>Permettez aux recruteurs de vous contacter.</p>

             <div class="card-global-information">
                            <div class="information-image">
                                <div class="divs-label">photo de profil</div>
                                 <div class="valeur-image"><img src="{{ asset('storage/' . $candidat->photo) }}" alt="Photo de profil" style="border-radius: 50% "  ></div>
                            </div>
                            <div class="information-text">
                                 <div class="divs-label">prenom:</div>
                                 <div class="valeur">{{$candidat->prenom}}</div>
                            </div>
                            <div class="information-text">
                                 <div class="divs-label">nom:</div>
                                 <div class="valeur">{{$candidat->nom}}</div>
                            </div>
                            <div class="information-text">
                                 <div class="divs-label">email:</div>
                                 <div class="valeur">{{$candidat->email}}</div>
                            </div>
                            <div class="information-text">
                                 <div class="divs-label">ville :</div>
                                 <div class="valeur">{{$candidat->ville}}</div>
                            </div>
                            <div class="information-text">
                                <div class="divs-label">adresse :</div>
                                 <div class="valeur">{{$candidat->adresse}}</div>
                            </div>
             </div>

             <div class="div-boutton">
                <a href="#"  class="supprimer-a">Suppression de votre compte</a>
                <a href="{{route('info-personnelleModif')}}" class="a-modifier"> <i class="fa-solid fa-pen"></i> Modifier mes informations</a>
             </div>

       </div>

   </div>




@endsection


<style>
    .information{
        background-color: #6075BC;
    }
</style>
