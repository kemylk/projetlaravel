<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PdoGsb;
use DateTime;
//use MyDate;


class gererMotDePasseController extends Controller
{
    function saisirMdp(Request $request){
        if(session('visiteur') != null){
            $visiteur = session('visiteur');
            $view = view('majMdp')
                    ->with('visiteur',$visiteur)
                    ->with('message', "")
                    ->with('erreurs',null);
            return $view;
        }
        else{
            return view('connexion')->with('erreurs', null);
        }
    }

    function sauvegarderMdp(Request $request){
        if(session('visiteur') != null){
            $visiteur = session('visiteur');
            $idVisiteur = $visiteur['id'];
            $dateEmbaucheReelle = $visiteur['dateEmbauche'];
            $dateEmbaucheSaisie = new DateTime($request['dateEmbauche']);
            $dateEmbaucheSaisie = $dateEmbaucheSaisie->format('Y-m-d');
            $nvxMdp = "";
            $view = view('majMdp')
            ->with('visiteur', $visiteur)
            ->with('idVisiteur', $idVisiteur)
            ->with('dateEmbaucheSaisie', $dateEmbaucheSaisie)
            ->with('nvxMdp', $nvxMdp);
            if(isset($_POST['btn1']))
            {
                if($dateEmbaucheSaisie == $dateEmbaucheReelle && $_POST['mdp1'] == $_POST['mdp2'])
                {
                    $nvxMdp = $_POST['mdp2'];
                    $message = "Votre mot de passe a été mis à jour";
                    $erreurs = null;  
                    PdoGsb::saveNvxMotDePasse($nvxMdp, $dateEmbaucheSaisie ,$idVisiteur);   
                }                
                if($_POST['mdp1'] != $_POST['mdp2'])
                {                 
                    $erreurs[] ="Les mots de passe saisis ne sont pas identiques";
                    $message = '';
                }
                if($dateEmbaucheSaisie != $dateEmbaucheReelle)
                {
                    $erreurs[] ="La date saisie ne correspond pas à votre date d'embauche";
                    $message = '';                       
                }                                 
            }
            //VERSION PROF
            // $erreur = 0;
            // if($_POST['mdp1'] != $_POST['mdp2'])
            // {
            //     $erreurs[] ="Les mots de passe saisis ne sont pas identiques";
            //     $erreur = 1;
            // }
            // if($dateEmbaucheSaisie != $dateEmbaucheReelle)
            // {
            //     $erreurs[] ="La date saisie ne correspond pas à votre date d'embauche";
            //     $erreur = 1;
            // }
            // if($erreur == 0)
            // {
            //     $message = "Votre mot de passe a été mis à jour";
            // }

            return $view
                    ->with('erreurs',$erreurs)
                    ->with('message',$message);
        }
        else{
            return view('connexion')->with('erreurs', null);
        }
    }


}
