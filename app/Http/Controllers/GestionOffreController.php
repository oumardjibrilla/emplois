<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Offre;
use Illuminate\Http\Request;
use App\Mail\Mailutilisateur;
use App\Mail\offresMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use DASPRiD\Enum\Exception\IllegalArgumentException;


class GestionOffreController
{
        public function gestion_offres(){
             if (!Auth::check()){
                 return redirect()->route('pageconnexion');
              }
            return view('profil.ajout-offres-recruteur');
        }




        public function ajouter_offres(Request $request){
             if (!Auth::check()){
                   return redirect()->route('pageconnexion');
              }
            request()->validate([
                'titre'=>['required'],
                'type'=>['required'],
                'lieu'=>['required'],
                'description'=>['required'],
                'titre'=>['required'],
            ]);
            $utilisateur = Auth::user();
            if($utilisateur->role_id !=2){
                flash('veiller vous connecter pour pouvoir postuler des offres !')->error();
                return view('auth.page-connexion');
            }
            Offre::create([
                 'recruteur_id'=> $utilisateur->id,
                 'titreOffre' => $request->input('titre'),
                 'lieuOffre' => $request->input('lieu'),
                 'typecontrat_Offre' => $request->input('type'),
                 'descriptionOffres' => $request->input('description'),
                 'salaire' => $request->input('salaire'),
                 'dateExpiration' =>$request->input('dateExpiration'),
            ]);
            flash("votre offre est en attente avant d'etre publier")->success();
            $titre = $request->input('titre');
            $prenom = $utilisateur->prenom;
            Mail::to($utilisateur->email)->send(new offresMail($prenom ,$titre ));
            return redirect()->route('gestion-offres');
        }





        public function listeOffres_recruteur(){
             if (!Auth::check()){
                   return redirect()->route('pageconnexion');
              }
             $id_users = Auth::user()->id;

             $offress= user::join('offres','offres.recruteur_id', '=','users.id')
                              ->select('offres.*','users.email' ,'users.prenom','users.nom' ,'users.photo')
                              ->where('offres.status', '=' ,'en attente')
                              ->where('users.id','=',$id_users)
                              ->whereNull('offres.deleted_at')->get();
            /* dump($offress); */
            return view('profil.listeOffre-recruteur',compact('offress'));
        }

          // la methode des offres en attente
     public function listeOffreattente_admin(){
         if (!Auth::check()){
            return redirect()->route('pageconnexion');
        }
         $offres = Offre::join('users','offres.recruteur_id','=','users.id')
                         -> select('offres.descriptionOffres','offres.titreOffre','offres.lieuOffre','offres.id',
                                       'offres.dateEXPIRATION','users.nom-entreprise','users.email')
                         -> where('status', 'en attente')
                         ->whereNull('offres.deleted_at')->get();
        return view('gestion-offres.listeOffresAttente-Admin' ,compact('offres') );
     }

     public function offresrejette_admin(){
         if (!Auth::check()){
            return redirect()->route('pageconnexion');
        }
          $id_users = Auth::user()->id;
         $offres = Offre::join('users','offres.recruteur_id','=','users.id')
                         -> select('offres.descriptionOffres','offres.titreOffre','offres.lieuOffre','offres.id',
                                       'offres.dateEXPIRATION','users.nom-entreprise','users.email')
                         -> where('status', 'refuser')
                         ->whereNull('offres.deleted_at')->get();
         $info_admin = user::select('nom' , 'prenom' ,'photo')
                             ->where('users.id' , $id_users )->first();
        return view('gestion-offres.offresrejette-admin' ,compact('offres' ,'info_admin') );
     }

     public function OffresValider_recruteur(){
         if (!Auth::check()){
            return redirect()->route('pageconnexion');
        }
             $id_users = Auth::user()->id;
             $offress= user::join('offres','offres.recruteur_id', '=','users.id')
                              ->select('offres.*','users.email' ,'users.prenom','users.nom' ,'users.photo')
                              ->where('offres.status', '=' ,'valider')
                              ->where('users.id','=',$id_users)
                              ->whereNull('offres.deleted_at')->get();


             return view('profil.validerOffre-recruteur',compact('offress'));
     }

