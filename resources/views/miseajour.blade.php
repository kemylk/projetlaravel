@extends ('sommaireComptable')

@section('contenu1')

modification frais forfait {{$visiteur}}
pour le mois de {{$mois}}

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Modifier un utilisateur</div>
                <div class="panel-body" style="margin:auto;">
                    <form class="form-horizontal" method="POST" action="{{
                         route('modifsucces') }}">
                       <!-- {{ csrf_field() }}-->
                       @csrf


                        @foreach($ligne as $l)

                        <div class="form-group" >
                            <label for="name" class="col-md-4 control-label">{{$l['idFraisForfait']}}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control"
                                 name="{{$l['idFraisForfait']}}"
                                  value="{{ $l['idFraisForfait'] }}:{{ $l['quantite'] }}" required autofocus>
                            </div>
                        </div>



         

                        @endforeach



                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Enregistrer
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 
