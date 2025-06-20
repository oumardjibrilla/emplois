@extends('entete.entete-page-inscription-connexion')
@section('titre-page') choix-role @endsection

@section('section')
   <section class="choix-role">
     <form action="" method="post">
        @csrf
           <div class="div-role-titre">
               <h2>Merci de préciser votre profil</h2>
               <p>Sélectionnez le profil qui vous correspond pour finaliser votre inscription.</p>
           </div>
           <div class="div-role-choix">
                 <a  href="{{route('info_entreprise')}}" class="div-role" >
                         <i class="fa-solid fa-user-tie"></i>
                         <p>vous etes un</p>
                         <h2>recruteur</h2>
                         <p>Accédez à une base de talents qualifiés et recrutez plus vite les profils qui feront grandir votre entreprise.</p>
                 </a>
                 <a  href="{{route('ajouter-cv')}}"  class="div-role">
                        <i class="fa-solid fa-user-tie"></i>
                        <p>vous etes un</p>
                        <h2>candidat</h2>
                        <p>Recherchez des offres, postulez en un clic et développez votre carrière.</p>
                 </a>
           </div>
           <div class="div-boutton-info-personnelle">
                <a href="{{route('precedent_infoperso')}}"><i class="fa-solid fa-arrow-left"></i> precedent</a>
           </div>

     </form>
  </section>
@endsection

