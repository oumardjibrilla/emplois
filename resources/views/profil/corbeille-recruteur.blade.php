@extends('entete.entet-offres-ajouter')
@section('ajoue-offre')
 <div class="div-table-recruteur">
              <div class="div-titre-tableau"> <h2>corbeille des offres</h2> </div>
              <table>
                   <tr class="tr-titre-tableau">
                        <th  class="auteur-th" width="200px">Auteur</th>
                        <th width="170px">Description</th>
                        <th width="20px">Status</th>
                   </tr>
                    @if ($offress->isEmpty())
                        <tr>
                            <td colspan="6">vottre corbeille est vide .</td>
                        </tr>
                    @endif
                   @foreach ($offress as $offre)
                            <tr class="tr-element" style="height: 100px">
                                    <td class="auteur-td">
                                        <img src="{{asset('storage/' . $info_admin->photo)}}" alt="" style="border-radius: 50%">
                                        <div class="di-auteur-email">
                                            <p class="p-nom">{{$offre->lieuOffre}}</p>
                                            <p class="p-email">{{$offre->dateEXPIRATION}}</p>
                                        </div>
                                    </td>
                                    <td class="description-td" ><textarea name="" readonly >{{$offre->descriptionOffres}}</textarea></td>
                                    <td style="color: burlywood">{{$offre->status}}</td>
                                    <td width="50px"><a href="{{route('restaurerOffres-recruteur' , ['id'=>$offre->id])}}">restaurer</a></td>
                                    <td width="50px"><a href="{{route('supprimerdefinitif-offres' , ['id'=>$offre->id])}}"  class="supprimerdefinitive">supprimer</a></td>
                            </tr>
                    @endforeach
              </table>
       </div>
@endsection
<style>
    .corbeille-offres{
        background-color: #6075BC;
        transition: all 0.2s;
    }
</style>

