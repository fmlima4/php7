@extends('layout')

@section('header')
    Temporadas de {{ $serie->nome }}
@endsection

@section('content')
    <a href="/series" class="btn btn-dark mb-2">Voltar</a> 
    <ul class="list-group">
        <?php foreach($temporadas as $temporada) : ?>
            <li class="list-group-item d-flex justify-content-between" >
                <a href="/temporadas/{{ $temporada->id }}/episodios">
                    Temporada {{ $temporada->numero }}
                </a>
                <span> 
                {{ $temporada->getEpisodiosAssistidos()->count() }} / {{ $temporada->episodios->count() }}
                </span>
            </li>
        <?php endforeach; ?>
    </ul>
@endsection
