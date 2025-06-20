@extends('entete.entet-offres-ajouter')
@section('ajoue-offre')
     <form action="{{route('ajouter-offres')}}" method="post">
        @csrf
                    <div class="div-forme-etap1">
                            <div class="div-form-input">
                                <label for="titre">Titre de l'offre *</label>
                                <input type="text" id="titre" name="titre" placeholder="Ex : Développeur Web" required />
                            </div>
                            <div class="div-form-input">
                                <label for="type">Type de contrat *</label>
                                    <select id="type" name="type" required>
                                        <option value="">-- Sélectionner --</option>
                                        <option value="temps-plein">Temps plein</option>
                                        <option value="temps-partiel">Temps partiel</option>
                                        <option value="stage">Stage</option>
                                        <option value="alternance">Alternance</option>
                                        <option value="freelance">Freelance</option>
                                    </select>
                            </div>
                            <div class="div-form-input">
                                    <label for="lieu">Lieu *</label>
                                    <input type="text" id="lieu" name="lieu" placeholder="Ex : Casablanca" required />
                            </div>
                        <div class="div-boutton">
                            <button type="button" class="boutton-suivant"> suivant</button>
                        </div>
                    </div>
                    <div class="div-forme-etap2 hidden"  >
                            <div class="div-form-input">
                                 <label for="description">Description *</label>
                                 <textarea id="description" name="description" placeholder="Description détaillée du poste" required></textarea>
                            </div>
                            <div class="div-form-input">
                                 <label for="date-expiration">Date d'expiration *</label>
                                 <input type="date" id="date-expiration" name="dateExpiration" required />
                            </div>
                        <div class="div-boutton" >
                            <button type="button" class="boutton-precedent">precedent</button>
                            <button type="submit" class="boutton-publier">publier</button>
                        </div>
                    </div>
              </form>

@endsection
<style>

    .ajouter-offres{
        background-color: #6075BC;
        transition: all 0.2s;

    }
</style>
