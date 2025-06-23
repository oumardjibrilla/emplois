<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Offre;
use App\Models\Candidature;
use Illuminate\Http\Request;
use App\Mail\candidatureMail;
use App\Models\user as ModelsUser;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\select;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

session_start();
class HomeController extends Controller{


         public function home(){
            if(Auth::check()){
                 $connecte = 1;
            }
            else{
                $connecte = 0;
            }

            $offres = DB::table('offres')
                    ->join('users' ,'offres.recruteur_id' ,'=' ,'users.id')
                    ->select('offres.titreOffre' , 'users.nom-entreprise as nom_entreprise' , 'lieuOffre' ,
                           'typecontrat_offre as type', 'offres.created_at' ,'offres.id' ,'users.photo')
                    ->where('offres.status','valider')
                    ->where('users.role_id',2)
                    ->whereNull('users.deleted_at')
                    ->whereNull('offres.deleted_at')
                    ->orderBy('offres.created_at', 'desc')
                    ->take(6)
                    ->get();
             return view('welcome' , compact('offres' ,'connecte'));
      }



    public function profil_candidat(){
        if (!Auth::check()) {
          return view('auth.page-connexion');
        }

      $id = Auth::user()->id;
      $data = DB::table('users')
                ->leftJoin('candidatures', 'users.id', '=', 'candidatures.id_candidat')
                ->select(
                    'users.prenom',
                    'users.nom',
                    'users.photo',
                    DB::raw('COUNT(candidatures.id) as total_candidature')
                )
                ->where('users.id', $id)
                ->groupBy('users.prenom', 'users.nom', 'users.photo')
                ->first();
       return view('profil.profil-candidat' , compact('data'));
    }





public function profil_Recruteur(){
        if (!Auth::check()) {
           return view('auth.page-connexion');
        }
        $id = Auth::user()->id;
      $offre_count = DB::table('users')
                        ->leftJoin('offres', 'users.id', '=', 'offres.recruteur_id')
                        ->leftJoin('candidatures', 'candidatures.id_offre', '=', 'offres.id')
                        ->select(
                            'users.nom',
                            'users.prenom',
                            'users.photo',
                            DB::raw('COUNT(candidatures.id) as total_candidatures'),
                            DB::raw("SUM(CASE WHEN offres.status = 'en attente' THEN 1 ELSE 0 END) as total_attente"),
                            DB::raw("SUM(CASE WHEN offres.status = 'valider' THEN 1 ELSE 0 END) as total_valider"),
                            DB::raw("SUM(CASE WHEN offres.status = 'refuser' THEN 1 ELSE 0 END) as total_refuser")
                        )
                        ->where('users.id', $id)
                        ->groupBy('users.nom', 'users.prenom', 'users.photo')
                        ->first();

        return view('profil.profil-recruteur' , compact('offre_count'));
    }





    public function info_personnelleModif(){

      if(!Auth::check()) {
           flash('Désolé, votre session a expiré. Veuillez vous reconnecter')->error();
           return view('auth.page-connexion');
        }
        $id = Auth::user()->id;
        $candidat = user::select('prenom', 'nom' ,'ville'  ,'email' ,'telephone' ,'id')
                          ->where('users.id',$id)->first();
        return view('information.information-personnelleModif' ,compact('candidat'));
    }



    public function photo_candidat(){
        if(!Auth::check()) {
           flash('Désolé, votre session a expiré. Veuillez vous reconnecter')->error();
           return view('auth.page-connexion');
        }
        $photo = Auth::user()->photo;
        return view('information.photo-candidat' ,compact('photo'));
    }



    public function changer_cv(Request $request){
            if(!Auth::check()) {
            flash('Désolé, votre session a expiré. Veuillez vous reconnecter')->error();
            return view('auth.page-connexion');
            }
           $request->validate([
                'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
            ], [
                    'cv.required' => 'Veuillez choisir votre CV.',
                    'cv.file' => 'Seuls les fichiers PDF, DOC ou DOCX sont autorisés.',
                    'cv.mimes' => 'Le fichier doit être un PDF, DOC ou DOCX.',
                    'cv.max' => 'La taille du fichier ne doit pas dépasser 2 Mo.',
            ]);
           $path = $request->file('cv')->store('cvs' ,'public');
           $id = Auth::user()->id;
            $utilisateur= User::find($id);
          if($utilisateur){
            $utilisateur->cv = $path;
            $utilisateur->save();
            flash("vous avez changer votre cv !")->success();
            return redirect()->route('cv_candidat');
        }

    }


