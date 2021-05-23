<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

        /*-------------------- Use case connexion---------------------------*/
Route::get('/',[
        'as' => 'chemin_connexion',
        'uses' => 'connexionController@connecter'
]);

Route::post('/',[
        'as'=>'chemin_valider',
        'uses'=>'connexionController@valider'
]);



Route::get('deconnexion',[
        'as'=>'chemin_deconnexion',
        'uses'=>'connexionController@deconnecter'
]);




/*

use case connexion , deconnexion comptable
*/

Route::get('/connexionComptable',[
        'as' => 'connexion_comptable',
        'uses' => 'connexionController@connexionComptable'
]);


Route::post('/connexionComptable',[
        'as'=>'comptable_valider',
        'uses'=>'connexionController@comptableValider'
]);

Route::get('deconnexionComptable',[
        'as'=>'chemin_deconnexion_comptable',
        'uses'=>'connexionController@deconnecterComptable'
]);





/* use case compte */



//formulaire de validation
Route::get('validerFeuillesdefrai',[
'as'=>'validerFeuillesdefrai',
'uses'=>'etatFraisController@formulaireValidation'
]);


//afficher la fiche frais une fois le formulaire remplis
Route::post('afficher_fiche',[
        'as'=>'afficher_fiche',
        'uses'=>'etatFraisController@afficherFiche'
        ]);



//valider la fiche de frais selectionnes
Route::get('/validerFiche/{visiteur}/{mois}',[
        'uses' => 'etatFraisController@validerFiche',
        'as'   => 'validerFiche'
]);


//afficher le formulaire de modification
Route::get('/modifier/{visiteur}/{mois}',[
        'uses' => 'etatFraisController@modifier',
        'as'   => 'modifier'
    ]);


//valide ce formulaire de modification
Route::post("/modifier/succes",[
        'uses'=>'etatFraisController@ValiderModification',
        'as'=>'modifsucces'
]);





        
/*-------------------- Use case état des frais---------------------------*/
Route::get('selectionMois',[
        'as'=>'chemin_selectionMois',
        'uses'=>'etatFraisController@selectionnerMois'
]);

Route::post('listeFrais',[
        'as'=>'chemin_listeFrais',
        'uses'=>'etatFraisController@voirFrais'
]);

        /*-------------------- Use case gérer les frais---------------------------*/

Route::get('gererFrais',[
        'as'=>'chemin_gestionFrais',
        'uses'=>'gererFraisController@saisirFrais'
]);

Route::post('sauvegarderFrais',[
        'as'=>'chemin_sauvegardeFrais',
        'uses'=>'gererFraisController@sauvegarderFrais'
]);

        /*-------------------- ROUTE TESTS ---------------------------*/


Route::get('test', [
        'as' => 'chemin_test',
        'uses' => 'testController@tester'
]);


        /*-------------------- ROUTE MODIFIER MOT DE PASSE ---------------------------*/


Route::get('gererMdp', [
        'as' => 'chemin_gestionMdp',
        'uses' => 'gererMotDePasseController@saisirMdp'
]);

Route::post('sauvegarderMdp', [
        'as' => 'chemin_sauvegardeMdp',
        'uses' => 'gererMotDePasseController@sauvegarderMdp'
]);