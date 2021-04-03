<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PdoGsb;
use MyDate;
class etatFraisController extends Controller
{


    function selectionnerMois(){
        if(session('visiteur') != null){
            $visiteur = session('visiteur');
            $idVisiteur = $visiteur['id'];
            $lesMois = PdoGsb::getLesMoisDisponibles($idVisiteur);
		    // Afin de sélectionner par défaut le dernier mois dans la zone de liste
		    // on demande toutes les clés, et on prend la première,
		    // les mois étant triés décroissants
		    $lesCles = array_keys( $lesMois );
		    $moisASelectionner = $lesCles[0];
            return view('listemois')
                        ->with('lesMois', $lesMois)
                        ->with('leMois', $moisASelectionner)
                        ->with('visiteur',$visiteur);
        }
        else{
            return view('connexion')->with('erreurs',null);
        }

    }

    function voirFrais(Request $request){
        if( session('visiteur')!= null){
            $visiteur = session('visiteur');
            $idVisiteur = $visiteur['id'];
            $leMois = $request['lstMois']; 
		    $lesMois = PdoGsb::getLesMoisDisponibles($idVisiteur);
            $lesFraisForfait = PdoGsb::getLesFraisForfait($idVisiteur,$leMois);
            $lesInfosFicheFrais = PdoGsb::getLesInfosFicheFrais($idVisiteur,$leMois);
		    $numAnnee = MyDate::extraireAnnee( $leMois);
		    $numMois = MyDate::extraireMois( $leMois);
		    $libEtat = $lesInfosFicheFrais['libEtat'];
		    $montantValide = $lesInfosFicheFrais['montantValide'];
            $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
            $dateModif =  $lesInfosFicheFrais['dateModif'];
            $lesMois = PdoGsb::getLesMoisDisponibles($visiteur);
		    // Afin de sélectionner par défaut le dernier mois dans la zone de liste
		    // on demande toutes les clés, et on prend la première,
		    // les mois étant triés décroissants
		    $lesCles = array_keys( $lesMois );
		    $moisASelectionner = $lesCles[0];
            $dateModifFr = MyDate::getFormatFrançais($dateModif);
            $vue = view('listefrais')->with('lesMois', $lesMois)
                    ->with('leMois', $leMois)->with('numAnnee',$numAnnee)
                    ->with('numMois',$numMois)->with('libEtat',$libEtat)
                    ->with('montantValide',$montantValide)
                    ->with('nbJustificatifs',$nbJustificatifs)
                    ->with('dateModif',$dateModifFr)
                    ->with('lesFraisForfait',$lesFraisForfait)
                    ->with('visiteur',$visiteur);
            return $vue;
        }
        else{
            return view('connexion')->with('erreurs',null);
        }
    }





    function formulaireValidation(){


        if(session('comptable') != null){
          
            $visiteurs = PdoGsb::getAllVisiteurs();
            $lesMois = PdoGsb::getAllMois();
		    // Afin de sélectionner par défaut le dernier mois dans la zone de liste
		    // on demande toutes les clés, et on prend la première,
		    // les mois étant triés décroissants
		    $lesCles = array_keys( $lesMois );
		    $moisASelectionner = $lesCles[0];
            
		    // Afin de sélectionner par défaut le dernier mois dans la zone de liste
		    // on demande toutes les clés, et on prend la première,
		    // les mois étant triés décroissants
		  
            return view('formulaireValidationFrai')
                        ->with('visiteurs', $visiteurs)
                        ->with('lesMois', $lesMois)
                        ->with('leMois', $moisASelectionner)
                        ->with('comptable',session('comptable'));
                       
        }
        else{
            return view('connexion')->with('erreurs',null);
        }
    }


