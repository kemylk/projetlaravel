@extends ('sommaireComptable')
    @section('contenu1')
      <div id="contenu">
        <h2>validerFichedeFrai</h2>
        <h3>visiteurs Selectionne  : </h3>
      <form action="{{ route('afficher_fiche') }}" method="post">
        {{ csrf_field() }} <!-- laravel va ajouter un champ caché avec un token -->
        <div class="corpsForm">
        <p>
          <label for="visiteurs" >visiteurs : </label>
          <select id="visiteurs" name="visiteur">
              @foreach($visiteurs as $visiteur)
                 
                    <option value="{{ $visiteur['id'] }}">
                      {{ $visiteur['id']}}
                    </option>
                  
              @endforeach
          </select>
        </p>
        <p>
        <!--
          <label for="mois" >mois : </label>
          <select id="mois" name="mois">
                 
                    <option value="01">
                        01
                    </option>
                    <option value="02">
                        02
                    </option>
                    <option value="03">
                        03
                    </option>
                    <option value="04">
                        04
                    </option>
                    <option value="05">
                        05
                    </option>
                    <option value="06">
                        06
                    </option>
                    <option value="07">
                        07
                    </option>
                    <option value="08">
                        08
                    </option>
                    <option value="09">
                        09
                    </option>
                    <option value="10">
                        10
                    </option>
                    <option value="11">
                        11
                    </option>
                    <option value="12">
                        12
                    </option>
                  
                  
              
          </select>
          -->
          <label for="lstMois" >Mois : </label>
          <select id="lstMois" name="mois">
              @foreach($lesMois as $mois)
                  @if ($mois['mois'] == $leMois)
                    <option selected value="{{ $mois['mois'] }}">
                      {{ $mois['numMois']}}/{{$mois['numAnnee'] }} 
                    </option>
                  @else 
                    <option value="{{ $mois['mois'] }}">
                      {{ $mois['numMois']}}/{{$mois['numAnnee'] }} 
                    </option>
                  @endif
              @endforeach
          </select>
        </p>
        </div>
        <div class="piedForm">
        <p>
          <input id="ok" type="submit" value="Valider" size="20" />
          <input id="annuler" type="reset" value="Effacer" size="20" />
        </p> 
        </div>
          
        </form>
  @endsection 
 