   public function mes_candidatures(){
    if(!Auth::check()) {
            flash('Désolé, votre session a expiré. Veuillez vous reconnecter')->error();
            return view('auth.page-connexion');
            }
    $ids = Auth::user()->id;
    $offres = DB::table('offres')
                ->join('users', 'offres.recruteur_id', '=', 'users.id')
                ->join('candidatures', 'candidatures.id_offre', '=', 'offres.id')
                ->select(
                    'offres.titreOffre',
                    'users.nom-entreprise as nom_entreprise','users.photo',
                    'offres.lieuOffre',
                    'offres.typecontrat_offre as type',
                    'offres.created_at','offres.id',
                )
                ->where('offres.status', 'valider')
                ->where('candidatures.id_candidat', '=', $ids)
                ->where('users.role_id', 2)
                ->whereNull('users.deleted_at')
                ->orderBy('offres.created_at', 'desc')
                ->paginate(5);
    return view('profil.candidature-candidat' ,compact('offres'));


   }



    public  function modifier_information(Request $request){
          if(!Auth::check()) {
           flash('Désolé, votre session a expiré. Veuillez vous reconnecter')->error();
           return view('auth.page-connexion');
        }
        $id = Auth::user()->id;
        $utilisateur= User::find($id);
        if($utilisateur){
            $utilisateur->prenom = $request->input('prenom');
            $utilisateur->nom = $request->input('nom');
            $utilisateur->ville = $request->input('ville');
            $utilisateur->telephone = $request->input('telephone');

            $utilisateur->save();
            flash("vous avez modifier vos information personnelle   !")->success();
            return redirect()->route('information_personnelle');
        }
    }




    public function cv_candidat(){
         if(!Auth::check()) {
           flash('Désolé, votre session a expiré. Veuillez vous reconnecter')->error();
           return view('auth.page-connexion');
        }
        $id = Auth::user()->id;
        $cv = user::select('cv' ,'id')
                          ->where('users.id',$id)->first();
        return view('information.cv-candidat' ,compact('cv'));
    }







    public function information_personnelle(){
        if (!Auth::check()) {
            flash('Désolé, votre session a expiré. Veuillez vous reconnecter')->error();
             return view('auth.page-connexion');
        }
        $id = Auth::user()->id;
        $candidat = user::select('prenom', 'nom' ,'ville' ,'adresse' ,'email' ,'telephone' ,'id' ,'photo')
                          ->where('users.id',$id)->first();
        return view('information.information_personnelle' ,compact('candidat'));
    }



    public function page_offres(){
         if(Auth::check()){
                 $connecte = 1;
            }
            else{
                $connecte = 0;
            }
          $offres = DB::table('offres')
                ->join('users', 'offres.recruteur_id', '=', 'users.id')
                ->select(
                    'offres.titreOffre',
                    'users.nom-entreprise as nom_entreprise',
                    'lieuOffre',
                    'typecontrat_offre as type',
                    'offres.created_at','offres.id',
                    'users.photo'
                )
                ->where('offres.status', 'valider')
                ->where('users.role_id', 2)
                ->whereNull('users.deleted_at')
                ->orderBy('offres.created_at', 'desc')
                ->paginate(7);
        return view('page-offres', compact('offres' ,'connecte'));
    }





