@extends('entete.entete-information-recruteur')
@section('titre') photo @endsection
@section('section2')

{{-- la partie des information personnelle --}}
   <div class="cards-information">
    <h3 class="photo-titre-h3"> cliquez pour sélectionner Votre photo ne devrait dépasser 2M et 1200 pixels par 1200 </h3>
           <div class="contenaire-cv">
                    <form action="{{route('modif-photo-recruteur')}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="div-input-photo">
                                <div class="div-inputphoto">
                                         <p> Types d'images autorisées : (JPG, PNG, GIF)</p>
                                        <label for="cv" class="label-cv"> choisir un fichier</label>
                                        <input type="file" name="photo"  id="cv"
                                            required  style="display: none">
                                        @if ($errors->has('photo'))
                                            <p class="error-p"> {{$errors->first('photo')}}</p>
                                       @endif
                                        <span id="nom-fichier" style="margin-left: 10px;"></span>
                                </div>
                                <div class="div-image-photo">
                                @if ($photo)
                                    <img src="{{ asset('storage/' . $photo) }}" alt="Photo de profil" >
                                @else
                                    <p>Vous ne disposez pas de photo de profil.</p>
                                @endif
                                </div>
                            </div>
                            <div class="buttons">
                                <button type="button" class="cancel">Annuler</button>
                                <button type="submit" class="submit">Terminer</button>
                            </div>
                    </form>

          </div>
   </div>
@endsection
<style>
    .photo{
        background-color: #6075BC;
    }

</style>
<script>
window.onload = function(){
        document.getElementById('cv').addEventListener('change', function() {
            const nomFichier = this.files[0] ? this.files[0].name : 'Aucun fichier sélectionné';
            document.getElementById('nom-fichier').textContent = nomFichier;
        });
}
</script>
