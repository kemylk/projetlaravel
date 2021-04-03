<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Modifier un utilisateur</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{
                         route('modifsucces') }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                       
                        @foreach($ligne as $l)

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">{{$l['idFraisForfait']}}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $l['quantite'] }}" required autofocus>
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