     public function profil_paga_acceille(){
                if(Auth::user()->role_id == 1){
                    return redirect()->route('profilcandidat');
                    }
                else   if(Auth::user()->role_id == 2){
                        return redirect()->route('profilrecruteur');
                    }
                else{
                        return redirect()->route('profiladmin');
                }
     }





public function affiche_offres(int $id){

         $offres_select = DB::table('users')
                          ->join('offres' ,'users.id' ,'=' ,'offres.recruteur_id')
                          ->select('offres.*' ,'users.nom-entreprise as nom' ,'users.photo')
                          ->where('offres.id' ,$id)
                          ->get();
        $offres = DB::table('offres')
                    ->join('users' ,'offres.recruteur_id' ,'=' ,'users.id')
                    ->select('offres.titreOffre' , 'users.nom-entreprise as nom_entreprise' , 'lieuOffre' ,
                           'typecontrat_offre as type', 'offres.created_at' ,'offres.id' ,'users.photo')
                    ->where('offres.status','valider')
                    ->where('users.role_id',2)
                    ->whereNull('users.deleted_at')
                    ->orderBy('offres.created_at', 'desc')
                    ->take(4)
                    ->get();
          if(Auth::check()){
                 $connecte = 1;
            }
            else{
                $connecte = 0;
            }
         return view('detaille-offre' ,compact('offres_select' , 'connecte' ,'offres'));
     }




public function envoyer_candidature( int $id){

          if(!Auth::check()){
             session(['reidcte-candidat' =>route('envoyer_candidature' ,['id' => $id])]);
             return redirect()->route('pageconnexion');
          }

        $role = Auth::user() ;

        if($role->role_id==  2){
               flash('Désolé, vous n êtes pas autorisé à postuler à une offre.')->error();
               return redirect()->route('pageconnexion');
         }

        if(Candidature::where('id_candidat', Auth::id())->where('id_offre', $id)->exists()){
                    flash("Vous avez déjà postulé à cette offre.")->warning();
                    return redirect()->route('accueil');
             }
            Candidature::create([
                'id_candidat'=> Auth::user()->id,
                'id_offre'=> $id,
                'cv'=> Auth::user()->cv,
        ]);
        $offre = Offre::find($id);
        Mail::to($role->email)->send(new candidatureMail($role->prenom  ,$offre->titreOffre ));
        flash('Votre candidature a été envoyée.')->success();
        return redirect()->route('accueil');


}






public function modif_passcandidat(Request $request){
    $request->validate([
        'passeancien' => ['required', 'min:8'],
        'password' => ['required', 'min:8', 'confirmed'],
        'password_confirmation' => ['required'],
    ], [
        'passeancien.required' => 'Veuillez saisir votre mot de passe actuel',
        'passeancien.min' => 'Votre mot de passe doit faire au moins 8 caractères',
        'password.min' => 'Pour des raisons de sécurité, votre mot de passe doit faire au moins 8 caractères',
        'password.confirmed' => 'Veuillez saisir le même mot de passe pour confirmation',
    ]);
    $user = Auth::user();

    // Vérifier que l'ancien mot de passe correspond
            if (!Hash::check($request->input('passeancien'), $user->password)) {
                flash('L\'ancien mot de passe est incorrect.')->error();
                return back()->withErrors(['passeancien' => 'L\'ancien mot de passe est incorrect.']);
            }

            // Mettre à jour le mot de passe (hasher avant)
            $user->password = \Hash::make($request->input('password'));
            $user->save();
            flash('success', 'Mot de passe modifié avec succès.')->success();
            return back()->with('success', 'Mot de passe modifié avec succès.');


}



public function detaille_offres(int $id){
           $offre = DB::table('offres')
                    ->join('users' ,'offres.recruteur_id' ,'=' ,'users.id')
                    ->select('offres.*', 'users.photo')
                    ->where('offres.status','valider')
                    ->where('users.role_id',2)
                    ->where('offres.id',$id)
                    ->whereNull('users.deleted_at')
                    ->orderBy('offres.created_at', 'desc')
                    ->first();
          if(! $offre){
             return response()->json([ 'error' => 'Offre non trouvee']);
          }
          return response()->json($offre);
    }




