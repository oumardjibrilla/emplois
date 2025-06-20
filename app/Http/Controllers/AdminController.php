<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Offre;
use Illuminate\Http\Request;
use App\Mail\Mailutilisateur;
use App\Mail\offreRefuser;
use App\Mail\offreValider;
use App\Models\user as ModelsUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function liste_candidats(){
        if (!Auth::check()){
            return redirect()->route('pageconnexion');
        }
        $ids = Auth::user()->id;
        $candidats = user::where('role_id', '=',1)->get();
        $info_admin = user::select('nom' , 'prenom' ,'photo')
                             ->where('users.id' , $ids)->first();
        return view('gestion-utilisateur.liste-candidat',compact('candidats' ,'info_admin'));

    }
    public function liste_recruteur(){
         if (!Auth::check()){
            return redirect()->route('pageconnexion');
        }
        $ids = Auth::user()->id;
        $recruteurs = user::leftJoin('offres','offres.recruteur_id' , '=' ,'users.id')
                           ->select('users.prenom','users.nom','users.email', 'users.telephone','users.ville','users.adresse',
                                   'users.id','users.nom-entreprise','users.fonction-entreprise','users.photo',
                                    DB::raw('COUNT(offres.id) as total_offres'),
                                    DB::raw("SUM(CASE WHEN offres.status = 'en attente' THEN 1 ELSE 0 END) as total_attente"),
                                    DB::raw("SUM(CASE WHEN offres.status = 'valider' THEN 1 ELSE 0 END) as total_valider"),
                                    DB::raw("SUM(CASE WHEN offres.status = 'refuser' THEN 1 ELSE 0 END) as total_refuser"))
                           ->where('users.role_id', '=' ,2)
                            ->whereNull('offres.deleted_at')
                           ->groupBy('users.prenom','users.email','users.nom', 'users.telephone','users.ville','users.adresse',
                                   'users.id','users.nom-entreprise','users.fonction-entreprise','users.photo'
                                   )->get();
         // la requete pour avoir le nom ,le prenom , et l'image de l'admin
         $info_admin = user::select('nom' , 'prenom' ,'photo')
                             ->where('users.id' , $ids)->first();
        return view('gestion-utilisateur.liste-recruteur',compact('recruteurs' ,'info_admin'));
    }

    public function ajouter_utilisateur(){
        if (!Auth::check()){
            return redirect()->route('pageconnexion');
        }
         $ids = Auth::user()->id;
         $info_admin = user::select('nom' , 'prenom' ,'photo')
                             ->where('users.id' , $ids)->first();
        return view('gestion-utilisateur.ajouterUtilisateur' ,compact('info_admin'));
    }



    public function modifoffre_status( int $id){
       if (!Auth::check()){
            return redirect()->route('pageconnexion');
        }
        $offre= offre::find($id);
        if($offre){
            $offre->status ="valider";
            $offre->save();
            flash("vous avez valider une offres  !")->success();
            $utilisateur = User::find($offre->recruteur_id);
            Mail::to($utilisateur->email)->send(new offreValider($offre->titreOffre , $utilisateur->prenom));
            return redirect()->route('profiladmin');
        }
        else{
             flash("desoler l'offre n#est pas dans la base de donnees merci !  ")->success();
             return redirect()->route('profiladmin');
        }
    }


    public function refuser_offres(int $id){
          if (!Auth::check()){
            return redirect()->route('pageconnexion');
        }

        $offre= offre::find($id);
        if($offre){
            $offre->status ="refuser";
            $offre->save();
            flash("vous avez refuser une offres  !")->success();
            $utilisateur = User::find($offre->recruteur_id);
            Mail::to($utilisateur->email)->send(new offreRefuser($offre->titreOffre , $utilisateur->prenom));
            return redirect()->route('profiladmin');
        }
        else{
             flash("desoler l'offre n 'est pas dans la base de donnees merci !  ")->success();
             return redirect()->route('profiladmin');
        }
    }


    // le code  pour ajouter des utilisateur cote admin
     public function ajoueterutilisateur_admin(Request $request){
         if (!Auth::check()){
            return redirect()->route('pageconnexion');
        }
        $role_utilisateur = $request->input('role');
            if(!$role_utilisateur){
                flash('aucun role n a ete choisie ')->error();
                return  redirect()->back()->withInput();
            }

           request()->validate([
                'email'=>['required' , 'email'],
                'password'=>['required', 'min:8' ,'confirmed'],
                'password_confirmation'=>['required'],
                'prenom'=>['required'],
                'nom'=>['required'],
                'telephone'=>['required'],
                'ville'=>['required'],
                'cv' => $role_utilisateur == 1
                        ? 'required|file|mimes:pdf,doc,docx|max:2048'
                        : 'nullable|file|mimes:pdf,doc,docx|max:2048',
            ],[
                'password.min' => 'pour des raison de securite, votre mot de passe doit faire: min catractere',
                'password.confirmed' => 'Veuillez saisir le même mot de passe pour confirmation',
                'prenom.required'=>'ce champs est obligatoir',
                'nom.required'=>'ce champs est obligatoir',
                'telephone.required'=>'ce champs est obligatoir',
                'ville.required'=>'ce champs est obligatoir',
                /* 'cv.required' => 'Veuillez choisir votre CV.', */
                'cv.file' => 'Seuls les fichiers PDF, DOC ou DOCX sont autorisés.',
                'cv.mimes' => 'Le fichier doit être un PDF, DOC ou DOCX.',
                'cv.max' => 'La taille du fichier ne doit pas dépasser 2 Mo.',
            ]);
            $verifieMail = user::where('users.email', $request->input('email'))->first();
             if($verifieMail){
                  flash('ce mail existe deja dans la base de donnes !')->success();
                  return  redirect()->back()->withInput();
            }

               $path = null;
            if ($request->hasFile('cv')) {
                $path = $request->file('cv')->store('cvs', 'public');
            }
            $mail= $request->input('email');
            $prenom =$request->input('prenom');
            $nom =$request->input('nom');
            user::create([
                'prenom'=>$request->input('prenom'),
                'nom' =>$request->input('nom'),
                'email'=> $request->input('email'),
                'password'=> bcrypt($request->input('password')),
                'ville' => $request->input('ville'),
                'adresse' =>$request->input('adresse'),
                'telephone' => $request->input('telephone'),
                'nom-entreprise' => $request->input('nom-entreprise'),
                'fonction-entreprise' => $request->input('fonction-entreprise'),
                'taille-entreprise' => $request->input('taille-entreprise'),
                'role_id' => $role_utilisateur,
                'cv'=> $path
            ]);
            Mail::to($mail)->send(new Mailutilisateur($nom , $prenom ));
            flash('vous avez ajouter un utilisateur')->error();
            return redirect()->route('ajouter_utilisateur');
     }




     // le code pour afficher la liste des offres cote admin
     public function listeOffre_admin(){
        if (!Auth::check()){
            return redirect()->route('pageconnexion');
        }
        $ids = Auth::user()->id;
        $listOffres = Offre::leftjoin('users','offres.recruteur_id', '=','users.id')
                              ->select('offres.*','users.email' ,'users.prenom','users.nom' , 'users.telephone'
                                        ,'users.nom-entreprise', 'users.photo')
                              ->where('users.role_id' ,'=' ,'2')
                              ->where('offres.status' ,'=' ,'valider')
                              ->whereNull('users.deleted_at')->get();
        $info_admin = user::select('nom' , 'prenom' ,'photo')
                         ->where('users.id' ,$ids)->first();
        return view('gestion-offres.liste-offresAdmin' , compact('listOffres' ,'info_admin'));
     }



     public function supprimerUtilisateur(int $id_utilisateur){
            if (!Auth::check()){
                      return redirect()->route('pageconnexion');
            }
             $utilisateur = user::find($id_utilisateur);


            if($utilisateur and $utilisateur->role_id == 2){
               $utili_offres = Offre::where('offres.recruteur_id', $id_utilisateur);

               $utili_offres->delete();

               $utilisateur->delete();
               flash('vous avez  mis un utilisateur dans la corbeille')->success();
                return redirect()->route('liste_recruteur');
             }
             else {
                 $utilisateur->delete();
                flash('vous avez  mis un utilisateur dans la corbeille')->success();
                return redirect()->route('liste_candidats');
             }
     }



     public function supprimeerOffres_admin( int $id){
              if (!Auth::check()){
                     return redirect()->route('pageconnexion');
               }
             $offre = Offre::findOrFail($id);
             $offre->delete();
            flash("vous avez supprimer une offre rejettee")->success();
            return redirect()->route('offresrejette-admin');

     }


     public function corbeille_Admin(){
                 if (!Auth::check()){
                        return redirect()->route('pageconnexion');
                 }
                $ids = Auth::user()->id;
                $corbeille_users = DB::table('users')
                                        ->leftJoin('offres', 'offres.recruteur_id', '=', 'users.id')
                                        ->select('users.prenom','users.nom','users.email', 'users.telephone','users.ville','users.adresse',
                                                'users.id','users.nom-entreprise as nom_entreprise','users.fonction-entreprise as fonction',
                                                'users.telephone','users.photo','users.role_id',
                                                DB::raw('COUNT(offres.id) as total_offres'))
                                        ->whereNotNull('users.deleted_at')
                                        ->where('users.role_id' , 2)
                                        ->groupBy('users.prenom','users.nom','users.email', 'users.telephone','users.ville','users.adresse',
                                                'users.id','users.nom-entreprise','users.fonction-entreprise' ,'users.photo' ,'users.role_id')
                                        ->get();

                $info_admin = user::select('nom' , 'prenom' ,'photo')
                         ->where('users.id' ,$ids)->first();

         /* dump($corbeille_users); */
        return view('profil.corbeilleAdmin' , compact('corbeille_users'  ,'info_admin'));
     }


     public function corbeilleadmin_candidate(){
        if (!Auth::check()){
            return redirect()->route('pageconnexion');
        }
         $ids = Auth::user()->id;
         $corbeille_users = user::onlyTrashed()
                          ->where('role_id' ,1)
                          ->get();
        $info_admin = user::select('nom' , 'prenom' ,'photo')
                         ->where('users.id' ,$ids)->first();
        return view('profil.candidatCorbeille' ,compact('corbeille_users' ,'info_admin'));
     }
     public function corbeilleadmin_offres(){
          if (!Auth::check()){
            return redirect()->route('pageconnexion');
        }
         $ids = Auth::user()->id;
        $corbeille_users = DB::table('users')
                          ->join('offres' , 'offres.recruteur_id' , '=' ,'users.id')
                          ->select('users.prenom','users.nom','users.email', 'users.telephone','users.ville','users.adresse',
                                   'users.id','users.nom-entreprise as nom_entreprise','users.fonction-entreprise as fonction',
                                   'users.telephone', 'offres.*','users.photo',
                            )
                          ->where('users.role_id' , 2)
                          ->where('offres.status' ,'valider')
                          ->whereNotNull('offres.deleted_at')
                          ->get();
        $info_admin = user::select('nom' , 'prenom' ,'photo')
                         ->where('users.id' ,$ids)->first();
        return view('profil.offresCorbeille' , compact('corbeille_users' ,'info_admin'));
     }


     public function resatureUtilisateur(int $id){
        if (!Auth::check()){
            return redirect()->route('pageconnexion');
        }
             $restaurer_utilisateur = user::withTrashed()->findOrFail($id);;
             if($restaurer_utilisateur->role_id == 2){
               $restaurerOffres_Utilisateur = Offre::withTrashed()
                                                    ->where('recruteur_id', $restaurer_utilisateur->id)
                                                    ->where('offres.status','valider')
                                                    ->whereNotNull('deleted_at')
                                                    ->get();
                foreach ($restaurerOffres_Utilisateur as $offre) {
                        $offre->restore();
                    }
                $restaurer_utilisateur->restore();
                flash('vous avez restaurer un recruteur avec ces offres.')->success();
                return redirect()->route('corbeille-admin');
             }
            else{
                $restaurer_utilisateur->restore();
                flash('vous avez restaurer un candidat avec ces offres.')->success();
                return redirect()->route('corbeilleadmin-candidate');
            }
    }
    public function suprimerDefinit_utilisateur(int $id){
         if (!Auth::check()){
            return redirect()->route('pageconnexion');
        }
        $suprimer_utilisateur = user::withTrashed()->findOrFail($id);;
             if($suprimer_utilisateur->role_id == 2){
               $supprimerOffres_Utilisateur = Offre::withTrashed()
                                                    ->where('recruteur_id', $suprimer_utilisateur->id)
                                                    ->whereNotNull('deleted_at')
                                                    ->get();
                foreach ($supprimerOffres_Utilisateur as $offre) {
                        $offre->forceDelete();
                    }
                $suprimer_utilisateur->forceDelete();
                flash('Vous avez supprimé définitivement un recruteur avec ses offres.')->success();
                return redirect()->route('corbeille-admin');
             }
            else{
                $suprimer_utilisateur->forceDelete();
                flash('Vous avez supprimé définitivement un candidat.')->success();
                return redirect()->route('corbeilleadmin-candidate');
            }
    }


    public function resatureoffres_admin(int $id){
        if (!Auth::check()){
            return redirect()->route('pageconnexion');
        }
         $offre = Offre::withTrashed()->findOrFail($id);
         $verif_recrueteur =user::withTrashed()
                                  ->where('users.id' ,$offre->recruteur_id)
                                  ->whereNull('deleted_at')
                                  ->first();
         if($verif_recrueteur){
             $offre->restore();
             flash("vous avez restaurer une offre", $offre->titreOffre )->success();
             return redirect()->route('corbeilleadmin-offres');
         }
         else{
             flash("Impossible de restaurer l'offre : le recruteur n'existe plus ou est supprimé.")->error();
             return redirect()->route('corbeilleadmin-offres');
         }

    }
    public function supprimeroffres_admin(int $id){
         if (!Auth::check()){
            return redirect()->route('pageconnexion');
        }
          $offre = Offre::withTrashed()->findOrFail($id);
         $offre->forceDelete();
         flash("Vous avez supprimé définitivement l 'offre : " . $offre->titreOffre )->success();
        return redirect()->route('corbeilleadmin-offres');
    }





    public function information_admin(){
         if (!Auth::check()){
            return redirect()->route('pageconnexion');
        }
        $ids = Auth::user()->id;
         $info_admin = user::where('users.id' ,$ids)->first();
         return  view('profil.information-admin' , compact('info_admin'));
    }


    public function modif_informationAdmin(){
        if (!Auth::check()){
            return redirect()->route('pageconnexion');
        }
        $ids = Auth::user()->id;
        $info_admin = user::where('users.id' ,$ids)->first();
        return view('profil.modifInformation-admin',compact('info_admin'));
    }



    public  function modifier_informationAdmin(Request $request){
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
            return redirect()->route('information-admin');
        }
    }

    public function photo_admin(){
       if(!Auth::check()) {
           flash('Désolé, votre session a expiré. Veuillez vous reconnecter')->error();
           return view('auth.page-connexion');
        }
        $ids = Auth::user()->id;
        $info_admin = user::select('nom' ,'prenom' ,'photo')
                           ->where('users.id' ,$ids)->first();
        return view('profil.photo-admin' , compact('info_admin'));
    }

    public function modif_photo_Admin(Request $request){
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
                        return redirect()->route('information-admin');
            }


    public function liste_candidatue_admin(){
        if(!Auth::check()) {
           flash('Désolé, votre session a expiré. Veuillez vous reconnecter')->error();
           return view('auth.page-connexion');
        }
         $candidatures = DB::table('candidatures')
                        ->join('offres', 'candidatures.id_offre', '=', 'offres.id')
                        ->join('users', 'candidatures.id_candidat', '=', 'users.id')
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
        $ids = Auth::user()->id;
        $info_admin = user::select('nom' ,'prenom' ,'photo')
                           ->where('users.id' ,$ids)->first();

        return view('gestion-candidature.liste-candidature-admin' ,compact('info_admin' ,'candidatures'));
    }




}
