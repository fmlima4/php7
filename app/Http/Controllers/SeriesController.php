<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use Illuminate\Http\Request;
use App\Serie;
use App\Services\CriadorDeSerie;
use App\Services\RemoverSerie;

class SeriesController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
//...

    public function listarSeries(Request $request)
    {
        // if( !Auth::check()){
        //     echo "nao autenticado";
        //     exit();
        // }

        $series = Serie::query()->orderBy('nome')->get();
        $mensagem = $request->session()->get('mensagem');
        $request->session()->remove('mensagem');

        return view('series.index', [
            'series' => $series,
            'mensagem' => $mensagem
        ]);
    }

    public function create(Request $request)
    {
        return view('series.create');   
    }

    public function store(SeriesFormRequest $request, CriadorDeSerie $criadorSeries)
    {

       
        $serie = $criadorSeries->criarSerie(
            $request->nome,
            $request->qtd_temporadas,
            $request->qtd_eps,
        );

        $request->session()->flash('mensagem', "Serie CRIADA com sucesso: {$serie->nome} - id: {$serie->id}" );
        
        return redirect('/series');
    }

    public function editaNome($id, Request $request)
    {
        $novoNome = $request->nome;
        $serie = Serie::find($id);
        $serie->nome = $novoNome;
        $serie->save();
    }

    public function destroy(Request $request, RemoverSerie $removerSerie)
    {
        $nomeSerie = $removerSerie->removerSerie($request->id);

        $request->session()->flash('mensagem', "serie $nomeSerie REMOVIDA com sucesso" );
        return redirect('/series');
    }

}