   public function postuler_candidature(int $id){

            if (!Auth::check()){
                    session(['reidcte-candidat-offrepage' =>route('postuler' ,['id' => $id])]);
                     return redirect()->route('pageconnexion');
                    /* return dd(session()->all());;*/
                }

            $role = Auth::user();
            if($role->role_id  ==  2){
                flash('Désolé, vous n êtes pas autorisé à postuler à une offre.')->error();
                return redirect()->route('pageconnexion');
            }

            if(Candidature::where('id_candidat', Auth::id())->where('id_offre', $id)->exists()){
                    flash("Vous avez déjà postulé à cette offre.")->warning();
                    return redirect()->route('page-offres');
             }
            Candidature::create([
                'id_candidat'=> Auth::user()->id,
                'id_offre'=> $id,
                'cv'=> Auth::user()->cv,
            ]);
             $offre = Offre::find($id);
            Mail::to($role->email)->send(new candidatureMail($role->prenom  ,$offre->titreOffre ));
            flash('Votre candidature a été envoyée.')->success();
            return redirect()->route('page-offres');
    }







    public function profil_admin(){
         if(!Auth::check()){
               return redirect()->route('pageconnexion');
         }
         $ids = Auth::user()->id;
         $offres = Offre::join('users','offres.recruteur_id','=','users.id')
                         -> select('offres.descriptionOffres','offres.titreOffre','offres.lieuOffre','offres.id',
                                    'offres.dateEXPIRATION','users.nom-entreprise','users.email' ,'users.photo')
                         -> where('status', 'en attente')->get();
        // la requete pour avoir le nombre de candidat dans la base de donner
        $nbre_candidat = user::where('role_id','=',1)->count();
        // la requete pour avoir le nom ,le prenom , et l'image de l'admin
         $info_admin = user::select('nom' , 'prenom' ,'photo')
                             ->where('users.id' , $ids)->first();
        // la requete  pour avoir le nombre de recruteur dans la base  de donner
        $nbre_recruteur = user::where('role_id','=',2)->count();
        // la requete  pour avoir le nombre de d'offres dans la base  de donner donc leur status est valider
        $nbre_offres = offre::where('offres.status','=','valider')->count();
        // la requete  pour avoir le nombre de d'offres dans la base  de donner donc leur status est en attente
        $nbreOffre_attente =offre::where('offres.status','=','en attente')->count();
        return view('profil.profil-admin', compact('offres' , 'nbre_candidat','nbre_recruteur','nbre_offres' ,'nbreOffre_attente' ,'info_admin'));

  }

 public function information_recruteur(){
      if (!Auth::check()) {
            flash('Désolé, votre session a expiré. Veuillez vous reconnecter')->error();
             return view('auth.page-connexion');
        }
        $id = Auth::user()->id;
        $candidat = user::select('prenom', 'nom' ,'ville' ,'adresse' ,'email' ,'telephone' ,'id' , 'nom-entreprise as nomentreprise' , 'fonction-entreprise as fonction' ,'photo')
                         ->where('users.id',$id)->first();


      return view('information-recruteur.information-recruteur' , compact('candidat'));
 }



 public function photo_recruteur(){
       if(!Auth::check()) {
           flash('Désolé, votre session a expiré. Veuillez vous reconnecter')->error();
           return view('auth.page-connexion');
        }
        $photo = Auth::user()->photo;
        return view('information-recruteur.photo-recruteur' , compact('photo'));
 }

 public function modif_info_recruteur(){
       if(!Auth::check()) {
           flash('Désolé, votre session a expiré. Veuillez vous reconnecter')->error();
           return view('auth.page-connexion');
        }
        $id = Auth::user()->id;
        $candidat = user::select('prenom', 'nom' ,'ville'  ,'email' ,'telephone' ,'id' ,'nom-entreprise as nomentreprise' ,'fonction-entreprise as fonction')
                          ->where('users.id',$id)->first();
        return view('information-recruteur.modif-info-recruteur' ,compact('candidat'));
 }




