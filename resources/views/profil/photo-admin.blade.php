@extends('entete.entete-profil-admin')
@section('titre-page-admin') dashbord @endsection
<link rel="stylesheet" href="{{asset('frondend/css/entete_information.css')}}" />
 @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/entete_information.css'])
        @endif
@section('titre-page-header') tableau de bord @endsection
@section('nom-prenom')  {{$info_admin->nom}} {{$info_admin->prenom}}@endsection
@section('image-admin')<img src="{{ asset('storage/' . $info_admin->photo) }}" alt="Photo de profil" style="border-radius: 50% "  >@endsection
@section('admin-forme')

{{-- la partie des information personnelle --}}
   <div class="cards-information">
    <h3 class="photo-titre-h3"> cliquez pour sélectionner Votre photo ne devrait dépasser 2M et 1200 pixels par 1200 </h3>
           <div class="contenaire-cv">
                    <form action="{{route('modif_photo_Admin')}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="div-input-photo">
                                <div class="div-inputphoto">
                                         <p> Types d'images autorisées : (JPG, PNG, GIF)</p>
                                        <label for="cv" class="label-cv"> choisir un fichier</label>
                                        <input type="file" name="photo" id="cv"
                                            required  style="display: none">
                                        <span id="nom-fichier" style="margin-left: 10px;"></span>
                                </div>
                                <div class="div-image-photo">
                                          <img src="{{ asset('storage/' . $info_admin->photo) }}" alt="Photo de profil" style="border-radius: 50% "  >
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
