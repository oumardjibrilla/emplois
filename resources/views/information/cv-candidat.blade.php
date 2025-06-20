@extends('entete.entete-information')
@section('titre') cv  @endsection
@section('section2')

{{-- la partie des information personnelle --}}
   <div class="cards-information">
           <div class="contenaire-cv">
                    <h2>Télécharger votre CV</h2>
                    <form action="{{route('changer-cv')}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="contenaire-cv-p" id="contenaire-cv-p">
                                @if($cv)
                                      <embed src="{{ asset('storage/' . $cv->cv) }}" type="application/pdf" width="100%" height="400px" />
                                @else

                                       <p>vous ne disposer pas de cv</p>
                                @endif
                            </div>
                            <div class="div-inputcv" id="div-inputcv"  style="display: none">
                                        <label for="cv" class="label-cv"> choisir un fichier</label>
                                        <input type="file" name="cv" accept=".pdf,.doc,.docx" id="cv"
                                            required  style="display: none">
                                        <span id="nom-fichier" style="margin-left: 10px;">Aucun fichier sélectionné</span>
                                </div>
                            <div class="buttons">
                                <button type="button" class="cancel">Annuler</button>
                                <button  class="submit" id="changer_cv">changer mon cv </button>
                                <button type="submit" style="display:none" class="submit" id="terminer">terminer</button>
                            </div>
                    </form>
          </div>
   </div>
@endsection
<style>
    .cv{
        background-color: #6075BC;
    }
</style>


<script>
    window.onload = function () {
        const btn = document.getElementById('changer_cv');

        if (btn) {
            btn.addEventListener('click', () => {
                document.getElementById('contenaire-cv-p').style.display = 'none';
                document.getElementById('div-inputcv').style.display = 'block';
                btn.style.display ='none';
                document.getElementById('terminer').style.display = 'block';

            });
        } else {
            console.warn('Le bouton avec l\'ID "changer_cv" est introuvable.');
        }



         document.getElementById('cv').addEventListener('change', function() {
            const nomFichier = this.files[0] ? this.files[0].name : 'Aucun fichier sélectionné';
            document.getElementById('nom-fichier').textContent = nomFichier;
        });
}

</script>

