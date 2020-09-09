<?php

use Illuminate\Http\Request;

use App\Http\Models\Make as MakeModel;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('makes', function(){
    return MakeModel::all();
});

Route::get('models/{id}', function($id){
    return MakeModel::find($id)->carModels()->get();
});

Route::get('cars/{make}', 'CarsController@findByMake');

Route::get('cars', 'CarsController@index');

Route::post('car', 'CarsController@store');
