<?php

namespace App\Http\Controllers\API;

use App\Events\SeriesCreatedEvent;
use App\Events\SeriesDeletedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Repositories\SeriesRepository;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Http\Request;


class SeriesControllerAPI extends Controller
{

    public function __construct(private SeriesRepository $repository)
    {
    }

    public function index(Request $request)
    {
        if($request->has('nome')){
            return Series::where('nome', 'like', '%'.$request->nome.'%')->get();
        }
        else{
            return Series::all();
        }
    }
     
    public function show(int $series)
    {  

        $serie = Series::whereId($series)
            ->with('seasons.episodes')
            ->find($series);

        if($serie === null){
            return response()->json([
                'message' => "serie ".$series." not found."
            ],404);
        }

        return $serie;
    }

    /*
    public function show(int $series)
    {  

        $series = Series::whereId($series)
            ->with('seasons.episodes')
            ->first();

        return $series;
    }*/

    /*
    public function show(Series $series)
    {  
        return response()->json([
            'serie' => $series
        ],200);
    }
    */

    public function store(SeriesFormRequest $request)
    {       

        if($request->hasFile('cover')) {
            $path = $request->file('cover')->store('files', 'public');
            $request['coverPath'] = "{$path}";
        }

        $serie = $this->repository->add($request);

        SeriesCreatedEvent::dispatch(
            $serie->nome,
            $serie->id,
            $request->seasonsQty,
            $request->episodesPerSeason,
        );
        
        return $serie;
    }

    public function destroy(Series $series)
    {
        SeriesDeletedEvent::dispatch($series);

        /*return response()->json([
            'message' => 'User deleted sucessfully',
        ],200);*/

        return response()->noContent();

    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();

        return response()->json([
            'message' => 'User updated sucessfully',
        ],200);
    }

    public function seasonsOfSeries(int $series){

        $serie = Series::whereId($series)
            ->find($series);

        if($serie === null){
            return response()->json([
                'message' => "serie ".$series." not found."
            ],404);
        }

        return $serie->seasons;
    }

    public function episodesOfSeries(int $series){

        $serie = Series::whereId($series)
            ->find($series);

        if($serie === null){
            return response()->json([
                'message' => "serie ".$series." not found."
            ],404);
        }

        return $serie->episodes;
    }

    public function watchedEpisode(int $series, int $seasons, int $episodes){

        $serie = Series::whereId($series)
            ->find($series);

        if($serie === null){
            return response()->json([
                'message' => "serie ".$series." not found."
            ],404);
        }

        $season = Season::where([
            ['series_id', $serie->id],
            ['number', $seasons],
        ])->first();
        
        if($season === null){
            return response()->json([
                'message' => "season ".$seasons." not found."
            ],404);
        }

        $episode = Episode::where([
            ['number', $episodes],
            ['season_id', $season->id]
        ])->first();

        $episode->watched=true;
        $episode->push();

        return response()->json([
            'message' => 'Episode updated sucessfully',
        ],200);
    }

    public function watchedEpisodeSimple(int $episode, Request $request){

        $episodes = Episode::whereId($episode)
            ->find($episode);
        
        if($episodes === null){
            return response()->json([
                'message' => "episode ".$episode." not found."
            ],404);
        }
        
        $episodes->watched = $request->watched; 
        $episodes->push();
       
        return response()->json([
            'message' => 'Episode updated sucessfully',
        ],200);

    }
}
