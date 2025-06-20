@extends('entete.entete-profil-admin')
@section('titre-page-admin') dashbord @endsection
@section('titre-page-header') liste des offres @endsection
@section('nom-prenom')  {{$info_admin->nom}} {{$info_admin->prenom}}@endsection
@section('image-admin') <img src="{{ asset('storage/' . $info_admin->photo) }}" alt="Photo de profil" style="border-radius: 50% "  >@endsection
@section('admin-forme')
        <div class="div-boutton-autre">
            <a href="{{route('offresrejette-admin')}}" > offres rejettes</a>
        </div>
       <div class="div-table-recruteur">
              <div class="div-titre-tableau"> <h2>  la liste des offres</h2> </div>
              <table>
                   <tr class="tr-titre-tableau">
                        <th  class="auteur-th" width="200px">Auteur</th>
                        <th width="150px">Description</th>
                        <th width="35px">Lieu</th>
                        <th width="20px">Status</th>
                   </tr>
                   @if ($listOffres->isEmpty())
                        <tr>
                            <td colspan="7">il y a aucune offres</td>
                        </tr>
                    @endif
                   @foreach ($listOffres as $offre)
                            <tr class="tr-element" style="height: 100px">
                                    <td class="auteur-td">
                                        <img src="{{ asset('storage/' . $offre->photo) }}" alt="Photo de profil" style="border-radius: 50% "  >
                                        <div class="di-auteur-email">
                                            <p class="p-nom">{{$offre['nom-entreprise']}}</p>
                                            <p class="p-email">{{$offre->email}}</p>
                                            <p class="p-email">{{$offre->telephone}}</p>
                                        </div>
                                    </td>
                                    <td class="description-td" ><textarea name="" readonly >{{$offre->descriptionOffres}}</textarea></td>
                                    <td>{{$offre->lieuOffre}}</td>
                                    <td style="color: burlywood">{{$offre->status}}</td>
                                    <td width="50px"><a href="#" class="refuser"> <i class="fa-solid fa-trash"></i></a></td>
                            </tr>
                    @endforeach
              </table>
       </div>
@endsection
<style>
    .liste_offres{
            background-color: #B98250;
    }
</style>
