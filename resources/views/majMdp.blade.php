@extends('sommaire')
@section('contenu1')

<style>
.buttons{
    float : right;
}
</style>

    <div id="contenu">
        <h2>Changement de mot de passe</h2>
        <form method="post" action="{{ route('chemin_sauvegardeMdp') }}">
                {{ csrf_field() }} <!-- laravel va ajouter un champ caché avec un token -->
            <div class="corpsForm">
                <fieldset>
                    @includeWhen($erreurs != null, 'msgerreurs', ['erreurs' => $erreurs])<!--'msgerreurs' vient du fichier blade.php-->
                    @includeWhen($message != "", 'message', ['message' => $message])<!--'message' vient du fichier blade.php-->
                    <div>
                        <div>
                            <label for="dateEmbauche">Donnez votre date d'embauche*</label>
                            <input type="text" name="dateEmbauche" placeholder="21-12-2015" pattern="([0-9]{2}){2}\-[0-9]{4}" required>
                        </div>
                        <br>
                        <br>
                        <div>
                            <label for="mdp1">Nouveau mot de passe*</label>
                            <input type="password" name="mdp1" required>
                        </div>
                        <br>
                        <br>
                        <div>
                            <label for="mdp2">Retaper le nouveau mot de passe*</label>
                            <input type="password" name="mdp2" required>
                        </div>
                    </div>
                    <br>
                    <div class="buttons">
                        <input type="submit" name="btn1" value="Valider" size="20"/>
                        <input type="reset" name="btn2" value="Annuler" size="20"/>
                    </div>
                </fieldset>
            </div>
        </form>
    </div>


@endsection