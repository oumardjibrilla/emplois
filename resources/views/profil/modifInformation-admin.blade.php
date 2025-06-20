@extends('entete.entete-profil-admin')
@section('titre-page-admin') dashbord @endsection
@section('titre-page-header') tableau de bord @endsection
@section('nom-prenom')  {{$info_admin->nom}} {{$info_admin->prenom}}@endsection
@section('image-admin')<img src="{{ asset('storage/' . $info_admin->photo) }}" alt="Photo de profil" style="border-radius: 50% "  >@endsection
@section('admin-forme')
{{-- la partie des information personnelle --}}
   <div class="div-information">
           <form action="{{route('modifier_informationAdmin')}}" class="form1" method="post">
              @csrf
                  <h1>Modifier mes informations</h1>
                  <div class="divglobale-input">
                        <div class="div-input">
                                <label for="prenom">prenom*</label>
                                <input type="text" name="prenom" id="prenom" value="{{$info_admin->prenom}}" required>
                        </div>
                        <div class="div-input">
                                <label for="nom">nom*</label>
                                <input type="text" name="nom" id="nom" value="{{$info_admin->nom}}" required>
                        </div>
                        <div class="div-input">
                                <label for="telephone"> telephone</label>
                                <div class="div-telephone">
                                        <select name="indicatif" id="indicatif">
                                            <option value="1">1</option>
                                            <option value="1">2</option>
                                            <option value="1">3</option>
                                        </select>
                                        <input type="text" name="telephone" id="telephone" value="{{$info_admin->telephone}}"  required>
                                </div>
                        </div>
                        <div class="div-input">
                                <label for="ville">ville*</label>
                                <input type="text" name="ville" id="ville" value="{{$info_admin->ville}}" required>
                        </div>
                        <div class="div-bouttonInformation">
                            <button type="reset" style="background-color: red">annuler</button>
                            <button type="submit" style="background-color: #B98250;">modifier</button>
                        </div>
                    </div>
           </form>


           {{--  la partie pour changer le mot de passe  --}}


           <form action="{{route('modif-pass-candidat')}}" method="post" class="form2">
                 @csrf
                  <h1>Changer le mot de passe</h1>
                  <div class="divglobale-input">
                        <div class="div-input">
                                <label for="passeancien">Ancien mot de passe : *</label>
                                <input type="password" name="passeancien" id="passeancien" required placeholder="Ancien mot de passe">
                                @if ($errors->has('passeancien'))
                                     <p class="error-p"> {{$errors->first('passeancien')}}</p>
                                @endif
                        </div>
                        <div class="div-input">
                                <label for="nouvaux-pass">Le nouveau mot de passe : *</label>
                                <input type="password" name="password" id="nouvaux-pass" required placeholder="Le nouveau mot de passe">
                                 @if ($errors->has('password'))
                                     <p class="error-p"> {{$errors->first('password')}}</p>
                                @endif
                        </div>
                        <div class="div-input">
                                <label for="confirmation">Confirmer le nouveau mot de passe : *</label>
                                <input type="password" name="password_confirmation"  required placeholder="Confirmer le nouveau mot de passe">
                                 @if ($errors->has('password'))
                                         <p class="error-p"> {{$errors->first('password-confirme')}}</p>
                                 @endif
                        </div>
                        <div class="div-bouttonInformation">
                            <button type="reset" style="background-color: red">annuler</button>
                            <button type="submit" style="background-color: #B98250;">modifier</button>
                        </div>
                    </div>
           </form>

   </div>




@endsection


<style>

    .error-p{
        color: red;
        font-size: 14px;
        font-weight: 670;
    }
</style>
