@extends('base')


@section('content')
<div class="row">
    <div class="col-12 col-md-6 ">
        <div class="card ">
            <div class="card-body">
                <form enctype="multipart/form-data" action="{{ route('lignes.upload', ['ligne'=>$ligne]) }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="">Fichier</label>
                        <input type="file" name="fichier" class="form-control form-control-file">
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
