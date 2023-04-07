<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Models\Serie;
use App\Http\Requests\SeriesFormRequest;
use DB;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Serie::query()->orderBy('name')->get();
        $mensagemSucesso = $request->session()->get('mensagem.sucesso');
        return view('series.index')->with('series', $series)->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        Serie::create($request->all());
        $request->session()->flash('mensagem.sucesso', 'Série '.$request->name.' adicionada com sucesso');
        return redirect()->route('series.index');
    }

    public function destroy(Serie $series, Request $request)
    {
        $series->delete();
        $request->session()->flash('mensagem.sucesso', 'Série '.$series->name.' removida com sucesso');
        return redirect()->route('series.index');
    }

    
    public function edit(Serie $series, Request $request)
    {
        return view('series.edit')->with('series',$series);
    }

    public function update(Serie $series,SeriesFormRequest $request)
    {
        //$series = Serie::where('name', '=', $series->name)->first();
        //$series->update($request->all());
        
        $series->fill($request->all());
        $series->save();

        $request->session()->flash('mensagem.sucesso', 'Série '.$series->name.' atualizada com sucesso');
        return redirect()->route('series.index');
    }
    
    public function show(Request $request)
    {
        dd($request->series);
        //return view('series.edit');
    }
    

}