 public function modifier_information_recruteur(Request $request){

  if(!Auth::check()) {
           flash('Désolé, votre session a expiré. Veuillez vous reconnecter')->error();
           return view('auth.page-connexion');
        }
        $id = Auth::user()->id;
        $utilisateur= User::find($id);
        if($utilisateur){
            $utilisateur->prenom = $request->input('prenom');
            $utilisateur->nom = $request->input('nom');
            $utilisateur->ville = $request->input('ville');
            $utilisateur->telephone = $request->input('telephone');
            $utilisateur['nom-entreprise'] = $request->input('nom-entreprise');
            $utilisateur['fonction-entreprise']= $request->input('fonction');
            $utilisateur->save();
            flash("vous avez modifier vos information personnelle   !")->success();
            return redirect()->route('information-recruteur');
        }

 }


public function modif_pass_recrteur(Request $request){
    $request->validate([
        'passeancien' => ['required', 'min:8'],
        'password' => ['required', 'min:8', 'confirmed'],
        'password_confirmation' => ['required'],
    ], [
        'passeancien.required' => 'Veuillez saisir votre mot de passe actuel',
        'passeancien.min' => 'Votre mot de passe doit faire au moins 8 caractères',
        'password.min' => 'Pour des raisons de sécurité, votre mot de passe doit faire au moins 8 caractères',
        'password.confirmed' => 'Veuillez saisir le même mot de passe pour confirmation',
    ]);
    $user = Auth::user();

    // Vérifier que l'ancien mot de passe correspond
            if (!Hash::check($request->input('passeancien'), $user->password)) {
                flash('L\'ancien mot de passe est incorrect.')->error();
                return back()->withErrors(['passeancien' => 'L\'ancien mot de passe est incorrect.']);
            }

            // Mettre à jour le mot de passe (hasher avant)
            $user->password = \Hash::make($request->input('password'));
            $user->save();
            flash('success', 'Mot de passe modifié avec succès.')->success();
            return back()->with('success', 'Mot de passe modifié avec succès.');

}


public function modif_photo_recruteur(Request $request){
   if(!Auth::check()) {
            flash('Désolé, votre session a expiré. Veuillez vous reconnecter')->error();
            return view('auth.page-connexion');
            }
           $request->validate([
                    'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                ], [
                    'photo.required' => 'Veuillez choisir une photo.',
                    'photo.image' => 'Le fichier doit être une image.',
                    'photo.mimes' => 'Formats acceptés : jpeg, png, jpg, gif.',
                    'photo.max' => 'La taille du fichier ne doit pas dépasser 2 Mo.',
                ]);
             $path = $request->file('photo')->store('images' ,'public');
            $utilisateur = Auth::user();
            $utilisateur->photo = $path;
            $utilisateur->save();

            flash("Votre photo de profil a été mise à jour avec succès !")->success();
            return redirect()->route('photo-recruteur');


}
public function modif_photo_candidat(Request $request){
   if(!Auth::check()) {
            flash('Désolé, votre session a expiré. Veuillez vous reconnecter')->error();
            return view('auth.page-connexion');
            }
           $request->validate([
                    'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                ], [
                    'photo.required' => 'Veuillez choisir une photo.',
                    'photo.image' => 'Le fichier doit être une image.',
                    'photo.mimes' => 'Formats acceptés : jpeg, png, jpg, gif.',
                    'photo.max' => 'La taille du fichier ne doit pas dépasser 2 Mo.',
                ]);
            $path = $request->file('photo')->store('images' ,'public');
            $utilisateur = Auth::user();
            $utilisateur->photo = $path;
            $utilisateur->save();

            flash("Votre photo de profil a été mise à jour avec succès !")->success();
            return redirect()->route('photo_candidat');


}


public function voir_candidature_recruteur(){
    $ids = Auth::user()->id;
    $candidatures = DB::table('candidatures')
                        ->join('offres', 'candidatures.id_offre', '=', 'offres.id')
                        ->join('users', 'candidatures.id_candidat', '=', 'users.id')
                        ->where('offres.recruteur_id', $ids)
                        ->select(
                            'offres.id as offre_id',
                            'offres.titreOffre',
                            'offres.descriptionOffres as description',
                            'candidatures.id as candidature_id',
                            'users.nom',
                            'users.prenom',
                            'users.photo',
                            'users.photo',
                            'users.email',
                            'users.telephone',
                            'users.id as users_id',
                            'candidatures.created_at as date_candidature'
                        )
                        ->orderBy('offres.id')
                        ->get();
                        /* dump($candidatures); */
    return view('gestion-candidature.liste-candidature-recruteur' , compact('candidatures'));
}




public function voir_cv(int $id){
    $utilisateur= User::find($id);
    $cv_utilisateur = $utilisateur->cv;
    return view('gestion-candidature.vor-cv-recruteur' ,compact('cv_utilisateur'));
}








}
