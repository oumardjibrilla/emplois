@extends('entete.entete-page-inscription-connexion')

@section('titre-page')
    ajouter cv
@endsection
@section('section')
        <section class="ajouter-cv">
               <div class="div-ajouetr-cv">
                      <form action="{{route('enrengistre_candidat')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <h1>veillez ajouter votre cv </h1>
                                <div class="div-inputcv">
                                        <label for="cv" class="label-cv"> choisir un fichier</label>
                                        <input type="file" name="cv" accept=".pdf,.doc,.docx" id="cv"
                                            required  style="display: none">
                                        <span id="nom-fichier" style="margin-left: 10px;">Aucun fichier sélectionné</span>
                                </div>
                                 @if ($errors->has('cv'))
                                        <p class="error-p"> {{$errors->first('cv')}}</p>
                                   @endif
                                <div class="div-cv-boutton">
                                      <a href="#">j'ai pas de cv </a>
                                      <button type="submit">suivant</button>
                                </div>

                        </form>
               </div>
        </section>
@endsection

<script>
window.onload = function(){
        document.getElementById('cv').addEventListener('change', function() {
            const nomFichier = this.files[0] ? this.files[0].name : 'Aucun fichier sélectionné';
            document.getElementById('nom-fichier').textContent = nomFichier;
        });
}

</script>


