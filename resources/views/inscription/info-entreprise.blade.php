@extends('entete.entete-page-inscription-connexion')

@section('titre-page')
    information sur l'entreprise
@endsection
@section('section')
<section class="info-perssonnelle">
    <form action="{{route('enrengistre_recruteur')}}" method="post">
        @csrf
         <div class="div-titre-info-personnelle">
               <h2>Informations sur l'entreprise</h2>
               <p>Renseignez ces informations pour optimiser vos offres et attirer les bons candidats</p>
         </div>
         <div class="div-form-info-personnelle">
                <div class="div-input-personnelle">
                      <label for="nom-entreprise">nom de votre entreprise*</label>
                      <input type="text" name="nom-entreprise" id="nom-entreprise" value="{{old('nom-entreprise')}}">
                </div>
                <div class="div-input-personnelle">
                     <label for="fonction-entreprise">fonction de l'entreprise*</label>
                     <input type="text" name="fonction-entreprise" id="fonction-entreprise" {{old('fonction-entreprise')}}>
                </div>
                <div class="div-input-personnelle">
                      <label for="prenom"> taille de l'entreprise*</label>
                      <select name="taille-entreprise" id="taille-enreprise" class="taille-enreprise" {{old('taille-entreprise')}}>
                              <option value="1">1</option>
                              <option value="1">2</option>
                              <option value="1">3</option>
                      </select>
               </div>
         </div>
         <div class="div-boutton-info-personnelle">
               <a href="{{route('precedent_choix_role')}}"><i class="fa-solid fa-arrow-left"></i> precedent</a>
               <button type="submit"> inscription <i class="fa-solid fa-arrow-right"></i> </button>
         </div>
      </form>
  </section>
  </section>
@endsection
<style>
    .taille-enreprise{
        width: 100%;
        background-color: whitesmoke;
        border: none;
        outline: none;
        height: 45px;
        border-radius: 10px;
        padding: 4px;
    }
</style>
