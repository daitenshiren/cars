<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

use DB;
use App\Http\Requests;
use App\Http\Models\Cars as CarModel;
use App\Http\Resources\Cars as CarsResource;

class CarsController extends BaseController
{
    public function index()
    {
        // Get movies
        $make = CarModel::orderBy('make', 'asc')->paginate(5);

        return CarsResource::collection($make);
    }

    public function destroy($id)
    {
        // Get article
        $movie = CarModel::findOrFail($id);

        if($movie->delete()) {
            return new MoviesResource($movie);
        }
    }

    public function store(Request $request)
    {
        if($request->isMethod('put')) {

            $movie = CarModel::findOrFail($request->id);

            $movie->id = $request->id;

        } else {
            $movie = new CarModel;
        }

        $movie->model = $request->model;
        $movie->make = $request->make;
        $movie->year = $request->year;
        $movie->price = $request->price;

        if($movie->save()) {
            return new CarsResource($movie);
        }

    }

    public function findByMake($make) {
         // Get movies
        $make = CarModel::where('make' , $make)->orderBy('make', 'asc')->paginate(5);

        return CarsResource::collection($make);
    }

    public function show($id)
    {
        // Get movie
        $movie = CarModel::findOrFail($id);

        // Return single article as a resource
        return new MoviesResource($movie);
    }
}
