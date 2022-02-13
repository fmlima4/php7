<?php

namespace App\Services;

use App\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CriadorDeSerie
{
    
    public function criarSerie(string $nomeSerie, int $qtd_temporadas, int $qtd_eps) : Serie
    {
        DB::beginTransaction();
        $serie = Serie::create([
            'nome' => $nomeSerie,
        ]);
        $this->criarTemporadas($qtd_temporadas, $qtd_eps, $serie);
        DB::commit();

        return $serie;
    }

    private function criarTemporadas(int $qtd_temporadas, int $qtd_eps, $serie) : void
    {
        for($i = 1; $i <= $qtd_temporadas; $i++){
            $temporada = $serie->temporadas()->create(['numero' => $i]);

            $this->criarEpisodios($qtd_eps, $temporada);
        }
    }

    private function criarEpisodios(int $qtd_eps, $temporada) : void
    {
        for($j = 1; $j <= $qtd_eps; $j++){
            $temporada->episodios()->create(['numero' => $j]);
        }
    }
}