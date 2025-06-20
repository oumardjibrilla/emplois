@extends('entete.entete-page-inscription-connexion')

@section('titre-page') connexion-utilisateur @endsection
@section('section')
<section class="section-formulaire">

    <form action="{{route("profil_utilisateur")}}" method="post" >
        @csrf
            <div class="div-form-titre">
                 <div class="flash-message">
                     @include('flash::message')
                 </div>
                <h2> se connecter</h2>
                <p> Veuillez vous connecter avec votre email et votre mot de passe.</p>
            </div>
            <a href="" class="div-boutton-google">
                <i class="fa-brands fa-google"></i>
                login avec google
            </a>
            <div class="div-input-form">
                <div class="div-input">
                    <label for="email"> email</label>
                    <input type="email" name="email" id="email" value="{{old('email')}}">
                    @if ($errors->has('email'))
                        <p class="error-p"> {{$errors->first('email')}}</p>
                    @endif
                </div>

                <div class="div-input">
                    <label for="pass">mot de passe</label>
                    <input type="password" name="password" id="pass">
                    @if ($errors->has('password'))
                        <p class="error-p"> {{$errors->first('password')}}</p>
                    @endif
                </div>
                <div class="div-pass-oublier">
                    <a href="#"> email ou mot de passe oublier ?</a>
                </div>
                <div class="div-boutton-connexion">
                    <button type="submit"> se connecter</button>
                </div>
                <div class="di-inscription">
                    <p>Inscrivez-vous et accédez à toutes les fonctionnalités.<a href="{{ route('inscription') }}">Inscription</a>
                    </p>
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
