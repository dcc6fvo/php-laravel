<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersController extends Controller
{

    public function create(){

        return view ('users.create');
    }

    public function store(Request $request){

        $request = $request->only(['name','email','password']);
        $request['password'] = Hash::make($request['password']);

        $user = User::create($request);
        Auth::login($user);

        return to_route('series.index')
            ->with('mensagem.sucesso', "Bem vindo, ".$request['name']);
    }
}
