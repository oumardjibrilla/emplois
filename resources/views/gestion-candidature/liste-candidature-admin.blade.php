@extends('entete.entete-profil-admin')
@section('titre-page-admin') dashbord @endsection
@section('titre-page-header') liste des offres @endsection
@section('nom-prenom')  {{$info_admin->nom}} {{$info_admin->prenom}}@endsection
@section('image-admin') <img src="{{ asset('storage/' . $info_admin->photo) }}" alt="Photo de profil" style="border-radius: 50% "  >@endsection
@section('admin-forme')
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
@endsection
<style>
    .liste-candidat{
            background-color: #B98250;
    }
</style>
