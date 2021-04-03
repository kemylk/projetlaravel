<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PdoGsb;

class connexionController extends Controller
{
    function connecter(){
        
        return view('connexion')->with('erreurs',null);
    } 

  
    
    function valider(Request $request){
        $login = $request['login'];
        $mdp = $request['mdp'];
        $visiteur = PdoGsb::getInfosVisiteur($login,$mdp);
        if(!is_array($visiteur)){
            $erreurs[] = "Login ou mot de passe incorrect(s)";
            return view('connexion')->with('erreurs',$erreurs);
        }
        else{
            session(['visiteur' => $visiteur]);
            return view('sommaire')->with('visiteur',session('visiteur'));
        }
    } 



    function deconnecter(){
        session(['visiteur' => null]);

        return redirect()->route('chemin_connexion');
}


    function connexionComptable(){
        return view('connexionComptable')->with('erreurs',null);

    }

   function  comptableValider (Request $request){
    $login = $request['login'];
    $mdp = $request['mdp'];
    $comptable = PdoGsb::getInfoComptable($login,$mdp);
    if(!is_array($comptable)){
        $erreurs[] = "Login ou mot de passe incorrect(s)";
        return view('connexion')->with('erreurs',$erreurs);
    }
    else{
        session(['comptable' => $comptable]);
        return view('sommaireComptable')->with('comptable',session('comptable'));
    }
    }

    function deconnecterComptable(){
        session(['comptable' => null]);
        return redirect()->route('connexion_comptable');
    }

 
       
}
