<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ConnexionController extends Controller
{
    public function page_connexion(){

        return view('auth.page-connexion');
    }



    public function page_inscription (){
             return view('auth.page-inscription');
    }




    public function profil_utilisateur(Request $request){
                request()->validate([
                    'email'=>['required', 'email'],
                    'password'=>['required', 'min:8'],
                ] ,[
                    'password.min' => 'Pour des raisons de sécurité, votre mot de passe doit contenir au moins :min caractères.',
                ]);
                $email = $request->input('email');
                $pass= $request->input('password');

                if($result =Auth::attempt(['email' => $email, 'password' => $pass,'role_id' =>1 ])){
                     if(session()->has('reidcte-candidat-offrepage')){
                                $redirect = session('reidcte-candidat-offrepage');
                                session()->forget('reidcte-candidat-offrepage');
                                return redirect($redirect);
                    }
                   if(session()->has('reidcte-candidat')){
                                $redir = session('reidcte-candidat');
                                session()->forget('reidcte-candidat');
                                return redirect($redir);
                    }
                    return redirect()->route('profilcandidat');
                }
                else if($result =Auth::attempt(['email' => $email, 'password' => $pass,'role_id' =>2 ])){
                        if(session()->has('reidcte-candidat-offrepage')){
                                    $redirect = session('reidcte-candidat-offrepage');
                                    return redirect($redirect);
                            }

                        if(session()->has('reidcte-candidat')){
                                    $redir  = session('reidcte-candidat');
                                    return redirect($redir);
                        }
                        return redirect()->route('profilrecruteur');
                    }

                else if(Auth::attempt(['email' => $email, 'password' => $pass,'role_id' =>3 ])){
                    return redirect()->route('profiladmin');
                }

                else{
                    flash(' le mail ou le mot de passe  sont incorrecte veillez ressayer !')->error();
                    return redirect()->back()->withInput();
                }
    }




    public function deconnexion_profil(){
        $result =Auth::logout();
        return redirect()->route('accueil');
    }




}
