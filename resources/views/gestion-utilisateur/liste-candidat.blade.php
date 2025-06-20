@extends('entete.entete-profil-admin')
@section('titre-page-admin') liste des candidat @endsection
@section('titre-page-header') liste candidat @endsection
@section('nom-prenom')  {{$info_admin->nom}} {{$info_admin->prenom}}@endsection
@section('image-admin') <img src="{{ asset('storage/' . $info_admin->photo) }}" alt="Photo de profil" style="border-radius: 50% "  >@endsection
@section('admin-forme')
      <div class="div-boutton-autre">
            <a href="{{route('liste_recruteur')}}" > recruteur</a>
            <a href="#" class= "lien-candidat"> candidat</a>
        </div>
       <div class="div-table-recruteur">
              <div class="div-titre-tableau"> <h2>  la liste des candidats</h2> </div>
              <table>
                   <tr class="tr-titre-tableau">
                        <th  class="auteur-th" width="220px">Auteur</th>
                        <th width="20px">Ville</th>
                        <th width="20px">Telephone</th>
                        <th width="20px">Adresse</th>
                   </tr>
                 @if ($candidats->isEmpty())
                        <tr>
                            <td colspan="6">il y a aucun candidat</td>
                        </tr>
                    @endif
                   @foreach ($candidats as $candidat)
                            <tr class="tr-element" style="height: 100px">
                                    <td class="auteur-td">
                                        <img src="{{ asset('storage/' . $candidat->photo) }}" alt="Photo de profil" style="border-radius: 50% "  >
                                        <div class="di-auteur-email">
                                            <p class="p-nom">{{$candidat->prenom}} {{ $candidat->nom}}</p>
                                            <p class="p-email">{{$candidat->email}}</p>
                                            <p class="p-email">{{$candidat->telephone}}</p>
                                        </div>
                                    </td>
                                    <td class="description-td" >{{$candidat->ville}}</textarea></td>
                                    <td>{{$candidat->telephone}}</td>
                                    <td>{{$candidat->adresse}}</td>
                                    <td width="50px"><a href="{{route('supprimerUtilisateur' , ['id_utilisateur'=>$candidat->id])}}" class="refuserOffres-admin"> <i class="fa-solid fa-trash"></i></a></td>
                            </tr>
                    @endforeach
              </table>
       </div>
@endsection

<style>
    .liste_utilisateur{
        background-color: #B98250;
    }
</style>
