@extends('entete.entete-profil-admin')
@section('titre-page-admin') ajout utilisateur @endsection
@section('titre-page-header') ajout utilisateur @endsection
@section('nom-prenom')  {{$info_admin->nom}} {{$info_admin->prenom}}@endsection
@section('image-admin') <img src="{{ asset('storage/' . $info_admin->photo) }}" alt="Photo de profil" style="border-radius: 50% "  >@endsection
@section('admin-forme')
      <div class="div-ajouter">
          <form action="{{route('ajoueterutilisateur-admin')}}" method="post" enctype="multipart/form-data">
              @csrf
               <div class="sous-form">
                   {{--  la partie des email etb le pass --}}
                   <div class="div-emailPasse">
                                <h2> email et mot de passe *</h2>
                                <div class="card-email">
                                                <label for="email">email</label>
                                                <input type="email" name="email" id="email" required value="{{old('email')}}">
                                                  @if ($errors->has('email'))
                                                       <p class="error-p"> {{$errors->first('email')}}</p>
                                                  @endif
                                </div>
                                <div class="card-email">
                                                <label for="pass">mot de passe</label>
                                                <input type="password" name="password" id="pass" required>
                                                 @if ($errors->has('password'))
                                                        <p class="error-p"> {{$errors->first('password')}}</p>
                                                 @endif
                                </div>
                                <div class="card-email">
                                                <label for="pass-confirm">confirmation</label>
                                                <input type="password" name="password_confirmation" id="pass-confirme" required>
                                </div>
                   </div>

                    {{-- information personnelle --}}

                   <div class="div-info-personnelle">
                                <h2>information personnelle de l'utilisateur *</h2>
                                <div class="div-input-personnelle">
                                        <label for="prenom">prenom*</label>
                                        <input type="text" name="prenom" id="prenom" required value="{{old('prenom')}}" >
                                        @if ($errors->has('prenom'))
                                                <p class="error-p"> {{$errors->first('prenom')}}</p>
                                         @endif
                                </div>
                                <div class="div-input-personnelle">
                                        <label for="nom">nom de famille*</label>
                                        <input type="text" name="nom" id="nom" required value="{{old('nom')}}" >
                                         @if ($errors->has('nom'))
                                             <p class="error-p"> {{$errors->first('nom')}}</p>
                                         @endif
                                </div>
                                <div class="div-input-personnelle">
                                    <label for="telephone"> telephone*</label>
                                    <div class="div-telephone">
                                        <select name="indicatif" id="indicatif" >
                                                    <option value="1">1</option>
                                                    <option value="1">2</option>
                                                    <option value="1">3</option>
                                        </select>
                                        <input type="text" name="telephone" id="telephone" required value="{{old('telephone')}}" >
                                    </div>
                                     @if ($errors->has('telephone'))
                                                <p class="error-p"> {{$errors->first('telephone')}}</p>
                                         @endif
                                </div>
                                <div class="div-input-personnelle">
                                    <label for="ville">ville*</label>
                                    <input type="text" name="ville" id="ville" required value="{{old('ville')}}" >
                                     @if ($errors->has('ville'))
                                             <p class="error-p"> {{$errors->first('ville')}}</p>
                                     @endif
                                </div>
                                <div class="div-input-personnelle">
                                        <label for="adresse">adresse*</label>
                                        <input type="text" name="adresse" id="adresse" required value="{{old('adresse')}}" >
                                </div>
                    </div>

                    {{-- le code pour les information de l'entreprise  --}}


                    <div class="info-entreprise">
                            <h2>les information sur l'entreprise</h2>
                            <div class="div-input-entreprise">
                                <label for="nom-entreprise">nom de votre entreprise*</label>
                                <input type="text" name="nom-entreprise" id="nom-entreprise"  value="{{old('nom-entreprise')}}">
                            </div>
                            <div class="div-input-entreprise">
                                <label for="fonction-entreprise">fonction de l'entreprise*</label>
                                <input type="text" name="fonction-entreprise" id="fonction-entreprise" value="{{old('nom-entreprise')}}">
                            </div>
                            <div class="div-input-entreprise">
                                <label for="taille-enreprise"> taille de l'entreprise*</label>
                                <select name="taille-entreprise" id="taille-enreprise" class="taille-enreprise" value="{{old('taille-entreprise')}}">
                                        <option value="1">1</option>
                                        <option value="1">2</option>
                                        <option value="1">3</option>
                                </select>
                            </div>
                    </div>
                     {{-- le code pour le cv d candidat --}}
                    <div class="cv-candidatadmin">
                              <h1>veillez ajouter votre cv </h1>
                                <div class="div-inputcv">
                                        <label for="cv" class="label-cv"> choisir un fichier</label>
                                        <input type="file" name="cv" accept=".pdf,.doc,.docx" id="cv"
                                             style="display: none">
                                        <span id="nom-fichier" style="margin-left: 10px;">Aucun fichier sélectionné</span>
                                </div>
                                 @if ($errors->has('cv'))
                                        <p class="error-p"> {{$errors->first('cv')}}</p>
                                 @endif
                    </div>
                   {{-- le code pour le choix des role --}}
                   <div class="div-role-boutton">
                       <div class="div-role">
                               <h2>choix de role</h2>
                                <div class="div-role-radio">
                                        <label for="admin"> admin</label>
                                        <input type="radio" name="role" id="admin" value=3 >
                                </div>
                                <div class="div-role-radio">
                                        <label for="candidat"> candidat</label>
                                        <input type="radio" name="role" id="candidat"  value=1>
                                </div>
                                <div class="div-role-radio">
                                        <label for="recruteur"> recruteur</label>
                                         <input type="radio" name="role" id="recruteur"  value=2>
                                </div>
                       </div>
                    <div class="div-bouttonForme">
                         <button type="reset">annuler</button>
                         <button type="valider"> valider</button>
                    </div>
               </div>
            </div>
          </form>
      </div>
@endsection
<style>
    .flash-message{
        color: red;
        text-align: center;
        text-transform: capitalize;

   }
   .error-p{
    color: red;
    font-style: italic;
}
.creer_utilisateur{
        background-color: #B98250;
}
/*  le code css pour du cv  */

.cv-candidatadmin{
    width: 100%;
    display: none
}
.cv-candidatadmin h1{
     background-color: #2c3b42;
     height: 30px;
     color: white;
     text-transform: capitalize;
     font-size: 17px;
    display: flex;
    align-items: center;
}
.div-inputcv{
    height: 250px;
    display: flex;
    justify-content: center;
    align-items: center;
    border: 1px solid rgba(0, 0, 0,0.1);
    border-radius: 7px;
}
.label-cv{
    display: inline-block;
    padding: 10px 20px;
    cursor: pointer;
    background-color: var(--couleur-boutton);
    color: white;
    border-radius: 5px;
    font-weight: bold;
    transition: background-color 0.3s;
}
.div-inputcv input{
    width: 500px;
    height: 200px;
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
