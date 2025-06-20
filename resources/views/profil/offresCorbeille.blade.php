
@extends('entete.entete-profil-admin')
@section('titre-page-admin') liste des recrutuers @endsection
@section('titre-page-header') liste recruteur @endsection
@section('nom-prenom')  {{$info_admin->nom}} {{$info_admin->prenom}}@endsection
@section('image-admin') <img src="{{ asset('storage/' . $info_admin->photo) }}" alt="Photo de profil" style="border-radius: 50% "  >@endsection
@section('admin-forme')
           <div class="div-boutton-autre">
                <a href="{{route('corbeille-admin')}}"> recruteur</a>
                <a href="{{route('corbeilleadmin-candidate')}}"> candidat</a>
                <a href="{{route('corbeilleadmin-offres')}}" class="lien-candidat"> offres</a>
        </div>
        <div class="div-table-recruteur">
               <div class="div-titre-tableau"> <h2> corbeille des offres</h2> </div>

              <table>
                   <tr class="tr-titre-tableau">
                        <th  class="auteur-th" width="230px">Auteur</th>
                        <th width="150px">Description</th>
                        <th width="30px">Nom entreprise</th>
                        <th width="20px">Fonction</th>
                   </tr>
                    @if ($corbeille_users->isEmpty())
                        <tr>
                            <td colspan="6">Votre corbeilles est vide.</td>
                        </tr>
                    @endif
                   @foreach ($corbeille_users as $offre)
                            <tr class="tr-element" style="height: 100px">
                                    <td class="auteur-td">
                                        <img src="{{ asset('storage/' . $offre->photo) }}" alt="Photo de profil" style="border-radius: 50% "  >
                                        <div class="di-auteur-email">
                                            <p class="p-nom">{{$offre->prenom}} {{$offre->nom}}</p>
                                            <p class="p-email">{{$offre->email}}</p>
                                            <p class="p-email">{{$offre->lieuOffre}}</p>
                                        </div>
                                    </td>
                                    <td class="description-td" ><textarea name="" readonly >{{$offre->descriptionOffres}}</textarea></td>
                                    <td>{{$offre->nom_entreprise}}</td>
                                    <td style="color: burlywood">{{$offre->fonction}}</td>
                                    <td width="50px"><a href="{{route('resatureoffres-admin', ['id' => $offre->id])}}">restaurer</a></td>
                                    <td width="50px"><a href="{{route('supprimeroffres-admin', ['id' => $offre->id])}}" class="refuserOffres-admin">supprimer</a></td>
                            </tr>
                    @endforeach
              </table>
       </div>
@endsection
<style>

    .corbeille_admin{
        background-color: #6075BC;
        transition: all 0.2s;
    }

</style>

