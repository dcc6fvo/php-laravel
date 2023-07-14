<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;

class EpisodesController
{
    public function index(Season $season)
    {
        return view('episodes.index', [
            'episodes' => $season->episodes,
            'mensagemSucesso' => session('mensagem.sucesso')
        ]);
    }

    public function update(Request $request, Season $season)
    {
        if(isset($request->episodes))
            $watchedEpisodes = $request->episodes;
        else
            $watchedEpisodes = [];
        $season->episodes->each(function (Episode $episode) use ($watchedEpisodes) {
            $episode->watched = in_array($episode->id, $watchedEpisodes);
        });

        $season->push();

        //dd($season);

        return to_route('seasons.index', $season->series_id)
            ->with('mensagem.sucesso', 'Episódios marcados como assistidos');
    }
}
