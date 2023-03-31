<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;
use DB;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        //$series = Serie::all();
        $series = Serie::query()->orderBy('name')->get();
        return view('series.index')->with('series', $series);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        Serie::create($request->all());        
        //return to_route('series.index');
        return redirect()->route('series.index');
    }

    public function destroy(Request $request)
    {
        Serie::destroy($request->series);        
        return redirect()->route('series.index');
    }

    
    public function edit(Request $request)
    {
        dd($request->series);
        //Serie::destroy($request->series);        
        //return to_route('series.index');
        //return redirect()->route('series.index');
    }

    /*
    public function show(Request $request)
    {
        dd($request->series);
        //Serie::destroy($request->series);        
        //return to_route('series.index');
        //return redirect()->route('series.index');
    }*/
}
