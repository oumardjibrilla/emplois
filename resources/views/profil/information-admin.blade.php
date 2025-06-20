@extends('entete.entete-profil-admin')
@section('titre-page-admin') dashbord @endsection
@section('titre-page-header') tableau de bord @endsection
@section('nom-prenom')  {{$info_admin->nom}} {{$info_admin->prenom}}@endsection
@section('image-admin')<img src="{{ asset('storage/' . $info_admin->photo) }}" alt="Photo de profil" style="border-radius: 50% "  >@endsection
@section('admin-forme')


{{-- la partie des information personnelle --}}
   <div class="cards-information">
       <div class="card-information">
             <h1>Mes informations</h1>
             <p>Permettez aux recruteurs de vous contacter.</p>
             <div class="card-global-information" style="padding: 0px">
                            <div class="information-image">
                                <div class="divs-label">photo de profil</div>
                                 <div class="valeur-image"><img src="{{ asset('storage/' . $info_admin->photo) }}" alt="Photo de profil" style="border-radius: 50% "  ></div>
                            </div>
                            <div class="information-text">
                                 <div class="divs-label">prenom:</div>
                                 <div class="valeur">{{$info_admin->prenom}}</div>
                            </div>
                            <div class="information-text">
                                 <div class="divs-label">nom:</div>
                                 <div class="valeur">{{$info_admin->nom}}</div>
                            </div>
                            <div class="information-text">
                                 <div class="divs-label">email:</div>
                                 <div class="valeur">{{$info_admin->email}}</div>
                            </div>
                            <div class="information-text">
                                 <div class="divs-label">ville :</div>
                                 <div class="valeur">{{$info_admin->ville}}</div>
                            </div>
                            <div class="information-text">
                                <div class="divs-label">adresse :</div>
                                 <div class="valeur">{{$info_admin->adresse}}</div>
                            </div>
             </div>
             <div class="div-boutton">
                <a href="#"  class="supprimer-a">Suppression de votre compte</a>
                 <<a href="{{route('photo-admin')}}" class="a-modifier"> <i class="fa-solid fa-pen"></i> Modifier ma photo</a>
                <a href="{{route('modif-informationAdmin')}}" class="a-modifier"> <i class="fa-solid fa-pen"></i> Modifier mes informations</a>
             </div>
       </div>
   </div>
@endsection
