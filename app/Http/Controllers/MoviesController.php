<?php

namespace App\Http\Controllers;

use App\Movies;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function getMovies(){
        try{
            $movies = Movies::whereStatus(1)->get();
            if (!isset($movies) && count($movies) == 0){
                return "No hay peliculas registrados";
            }
            return $movies;
        } catch(\Throwable $th){
            return $th;
        }
    }

    public function getMovieById($id){
        try{
            if (!isset($id)){
                return "Falta ingresar el ID de la pelicula";    
            }
            $movie = Movies::find($id);
            if (!isset($movie)){
                return "La pelicula con id $id no existe";    
            }
            return $movie;
        } catch(\Throwable $th){
            return $th;
        }
    }

    public function getMovieByName($name){
        try{
            if (!isset($name)){
                return "Falta ingresar el nombre de la pelicula";    
            }
            $movie = Movies::where('name', 'like', "'%$name%'");
            if (!isset($movie)){
                return "la pelicula con nombre $name no existe";    
            }
            return $movie;
        } catch(\Throwable $th){
            return $th;
        }
    }

    public function createMovie(Request $request){
        try{
            $movie = Movies::whereName($request->name)->first();
            if (isset($movie)){
                return "Ya existe una pelicula registrado con el nombre $movie->name";
            }
            $movie = new Movies();
            $movie->name = $request->name;
            $movie->category = $request->category;
            $movie->release_date = $request->date;
            $movie->director = $request->director;
            $movie->status = true;
            $movie->save();
            return $movie->id;
        } catch(\Throwable $th){
            return $th;
        }
    }

    public function updateMovie(Request $request, $id){
        try{
            $movie = Movies::find($id);
            if (!isset($movie)){
                return "La pelicula con id $id no existe";
            }
            $movie->name = $request->name;
            $movie->category = $request->category;
            $movie->release_date = $request->date;
            $movie->director = $request->director;
            $movie->status = true;
            $movie->save();
            return $movie;
        } catch(\Throwable $th){
            return $th;
        }
    }

    public function deleteMovie($id){
        try{
            $movie = Movies::find($id);
            if (!isset($movie)){
                return "La pelicula con id $id no existe";
            }
            $movie->status = false;
            $movie->save();
            return "Pelicula eliminada";
        } catch(\Throwable $th){
            return $th;
        }
    }
}
