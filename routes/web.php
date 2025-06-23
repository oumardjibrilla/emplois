<?php

use Dom\Attr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\IncriptionController;
use App\Http\Controllers\GestionOffreController;

//les routes qui sont dans le controller homecontroller

Route::get('/',[HomeController::class,'home'])->name('accueil');

route::get('/page-offres' , [HomeController::class ,'page_offres'])->name('page-offres');

route::post('/odif-pass' ,[HomeController::class , 'modif_passcandidat'])->name('modif-pass-candidat');

route::post('/modif-photo-recruteur' ,[HomeController::class ,'modif_photo_recruteur'])->name('modif-photo-recruteur');

route::post('/modif_photo_candidat' ,[HomeController::class  ,'modif_photo_candidat'])->name('modif_photo_candidat');

route::get('/postuler/{id}' , [HomeController::class ,'postuler_candidature'])->name('postuler');

route::get('/information-recruteur' ,[HomeController::class ,'information_recruteur'])->name('information-recruteur');

route::post('/modif-pass-recrteur' ,[HomeController::class ,'modif_pass_recrteur'])->name('modif-pass-recrteur');

route::get('/modif-info-recruteur' ,[HomeController::class ,'modif_info_recruteur'])->name('modif-info-recruteur');

route::get('/voir-cv{id}' ,[HomeController::class ,'voir_cv'])->name('voir-cv');

route::post('/modifier-information-recruteur' ,[HomeController::class ,'modifier_information_recruteur'])->name('modifier-information-recruteur');

route::get('/detaille-offres/{id}' , [HomeController::class ,'detaille_offres'])->name('detaille-offres');

route::get('/photo-recruteur' ,[HomeController::class ,'photo_recruteur'])->name('photo-recruteur');

route::get('/information_personnelle' ,[HomeController::class ,'information_personnelle'])->name('information_personnelle');

Route::get('/profil-recruteur',[HomeController::class,'profil_Recruteur'])->name('profilrecruteur');

route::post('/changer-cv',[HomeController::class , 'changer_cv'])->name('changer-cv');

route::get('/info-personnelle' , [HomeController::class, 'info_personnelleModif'])->name('info-personnelleModif');

Route::get('/profil-candidat',[HomeController::class,'profil_candidat'])->name('profilcandidat');

Route::get('/profil-admin',[HomeController::class,'profil_admin'])->name('profiladmin');

route::get('/profil', [HomeController::class ,'profil_paga_acceille'])->name('profil-accuille');

route::get('/affiche_offres/{id}'  ,[HomeController::class , 'affiche_offres'])->name('affiche_offres');

route::get('/envoyer_candidature/{id}' , [HomeController::class , 'envoyer_candidature'])->name('envoyer_candidature');

route::get('/cv' ,[HomeController::class, 'cv_candidat'])->name('cv_candidat');

route::get('/photo_candidat' ,[HomeController::class , 'photo_candidat'])->name('photo_candidat');

route::post('/modifier-information' ,[HomeController::class ,'modifier_information'])->name('modifier-information');

route::get('/candidatures' ,[HomeController::class ,'mes_candidatures'])->name('mes-candidature');

// les routes qui sont dans le controller InscriptionController
route::get('/page-inscription',[IncriptionController::class,'page_inscription'])->name('pageinscription');

route::post('/traiter-inscription',[IncriptionController::class,'traiter_inscription'])->name('traiter-inscription');

Route::get('/info-perso/{token}', [IncriptionController::class, 'showInfoPerso'])->name('infoperso.show');

Route::post('/info-perso/{token}',[IncriptionController::class,'info_perso'])->name('infoperso');

Route::post('/choix-role',[IncriptionController::class,'choix_role'])->name('choix-role');

Route::get('/info_entreprise',[IncriptionController::class,'info_entreprise'])->name('info_entreprise');

route::post('/enrengistrement_recruteur' , [IncriptionController::class,'enrengistre_recruteur'])->name('enrengistre_recruteur');

route::post('/voir' , [IncriptionController::class,'enrengistre_candidat'])->name('enrengistre_candidat');

route::get('/info-perso', [IncriptionController::class,'precedent_infoperso'])->name('precedent_infoperso');

route::get('/choix-role', [IncriptionController::class,'precedent_choix_role'])->name('precedent_choix_role');

route::get('/ajouter-cv', [IncriptionController::class ,'ajouter_cv'])->name('ajouter-cv');

route::get('/page-inscription',[IncriptionController::class,'precedent_page_inscription'])->name('precedent_page_inscription');

// les routes qui sont dans le controller ConnexionController

Route::get('/page-connexion',[ConnexionController::class,'page_connexion'])->name('pageconnexion');

route::post('/profil_utilisateur' , [ConnexionController::class,'profil_utilisateur'])->name('profil_utilisateur');

Route::get('/accuille',[ConnexionController::class,'deconnexion_profil'])->name('deconnexion_profil');

Route::get('/inscription',[ConnexionController::class,'page_inscription'])->name('inscription');

