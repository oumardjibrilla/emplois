@extends('entete.entete-page-inscription-connexion')
@section('titre-page') info-perssonnelle @endsection
@section('section')
 <section class="info-perssonnelle">
     <form action="{{route('choix-role')}}" method="post">
        @csrf
          <div class="div-titre-info-personnelle">
                <h2>Informations personnelles</h2>
                <p></p>
          </div>
          <div class="div-form-info-personnelle">
                 <div class="div-input-personnelle">
                       <label for="prenom">prenom*</label>
                       <input type="text" name="prenom" id="prenom" value="{{old('prenom',session('donnersPersonne.prenom'))}}">
                       @if ($errors->has('prenom'))
                            <p class="error-p"> {{$errors->first('prenom')}}</p>
                       @endif

                 </div>
                 <div class="div-input-personnelle">
                      <label for="nom">nom de famille*</label>
                      <input type="text" name="nom" id="nom" value="{{old('nom',session('donnersPersonne.nom'))}}">
                       @if ($errors->has('nom'))
                            <p class="error-p"> {{$errors->first('nom')}}</p>
                       @endif
                 </div>
                 <div class="div-input-personnelle">
                       <label for="prenom"> telephone*</label>
                       <div class="div-telephone">
                           <select name="indicatif" id="indicatif" value="{{old('indicatif')}}">
                               <option value="1">1</option>
                               <option value="1">2</option>
                               <option value="1">3</option>
                            </select>

                           <input type="text" name="telephone" id="nom" value="{{old('telephone',session('donnersPersonne.telephone'))}}" required>

                       </div>
                       @if ($errors->has('telephone'))
                               <p class="error-p"> {{$errors->first('telephone')}}</p>
                       @endif
                </div>
                <div class="div-input-personnelle">
                       <label for="ville">ville*</label>
                       <input type="text" name="ville" id="ville" value="{{old('ville',session('donnersPersonne.ville'))}}" required>
                        @if ($errors->has('ville'))
                            <p class="error-p"> {{$errors->first('ville')}}</p>
                        @endif
                </div>
                <div class="div-input-personnelle">
                       <label for="adresse">adresse*</label>
                       <input type="text" name="adresse" id="adresse" value="{{old('adresse',session('donnersPersonne.adresse'))}}">
                </div>
          </div>

          <div class="div-boutton-info-personnelle">
                 <a href="{{route('precedent_page_inscription')}}"><i class="fa-solid fa-arrow-left"></i> precedent</a>
                 <button type="submit"> suivant <i class="fa-solid fa-arrow-right"></i> </button>
          </div>
       </form>
   </section>

@endsection

<style>
    .error-p{
        color: red;
        font-size: 14px;
    }
</style>
