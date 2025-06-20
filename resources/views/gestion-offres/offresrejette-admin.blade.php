@extends('entete.entete-profil-admin')
@section('titre-page-admin')dashbord @endsection
@section('titre-page-header')liste des offres en rejetter @endsection
@section('nom-prenom')  {{$info_admin->nom}} {{$info_admin->prenom}}@endsection
@section('image-admin') <img src="{{ asset('storage/' . $info_admin->photo) }}" alt="Photo de profil" style="border-radius: 50% "  >@endsection
@section('admin-forme')
       <div class="div-boutton-autre">
            <a href="{{route('listeOffre-admin')}}" > liste des valider</a>
        </div>
       <div class="div-table-recruteur" style="margin-top: 100px;">
              <div class="div-titre-tableau" ><h2>la liste des offres rejetter</h2> </div>
              <table>
                   <tr class="tr-titre-tableau">
                        <th  class="auteur-th" width="220px">Auteur</th>
                        <th width="200px">Aescription</th>
                        <th width="20px">Nom-emtreprise</th>
                        <th width="20px">Date Expiration</th>
                   </tr>
                    @if ($offres->isEmpty())
                        <tr>
                            <td colspan="7">il y a aucune offres rejettees</td>
                        </tr>
                    @endif
                   @foreach ($offres as $offre)
                            <tr class="tr-element" style="height: 100px">
                                    <td class="auteur-td">
                                        <img src="{{ asset('storage/' . $offre->photo) }}" alt="Photo de profil" style="border-radius: 50% "  >
                                        <div class="di-auteur-email">
                                            <p class="p-nom">{{$offre->titreOffre}}({{$offre->lieuOffre}})</p>
                                            <p class="p-email">{{$offre->email}}</p>
                                        </div>
                                    </td>
                                    <td class="description-td" ><textarea name="description" readonly> {{$offre->descriptionOffres}}</textarea></td>
                                    <td>{{$offre['nom-entreprise']}}</td>
                                    <td>{{$offre->dateEXPIRATION}}</td>
                                    <td width="50px"><a href="{{route('modifStatus-offres' ,['id'=>$offre->id])}}" class="refuser" style="color: green">publier</a></td>
                                    <td width="20px"><a href="{{route('supprimeerOffres-admin' ,['id'=>$offre->id])}}" class="refuserOffres-admin" ><i class="fa-solid fa-trash" style="color: red"></i></a></td>

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
