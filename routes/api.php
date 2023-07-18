<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\SeriesControllerAPI;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
Route::get('/series', [SeriesControllerAPI::class, 'index'])
    ->name('seriesapi.index');

Route::delete('/series/{id}/delete', [SeriesControllerAPI::class, 'destroy'])
    ->name('seriesapi.destroy');

Route::post('/series', [SeriesControllerAPI::class, 'store'])
    ->name('seriesapi.store');

Route::put('/series/{id}/update', [SeriesControllerAPI::class, 'update'])
    ->name('seriesapi.update');
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('/series', SeriesControllerAPI::class);

    Route::get('/series/{series}/seasons', [SeriesControllerAPI::class, 'seasonsOfSeries'])
        ->name('seriesapi.seasonsOfSeries');

    Route::get('/series/{series}/episodes', [SeriesControllerAPI::class, 'episodesOfSeries'])
        ->name('seriesapi.episodesOfSeries');

    Route::patch('/series/{series}/seasons/{seasons}/episodes/{episodes}/watched', [SeriesControllerAPI::class, 'watchedEpisode'])
        ->name('seriesapi.watchedEpisode');

    Route::patch('/episodes/{episode}/', [SeriesControllerAPI::class, 'watchedEpisodeSimple'])
        ->name('seriesapi.watchedEpisodeSimple');

});

Route::post('/login', function (Request $request) {
    $credentials = $request->only(['email','password']);
    
    /*
    $user = User::whereEmail($credentials['email'])
        ->first();
    
    if( Hash::check($credentials['password'], $user->password) ){
        return response()->json([
            'message' => 'User authenticated sucessfully',
        ],200);
    }else{
        return response()->json('User not authorized',401);
    }
    */

    if (Auth::attempt($credentials) === false){
        return response()->json('User not authorized',401);
    }

    /** @var \App\Models\User $user **/
    $user = Auth::user();
    $token = $user->createToken('token');

    return response()->json($token->plainTextToken);
});

