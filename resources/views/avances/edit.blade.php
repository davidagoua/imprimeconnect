@extends('base')


@section('content')
    <div class="row">
        <div class="col-12 col-md-6 ">
            <div class="card ">
                <div class="card-body">
                    <form  action="{{ route('avance.store', ['commande'=>$commande]) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="">Montant</label>
                            <input type="text" name="montant" pattern="[0-9.]+" class="form-control ">
                        </div>
                        <div class="text-right ">
                            <button class="btn btn-primary" type="submit">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
