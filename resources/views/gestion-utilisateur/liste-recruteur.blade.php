@extends('entete.entete-profil-admin')
@section('titre-page-admin') liste des recrutuers @endsection
@section('titre-page-header') liste recruteur @endsection
@section('nom-prenom')  {{$info_admin->nom}} {{$info_admin->prenom}}@endsection
@section('image-admin') <img src="{{ asset('storage/' . $info_admin->photo) }}" alt="Photo de profil" style="border-radius: 50% "  >@endsection
@section('admin-forme')
      <div class="div-boutton-autre">
            <a href="#"  class="lien-candidat"> recruteur</a>
            <a href="{{route('liste_candidats')}}"> candidat</a>
        </div>
       <div class="div-table-recruteur">
              <div class="div-titre-tableau"> <h2>  la liste des recruteur</h2> </div>
              <table>
                   <tr class="tr-titre-tableau">
                        <th  class="auteur-th" width="400px">Auteur</th>
                        <th >NomEntrprise</th>
                        <th >Fonction</th>
                        <th >Ville</th>
                        <th >Valider</th>
                        <th >En Attente</th>
                        <th>Refuser</th>
                   </tr>
                   @if ($recruteurs->isEmpty())
                        <tr>
                            <td colspan="7">il y a aucun recruteur</td>
                        </tr>
                    @endif
                   @foreach ($recruteurs as $recruteur)
                            <tr class="tr-element" style="height: 100px">
                                    <td class="auteur-td">
                                        <img src="{{ asset('storage/' . $recruteur->photo) }}" alt="Photo de profil" style="border-radius: 50% "  >
                                        <div class="di-auteur-email">
                                            <p class="p-nom">{{$recruteur->prenom}} {{$recruteur->nom}}</p>
                                            <p class="p-email">{{$recruteur->email}}</p>
                                            <p class="p-email">{{$recruteur->telephone}}</p>

                                        </div>
                                    </td>
                                    <td class="description-td" >{{$recruteur['nom-entreprise']}}</td>
                                    <td>{{$recruteur['fonction-entreprise']}}</td>
                                    <td>{{$recruteur->ville}}</td>
                                    <td>{{$recruteur->total_valider}}</td>
                                    <td>{{$recruteur->total_attente}}</td>
                                    <td>{{$recruteur->total_refuser}}</td>
                                    <td width="50px"><a href="{{route('supprimerUtilisateur' , ['id_utilisateur'=>$recruteur->id])}}" class="refuserOffres-admin"> <i class="fa-solid fa-trash"></i></a></td>
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


