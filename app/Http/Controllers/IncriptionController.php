<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\Mailutilisateur;
use App\Mail\Mailverifycation;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use function PHPUnit\Framework\returnSelf;

class IncriptionController extends Controller
{

    public function page_inscription(){
         return view('auth.page-inscription');
    }

    public function traiter_inscription(Request $request){
        $request->validate([
            'email'=>['required' , 'email'],
            'password'=>['required', 'min:8' ,'confirmed'],
            'password_confirmation'=>['required'],
        ],[
            'password.min' => 'pour des raison de securite, votre mot de passe doit faire:min catractere',
            'password.confirmed' => 'Veuillez saisir le même mot de passe pour confirmation'
        ]);
        $result = User::withTrashed()
                        ->where('email', $request->input('email'))
                        ->first();
        if($result){
            flash('Cette adresse e-mail existe déjà dans notre base de données.')->error();
            return  redirect()->back()->withInput();
        }
        $token = Str::random(40);
        session(['donner'=>[
               'email' =>$request->input('email'),
                'mot-passe' =>$request->input('password'),
                'token' => $token,
        ]]);

        $verificationUrl = route('infoperso', ['token' => $token]);
        mail::to($request->input('email'))->send(new Mailverifycation($verificationUrl));
        flash('Un e-mail de vérification a été envoyé à votre adresse e-mail. Veuillez vérifier votre boîte de réception pour continuer.')->success();
        return back()->with('success', 'Un e-mail de vérification a été envoyé à votre adresse e-mail.');
    }


    public function showInfoPerso($token){
                $donner = session('donner');

                if (!$donner || !isset($donner['token']) || $donner['token'] !== $token) {
                    abort(404);
                }

                return view('inscription.info-perso', ['token' => $token]);
            }
   /*/*   public function info_perso(Request $request){
          return  'bonjour';
    } */
    public function choix_role(Request $request){
          $request->validate([
                 'prenom'    => ['required'],
                  'nom'    => ['required'],
                   'telephone'    => ['required'],
                    'ville'    => ['required'],
            ],[

                'required' => 'veiller remplire ce champs merci'
            ]);
            session(['donnersPersonne'=>
                      [
                           'prenom' => $request->input('prenom'),
                           'nom' => $request->input('nom'),
                           'telephone' => $request->input('telephone'),
                            'ville' => $request->input('ville'),
                            'adresse' => $request->input('adresse'),
                      ]]);

        return view('inscription.choix-role');
    }
    public function info_entreprise(){
            session(['recruteurRole' => 2]);
            return view('inscription.info-entreprise');
    }
    public function ajouter_cv(){
        return view('inscription.ajouter-cv');
    }
    public function enrengistre_recruteur(Request $request){
        $mail_recruteur= session('donner.email');
        $nom=session('donnersPersonne.nom');
        $prenom = session('donnersPersonne.prenom');
        User::create([
              'prenom'=>session('donnersPersonne.prenom'),
              'nom' =>session('donnersPersonne.nom'),
              'email'=> session('donner.email'),
              'password'=> bcrypt(session('donner.mot-passe')),
              'ville' => session('donnersPersonne.ville'),
              'adresse' =>session('donnersPersonne.adresse'),
              'telephone' => session('donnersPersonne.telephone'),
              'nom-entreprise' => $request->input('nom-entreprise'),
              'fonction-entreprise' => $request->input('fonction-entreprise'),
              'taille-entreprise' => $request->input('taille-entreprise'),
              'role_id' => session('recruteurRole'),
        ]);
        Mail::to($mail_recruteur)->send(new Mailutilisateur($nom , $prenom ));
        session()->forget(['donnersPersonne', 'donner', 'recruteurRole']);
        flash('vous avez creer un compte veillez vous connecter avec votre mail et le mot de passe pour acceder avotre comptre')->success();
        return view('auth.page-connexion');
 }
 public function enrengistre_candidat(Request $request){

     $request->validate([
         'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
      ], [
            'cv.required' => 'Veuillez choisir votre CV.',
            'cv.file' => 'Seuls les fichiers PDF, DOC ou DOCX sont autorisés.',
            'cv.mimes' => 'Le fichier doit être un PDF, DOC ou DOCX.',
            'cv.max' => 'La taille du fichier ne doit pas dépasser 2 Mo.',
      ]);

      $path = $request->file('cv')->store('cvs' ,'public');
      $mail_candidat= session('donner.email');
      $nom=session('donnersPersonne.nom');
      $prenom = session('donnersPersonne.prenom');


      User::create([
              'prenom'=>session('donnersPersonne.prenom'),
              'nom' =>session('donnersPersonne.nom'),
              'email'=> session('donner.email'),
              'password'=> bcrypt(session('donner.mot-passe')),
              'ville' => session('donnersPersonne.ville'),
              'adresse' =>session('donnersPersonne.adresse'),
              'telephone' => session('donnersPersonne.telephone'),
              'nom-entreprise' => $request->input('nom-entreprise'),
              'fonction-entreprise' => $request->input('fonction-entreprise'),
              'taille-entreprise' => $request->input('taille-entreprise'),
              'role_id' => 1,
              'cv' =>$path,
        ]);

       Mail::to($mail_candidat)->send(new Mailutilisateur($nom , $prenom ));
       session()->forget(['donnersPersonne', 'donner', 'recruteurRole']);
       flash('vous avez creer un compte veillez vous connecter avec votre mail et le mot de passe pour acceder avotre comptre')->success();
       return view('auth.page-connexion');
   }
   public function precedent_infoperso(){
       return  view('inscription.info-perso');
   }
   public function precedent_page_inscription(){
        return view('auth.page-inscription');
   }

   public function precedent_choix_role(){
        return view('inscription.choix-role');
   }
}
