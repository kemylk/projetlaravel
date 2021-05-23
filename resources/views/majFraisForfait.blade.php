@extends ('sommaireComptable')
@section('contenu1')

<div id="contenu">

    <form method="post"  action="{{ route('modifsucces') }}">
                    {{ csrf_field() }} <!-- laravel va ajouter un champ caché avec un token -->
        <div class="corpsForm">
            <fieldset>
                <legend>Eléments forfaitisés</legend>
                @foreach ($ligne as $key => $frais)
                <div>
                 {{$key}}         <input type = "text" name ="{{$key}}" value="{{$key}}:{{$frais}}"  size = "30" maxlength = "45" required >

                </div>
                @endforeach

            </fieldset>
        </div>          

        <div class="piedForm">
            <p>
            <input id="ok" type="submit" value="Valider" size="20" />
            <input id="annuler" type="reset" value="Annuler" size="20" />
            </p> 
        </div>
    </form>
@endsection