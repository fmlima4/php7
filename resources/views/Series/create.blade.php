@extends('layout')

@section('header')
    Adicionar Series
@endsection
        
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <a href="/series" class="btn btn-dark mb-2">Voltar</a> 

    <form method="post">
        @csrf
        <div class="row">
            <div class="col col-8">
                <label for="nome">Nome da serie</label>
                <input type="text" class="form-control" name="nome" id="nome"/>
            </div>
            <div class="col col-2">
                <label for="qtd_temporadas">Qtd temporadas</label>
                <input type="number" class="form-control" name="qtd_temporadas" id="qtd_temporadas"/>
            </div>
            <div class="col col-2">
                <label for="qtd_eps">Qtd Epsódios</label>
                <input type="number" class="form-control" name="qtd_eps" id="qtd_eps"/>
            </div>
        </div>

        <button class="btn btn-primary mt-2">Adicionar</button>

    </form>
@endsection
