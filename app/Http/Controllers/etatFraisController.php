<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use PdoGsb;
use MyDate;
use Session;

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




    /*

    methode appele pour affiche les fiches frais

    */
    function afficherFiche (Request $request){

        $visiteur = $request['visiteur']; 
        $mois = $request['mois']; 
        $lesInfosFicheFrais = PdoGsb::getLesInfosFicheFrais($visiteur,$mois);


        $visiteurs = PdoGsb::getAllVisiteurs();
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
        
session(['idVisiteur' => $visiteur]);
session(['mois' => $mois]);

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


    public function modifier($visiteur,$mois){

        $lignefrais=PdoGsb::getLigneFraisForfait($visiteur,$mois);

        return view("miseajour")
        ->with("ligne",$lignefrais)
        ->with("visiteur",$visiteur)
        ->with("mois",$mois)
        ->with('comptable',session('comptable'));


    }



    public function ValiderModification(){
        if(session('idVisiteur') != null){
             $visiteur=session('idVisiteur');
        }
        if(session('mois') != null){
            $mois=session('mois');
       }
        $data = request()->all();
        $lignes=[];
        $cpt=0;
        foreach ($data as $key) {
            if($cpt !=0){
                $parts = explode(':', $key);
                $id = $parts[0];
                $qt = $parts[1];
                $lignes[$id]=$qt;
                $cpt++;
            }else{
                $cpt++;
            }

        
        
        }

        
        PdoGsb::majFraisForfait($visiteur,$mois,$lignes);
        return view('succesMaj') 
        ->with('comptable',session('comptable'))
        ->with('visiteur',$visiteur)
        ->with('mois',$mois);




        
    }
    public function validerFiche($visiteur, $mois){
        //do stuffs here with $prisw and $secsw
        $visiteurs = PdoGsb::getAllVisiteurs();
        $fichefrai=PdoGsb::getLesInfosFicheFrais($visiteur,$mois);


        //calcule montant

        //mdofiie la valeur du montant dans fiche frai

        $tab=PdoGsb::getLesFraisForfait($visiteur,$mois);


        //print_r($tab);

        $index=-1;
        $montant=0;
        foreach($tab as $element){
            $index++;
            foreach($element as $cle => $valeur){

                $index++;
                
                if($index == 9 || $index == 20
                || $index == 31 || $index == 42
               ){
                $montant = $montant + $valeur;
                   
             //   print($index."  = ".$cle." ".$valeur);
               // echo "<br>";
                }

            }
        }

       // echo $montant;

        $fichefrai['montantValide']=$montant;
        //echo "<br>";

       // echo $visiteur;
       // echo '<br/>';
       // echo $mois;

        //print_r($fichefrai);
        


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