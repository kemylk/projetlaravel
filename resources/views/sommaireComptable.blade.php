@extends ('modeles/visiteur')
    @section('menu')
            <!-- Division pour le sommaire -->
        <div id="menuGauche" style="height:100%;">
            <div id="infosUtil">
                  
             </div>  


               <ul id="menuList">
                   <li >
                      bonjour  <strong> {{ $comptable['login'] }}</strong>

                   </li>
                 
                  <li class="smenu">
                    <a href="{{ route('validerFeuillesdefrai') }}" title=" validation des feuilles de frais">
                    validation des feuilles de frais</a>
                  </li>
                  <li class="smenu">
                    <a href="{{ route('chemin_deconnexion_comptable') }}" title="Se déconnecter">Déconnexion</a>
                  </li>
                </ul>
               
        </div>
    @endsection          