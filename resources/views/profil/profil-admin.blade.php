@extends('entete.entete-profil-admin')
@section('titre-page-admin') dashbord @endsection
@section('titre-page-header') tableau de bord @endsection
@section('nom-prenom')  {{$info_admin->nom}} {{$info_admin->prenom}}@endsection
@section('image-admin')<img src="{{ asset('storage/' . $info_admin->photo) }}" alt="Photo de profil" style="border-radius: 50% "  >@endsection
@section('admin-forme')
    <div class="div-global-section">
            <div class="div-card-info">
                <div class="div-card-element-bord">
                    <div class="divcontenaire-info">
                            <i class="fa-solid fa-users" style="background-color: #2c3b42; color:white"></i>
                            <h2>candidats inscrits</h2>
                    </div>
                    <p style="text-align: center ; margin:6px">{{$nbre_candidat}}  candidat actifs engages</p>
                </div>
                <div class="div-card-element-bord">
                        <div class="divcontenaire-info">
                            <i class="fa-solid fa-user-tie" style="background-color: #65b789"></i>
                            <h2> entreprises partenaires </h2>
                        </div>
                        <p style="text-align: center ; margin:6px">{{$nbre_recruteur}}  recruteur actifs engages</p>
                </div>
                <div class="div-card-element-bord">
                        <div class="divcontenaire-info">
                            <i class="fa-solid fa-bullhorn"  style="background-color: #e85959;"></i>
                            <h2> opportunites disponibles {{$nbre_offres}}</h2>
                        </div>
                        <p style="text-align: center ; margin:6px">{{$nbreOffre_attente}}  opportunites en attentes </p>

                </div>
                <div class="div-card-element-bord">
                        <div class="divcontenaire-info">
                            <i class="fa-solid fa-crown"  style="background-color: #B98250"></i>
                            <h2> abonnements premium actifs 3000</h2>
                        </div>
                        <p>22 compte ajouter </p>
                </div>
            </div>
        {{-- la partie du graphe  le code graphe --}}
            <div class="div-garphe">
                    <div class="div-graphe-inscription">
                        <canvas id="card-graphe1"> </canvas>
                        <p>Inscription mensuelle(candidat/recruteur)</p>
                    </div>
                    <div class="div-graphe-inscription">
                        <canvas id="card-graphe2"> </canvas>
                        <p>nombre d'offres mensuelle</p>
                    </div>
                    <div class="div-graphe-inscription">
                        <canvas id="card-graphe3"> </canvas>
                        <p>Répartition des offres</p>
                </div>
            </div>

{{-- la liste des offres en attentes  --}}
       <div class="div-table-recruteur" style="margin-top: 100px;">
              <div class="div-titre-tableau" > <h2>  la liste des offres en attentes</h2> </div>
              <table>
                   <tr class="tr-titre-tableau">
                        <th  class="auteur-th" width="220px">auteur</th>
                        <th width="200px">description</th>
                        <th width="20px">nom-emtreprise</th>
                        <th width="20px">date expiration</th>
                   </tr>
                   @if ($offres->isEmpty())
                        <tr>
                            <td colspan="6">Vous n'avez aucune offre en attentes</td>
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
                                    <td width="20px"><a href="{{route('refuser-offres' ,['id'=>$offre->id])}}" class="refuserOffres-admin" >rejettee</a></td>

                            </tr>
                    @endforeach
              </table>
       </div>
@endsection