route::get('/listeOffre',[AdminController::class ,"listeOffre_admin"])->name('listeOffre-admin');

// les route pour les page admin avec ces lien
route::get('/liste_candidats',[AdminController::class,'liste_candidats'])->name('liste_candidats');

route::get('/liste-candidatue-admin' ,[AdminController::class ,'liste_candidatue_admin'])->name('liste-candidatue-admin');

route::post('/modifier_informationAdmin' ,[AdminController::class  , 'modifier_informationAdmin'])->name('modifier_informationAdmin');

route::get('/modif-informationAdmin' ,[AdminController::class , 'modif_informationAdmin'])->name('modif-informationAdmin');

route::get('/information-admin' ,[AdminController::class ,'information_admin'])->name('information-admin');

route::get('/photo-admin' ,[AdminController::class  ,'photo_admin'])->name('photo-admin');

route::post('/modif_photo_Admin' ,[AdminController::class , 'modif_photo_Admin'])->name('modif_photo_Admin');

route::get('/liste_recruteur',[AdminController::class,'liste_recruteur'])->name('liste_recruteur');

route::get('/ajoutUtilisateur',[AdminController::class,'ajouter_utilisateur'])->name('ajouter_utilisateur');

route::get('/voir-candidature-recruteur' ,[HomeController::class ,'voir_candidature_recruteur'])->name('voir-candidature-recruteur');

route::get('/modif/{id}',[AdminController::class, 'modifoffre_status'])->name('modifStatus-offres');

route::get('/refuser-offres/{id}',[AdminController::class , 'refuser_offres'])->name('refuser-offres');

route::post('/ajoueterutilisateur-admin',[AdminController::class , 'ajoueterutilisateur_admin'])->name('ajoueterutilisateur-admin');

route::get('corbeille-admin' , [AdminController::class , 'corbeille_Admin'])->name('corbeille-admin');

route::get('/corbeilleadmin-candidate' , [AdminController::class , 'corbeilleadmin_candidate'])->name('corbeilleadmin-candidate');

route::get('/corbeilleadmin-offres' , [AdminController::class , 'corbeilleadmin_offres'])->name('corbeilleadmin-offres');

route::get('/resatureUtilisateur/{id}' , [AdminController::class  , 'resatureUtilisateur'])->name('resatureUtilisateur');

route::get('/suprimerDefinit-utilisateur/{id}' , [AdminController::class , 'suprimerDefinit_utilisateur'])->name('suprimerDefinit-utilisateur');

route::get('/supprimerUtilisateur/{id_utilisateur}' , [AdminController::class , 'supprimerUtilisateur'])->name('supprimerUtilisateur');

route::get('/supprimeerOffres-admin/{id}' , [AdminController::class , 'supprimeerOffres_admin'])->name('supprimeerOffres-admin');

route::get('/resatureoffres-admin/{id}' ,[AdminController::class  , 'resatureoffres_admin'])->name('resatureoffres-admin');

route::get('/supprimeroffres-admin{id}' ,[AdminController::class  , 'supprimeroffres_admin'])->name('supprimeroffres-admin');
// les route pour le controller gestion des offrs controller : Gestionoffres-controller

route::get('/gestion-offre' ,[GestionOffreController::class,'gestion_offres'])->name('gestion-offres');

Route::post('/ajouter-offres',[GestionOffreController::class,'ajouter_offres'])->name('ajouter-offres');

route::get('/liste',[GestionOffreController::class,'listeOffres_recruteur'])->name('liste-offres-recruteur');

route::get('/offresrejette-admin' , [GestionOffreController::class , 'offresrejette_admin'])->name('offresrejette-admin');

route::get('/listeOffreattente-admin',[GestionOffreController::class , 'listeOffreattente_admin'])->name('listeOffreattente-admin');

route::get('/OffreValider-recruteur' ,[GestionOffreController::class , 'OffresValider_recruteur'])->name('OffreValider-recruteur');

route::get('/OffreRejetter-recruteur' ,[GestionOffreController::class , 'OffresRejetter_recruteur'])->name('OffreRejetter-recruteur');

route::post('/modif-offres/{ids}' ,[GestionOffreController::class , 'modif_offres'])->name('modif-offres');

route::get('/modifOffre-recruteur/{id}' , [GestionOffreController::class , 'nodifOffres_recruteur'])->name('modifOffre-recruteur');

route::get('/corbeille-recruteur' , [GestionOffreController::class , 'corbeille_recruteur'])->name('corbeille-recruteur');

route::get('/supprimerOffres-recruteur/{id}',[GestionOffreController::class ,'supprimerOffres_recruteur'])->name('supprimerOffres-recruteur');

route::get('/restaurerOffres-recruteur/{id}' ,[GestionOffreController::class , 'restaurerOffres_recruteur'])->name('restaurerOffres-recruteur');

route::get('/supprimerdefinitif-offres/{id}' , [GestionOffreController::class , 'supprimerdefinitif_offres'])->name('supprimerdefinitif-offres');



/* une route pour les veryfication*/
/*
Auth::routes(['verify'=>true]); */