    function afficherFiche (Request $request){
        $visiteurs = PdoGsb::getAllVisiteurs();

        $visiteur = $request['visiteur']; 
        $mois = $request['mois']; 
        $lesInfosFicheFrais = PdoGsb::getLesInfosFicheFrais($visiteur,$mois);
        $numAnnee = MyDate::extraireAnnee( $mois);
        $numMois = MyDate::extraireMois( $mois);
        $libEtat = $lesInfosFicheFrais['libEtat'];
        $montantValide = $lesInfosFicheFrais['montantValide'];
        $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
        $dateModif =  $lesInfosFicheFrais['dateModif'];
        $dateModifFr = MyDate::getFormatFrançais($dateModif);
        $lesFraisForfait = PdoGsb::getLesFraisForfait($visiteur,$mois);

        $lesMois = PdoGsb::getAllMois();
        // Afin de sélectionner par défaut le dernier mois dans la zone de liste
        // on demande toutes les clés, et on prend la première,
        // les mois étant triés décroissants
        $lesCles = array_keys( $lesMois );
        $moisASelectionner = $lesCles[0];
        
/*
        $vue = view('visualiserFraisVisiteur')
                ->with('leMois', $mois)->with('numAnnee',$numAnnee)
                ->with('numMois',$numMois)->with('libEtat',$libEtat)
                ->with('montantValide',$montantValide)
                ->with('nbJustificatifs',$nbJustificatifs)
                ->with('dateModif',$dateModifFr)
                ->with('lesFraisForfait',$lesFraisForfait)
                ->with('visiteur',$visiteur);
*/
return view('visualiserFraisVisiteur')
//->with('erreurs',null)                       
 ->with('visiteurs', $visiteurs)
 
 ->with('leMois', $mois)->with('numAnnee',$numAnnee)
 ->with('numMois',$numMois)->with('libEtat',$libEtat)
 ->with('montantValide',$montantValide)
 ->with('nbJustificatifs',$nbJustificatifs)
 ->with('dateModif',$dateModifFr)
 ->with('lesFraisForfait',$lesFraisForfait)
 ->with('visiteur',$visiteur)
 ->with('lesMois', $lesMois)
 ->with('leMois', $moisASelectionner)
 
 ->with('comptable',session('comptable'));


    }



    public function validerFiche($visiteur, $mois){
        //do stuffs here with $prisw and $secsw
        $visiteurs = PdoGsb::getAllVisiteurs();
        $fichefrai=PdoGsb::getLesInfosFicheFrais($visiteur,$mois);
        $res=PdoGsb::majEtatFicheFrais($visiteur,$mois,"VA",$fichefrai['montantValide']);

        $lesInfosFicheFrais = PdoGsb::getLesInfosFicheFrais($visiteur,$mois);
        $numAnnee = MyDate::extraireAnnee( $mois);
        $numMois = MyDate::extraireMois( $mois);
        $libEtat = $lesInfosFicheFrais['libEtat'];
        $montantValide = $lesInfosFicheFrais['montantValide'];
        $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
        $dateModif =  $lesInfosFicheFrais['dateModif'];
        $dateModifFr = MyDate::getFormatFrançais($dateModif);
        $lesFraisForfait = PdoGsb::getLesFraisForfait($visiteur,$mois);

        $lesMois = PdoGsb::getAllMois();
        $lesCles = array_keys( $lesMois );
        $moisASelectionner = $lesCles[0];

        return view('MisAjourFicheFrai')
        ->with('visiteurs', $visiteurs)
        ->with('lesMois', $lesMois)
 
        ->with('leMois', $mois)
        ->with('numAnnee',$numAnnee)
        ->with('numMois',$numMois)->with('libEtat',$libEtat)
        ->with('montantValide',$montantValide)
        ->with('nbJustificatifs',$nbJustificatifs)
        ->with('dateModif',$dateModifFr)
        ->with('lesFraisForfait',$lesFraisForfait)
        ->with('visiteur',$visiteur)
        ->with('lesMois', $lesMois)
        ->with('leMois', $moisASelectionner)
        ->with('comptable',session('comptable'));


     }
}