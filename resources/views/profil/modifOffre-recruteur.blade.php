@extends('entete.entet-offres-ajouter')
@section('ajoue-offre')
   <div class="div-table-recruteur">
       <div class="div-titreModifier"><h2>modifier une offres</h2></div>
        <form action="{{route('modif-offres' , $offres_modif->id)}}" method="post" class="modifOffres-recruteur">
            @csrf
               <div class="div-modifOffres">
                      <div class="div-modif-input">
                                <label for="titre">Titre de l'offre *</label>
                                <input type="text" id="titre" name="titre" placeholder="Ex : Développeur Web" required  value="{{$offres_modif->titreOffre}}"/>
                            </div>
                            <div class="div-modif-input">
                                <label for="type">Type de contrat *</label>
                                 <select id="type" name="type" required>
                                            <option value="">-- Sélectionner --</option>
                                            <option value="temps-plein" {{ $offres_modif->typecontrat_Offre == 'temps-plein' ? 'selected' : '' }}>Temps plein</option>
                                            <option value="temps-partiel" {{ $offres_modif->typecontrat_Offre == 'temps-partiel' ? 'selected' : '' }}>Temps partiel</option>
                                            <option value="stage" {{ $offres_modif->typecontrat_Offre == 'stage' ? 'selected' : '' }}>Stage</option>
                                            <option value="alternance" {{ $offres_modif->typecontrat_Offre == 'alternance' ? 'selected' : '' }}>Alternance</option>
                                            <option value="freelance" {{ $offres_modif->typecontrat_Offre == 'freelance' ? 'selected' : '' }}>Freelance</option>
                                  </select>
                            </div>
                            <div class="div-modif-input">
                                    <label for="lieu">Lieu *</label>
                                    <input type="text" id="lieu" name="lieu" placeholder="Ex : Casablanca" required  value="{{$offres_modif->lieuOffre}}"/>
                            </div>
                            <div class="div-modif-input">
                                 <label for="date-expiration">Date d'expiration *</label>
                                 <input type="date" id="date-expiration" name="dateExpiration" required value="{{$offres_modif->dateEXPIRATION }}"/>
                            </div>
               </div>
               <div class="div-description-offres">
                    <div class="div-description">
                        <label for="description"> description</label>
                        <textarea name="description" id="description" >{{$offres_modif->descriptionOffres}} </textarea>
                    </div>
                    <div class="div-boutton" id="div-boutton">
                            @if ($sup == 1)
                                  <a href="{{route('supprimerOffres-recruteur',['id' => $offres_modif->id])}} " class="supprimerOffres-recruteur"> supprimer  </a>
                                  <button type="submit">publier</button>
                            @else
                                <button type="reset">annuler</button>
                                <button type="submit">modifier</button>
                            @endif

                </div>
               </div>

        </form>

    </div>
@endsection