     public function OffresRejetter_recruteur(){
         if (!Auth::check()){
            return redirect()->route('pageconnexion');
        }
             $id_users = Auth::user()->id;
             $offress= user::join('offres','offres.recruteur_id', '=','users.id')
                              ->select('offres.*','users.email' ,'users.prenom','users.nom'  ,'users.photo')
                              ->where('offres.status', '=' ,'refuser')
                              ->where('users.id','=',$id_users)
                              ->whereNull('offres.deleted_at')->get();


             return view('profil.rejetterOffre-recruteur',compact('offress'));
     }

     public function nodifOffres_recruteur(int $ids){
         if (!Auth::check()){
            return redirect()->route('pageconnexion');
        }
              $offres_modif= Offre::find($ids);
              $sup = 0;
              if($offres_modif->status =="refuser"){
                $sup = 1;
              }
             return view('profil.modifOffre-recruteur' , compact('offres_modif' , 'sup'));
     }


     public function modif_offres(Request $request , $ids){
         if (!Auth::check()){
            return redirect()->route('pageconnexion');
        }
          request()->validate([
                'titre'=>['required'],
                'type'=>['required'],
                'lieu'=>['required'],
                'description'=>['required'],
                'titre'=>['required'],
          ]);
         $modifierOffres = Offre::find($ids);

       if($modifierOffres->status == "valider" and $modifierOffres ){
            $modifierOffres->titreOffre = $request->input('titre');
            $modifierOffres->lieuOffre = $request->input('lieu');
            $modifierOffres->typecontrat_Offre = $request->input('type');
            $modifierOffres->descriptionOffres = $request->input('description');
            $modifierOffres->dateExpiration = $request->input('dateExpiration');
            $modifierOffres->save();
             flash("vous avez modifier une offre deja valide")->success();
             return redirect()->route('OffreValider-recruteur');
       }
        else if($modifierOffres->status == "en attente" and $modifierOffres){
            $modifierOffres->titreOffre = $request->input('titre');
            $modifierOffres->lieuOffre = $request->input('lieu');
            $modifierOffres->typecontrat_Offre = $request->input('type');
            $modifierOffres->descriptionOffres = $request->input('description');
            $modifierOffres->dateExpiration = $request->input('dateExpiration');
            $modifierOffres->save();
             flash("vous avez modifier une offre deja valide")->success();
             return redirect()->route('liste-offres-recruteur');
       }
       else {
            $modifierOffres->titreOffre = $request->input('titre');
            $modifierOffres->lieuOffre = $request->input('lieu');
            $modifierOffres->typecontrat_Offre = $request->input('type');
            $modifierOffres->descriptionOffres = $request->input('description');
            $modifierOffres->dateExpiration = $request->input('dateExpiration');
            $modifierOffres->status ='en attente';
            $modifierOffres->save();
             flash("vous avez modifier une offre deja rejetterS")->success();
             return redirect()->route('OffreRejetter-recruteur');
        }
     }

     public function corbeille_recruteur(){
        $id_users = Auth::user()->id;
        $offress = Offre::onlyTrashed() // récupère uniquement les soft deleted
                        ->where('recruteur_id', $id_users)
                        ->get();
         $info_admin = user::select('nom' , 'prenom' ,'photo')
                             ->where('users.id' , $id_users)->first();
        return view('profil.corbeille-recruteur' ,compact('offress' ,'info_admin'));
     }

     public function supprimerOffres_recruteur(int $id){
         $offre = Offre::findOrFail($id);
         $offre->delete();
         if($offre and $offre->status == "valider"){
          flash("vous avez supprimer une offre ")->success();
            return redirect()->route('OffreValider-recruteur');
         }
         else{
           flash("vous avez supprimer une offre")->success();
            return redirect()->route('OffreRejetter-recruteur');
         }

     }

     public function restaurerOffres_recruteur(int $id){
         if (!Auth::check()){
            return redirect()->route('pageconnexion');
        }
        $offre = Offre::withTrashed()->findOrFail($id);
        $offre->restore();
        flash("vous avez restaurer l'offre", $offre->titreOffre )->success();
        return redirect()->route('corbeille-recruteur');
     }
     public function supprimerdefinitif_offres(int $id){
         if (!Auth::check()){
            return redirect()->route('pageconnexion');
        }
            $offre = Offre::withTrashed()->findOrFail($id);
            $offre->forceDelete();
            flash("vous avez supprimer l'offre", $offre->titreOffre )->success();
            return redirect()->route('corbeille-recruteur');
     }
}
