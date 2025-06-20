
@extends('entete.entete-profil-admin')
@section('titre-page-admin') liste des recrutuers @endsection
@section('titre-page-header') liste recruteur @endsection
@section('nom-prenom')  {{$info_admin->nom}} {{$info_admin->prenom}}@endsection
@section('image-admin') <img src="{{ asset('storage/' . $info_admin->photo) }}" alt="Photo de profil" style="border-radius: 50% "  >@endsection
@section('admin-forme')
           <div class="div-boutton-autre">
                <a href="{{route('corbeille-admin')}}"> recruteur</a>
                <a href="{{route('corbeilleadmin-candidate')}}"class="lien-candidat"> candidat</a>
                <a href="{{route('corbeilleadmin-offres')}}"> offres</a>
        </div>
 <div class="div-table-recruteur">
               <div class="div-titre-tableau"> <h2> corbeille recruteur</h2> </div>

              <table>
                   <tr class="tr-titre-tableau">
                        <th  class="auteur-th" width="300px">auteur</th>
                        <th width="50px">ville</th>
                        <th width="100px">addrese</th>
                        <th width="20px">nombe de candidatures</th>
                   </tr>
                    @if ($corbeille_users->isEmpty())
                        <tr>
                            <td colspan="6">Votre corbeilles est vde.</td>
                        </tr>
                    @endif
                   @foreach ($corbeille_users as $offre)
                            <tr class="tr-element" style="height: 100px">
                                    <td class="auteur-td">
                                        <img src="{{ asset('storage/' . $offre->photo) }}" alt="Photo de profil" style="border-radius: 50% "  >
                                        <div class="di-auteur-email">
                                            <p class="p-nom">{{$offre->prenom}} {{$offre->nom}}</p>
                                            <p class="p-email">{{$offre->email}}</p>
                                            <p class="p-email">{{$offre->telephone}}</p>
                                        </div>
                                    </td>
                                    <td>{{$offre->ville}}</td>
                                    <td >{{$offre->adresse}}</td>
                                    <td >3</td>
                                    <td width="50px"><a href="{{route('resatureUtilisateur', ['id' => $offre->id])}}">restaurer</a></td>
                                    <td width="50px"><a href="{{route('suprimerDefinit-utilisateur', ['id' => $offre->id])}}" class="refuserOffres-admin">supprimer</a></td>
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
</style>

