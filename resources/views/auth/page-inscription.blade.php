
@extends('entete.entete-page-inscription-connexion')

@section('titre-page') inscription-page @endsection

@section('section')
    <section class="section-formulaire">
     <form action="{{route('infoperso')}}" method="post">
            @csrf
            <div class="div-form-titre">
                <h2> inscription</h2>
            </div>
            <div class="flash-message">
                  @include('flash::message')
            </div>
            <a href="" class="div-boutton-google">
                <i class="fa-brands fa-google"></i>
                login avec google
            </a>
            <div class="div-input-form">
                <div class="div-input">
                    <label for="email"> email</label>
                    <input type="email" name="email" id="email" value="{{old('email',session('donner.email'))}}" required>
                    @if ($errors->has('email'))
                        <p class="error-p"> {{$errors->first('email')}}</p>
                    @endif
                </div>
                <div class="div-input">
                    <label for="pass">mot de passe</label>
                    <input type="password" name="password" id="pass" required>
                    @if ($errors->has('password'))
                        <p class="error-p"> {{$errors->first('password')}}</p>
                    @endif
                </div>
                <div class="div-input">
                    <label for="pass-confime">confirmation </label>
                    <input type="password" name="password_confirmation" id="pass-confirme" required>
                    @if ($errors->has('password'))
                        <p class="error-p"> {{$errors->first('password-confirme')}}</p>
                    @endif
                </div>
                <div class="div-boutton-connexion">
                    <button type="submit"> inscription</button>
                </div>
                <div class="div-text-inscription">
                     <p>Créez votre compte en quelques secondes et commencez à postuler dès aujourd’hui.
                        Ne laissez pas passer les opportunités qui vous ressemblent.</p>
                </div>
                <div class="di-inscription">
                    <p>Déjà membre ? <a href="{{route('pageconnexion')}}"> Connectez-vous </a></p>
                </div>
            </div>
     </form>
  </section>
@endsection
<style>
    .flash-message{
        color: red;
        text-align: center;
        text-transform: capitalize;

}
</style>


