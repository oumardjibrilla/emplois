@extends('entete.entet-offres-ajouter')
@section('ajoue-offre')
 <div class="div-table-recruteur">
              <div class="div-titre-tableau"> <h2>offres valider</h2> </div>
              <table>
                   <tr class="tr-titre-tableau">
                        <th  class="auteur-th" width="200px">Auteur</th>
                        <th width="170px">Description</th>
                        <th width="30px">Lieu</th>
                        <th width="20px">Status</th>
                   </tr>
                    @if ($offress->isEmpty())
                        <tr>
                            <td colspan="6">Vous n'avez aucune offre validerée.</td>
                        </tr>
                    @endif
                   @foreach ($offress as $offre)
                            <tr class="tr-element" style="height: 100px">
                                    <td class="auteur-td">
                                        <img src="{{asset('storage/' . $offre->photo)}}" alt="" style="border-radius: 50%">
                                        <div class="di-auteur-email">
                                            <p class="p-nom">{{$offre->prenom}} {{$offre->nom}}</p>
                                            <p class="p-email">{{$offre->email}}</p>
                                        </div>
                                    </td>
                                    <td class="description-td" ><textarea name="" readonly >{{$offre->descriptionOffres}}</textarea></td>
                                    <td>{{$offre->lieuOffre}}</td>
                                    <td style="color: burlywood">{{$offre->status}}</td>
                                    <td width="50px"><a href="{{route('modifOffre-recruteur' ,['id' => $offre->id])}}"><i class="fa-solid fa-pen"></i></a></td>
                                    <td width="50px">
                                          <a href="{{route('supprimerOffres-recruteur',['id' => $offre->id])}} " class="supprimervalider"> <i class="fa-solid fa-trash"></i>  </a>
                                    </td>


                    @endforeach
              </table>
       </div>
@endsection


<style>

.valider-offres{
    background-color: #6075BC;
    transition: all 0.2s;

}
</style>
