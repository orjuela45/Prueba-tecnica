<?php

namespace App\Http\Controllers;

use App\MovieActors;
use Illuminate\Http\Request;

class MovieActorsController extends Controller
{
    public function getMoviesActors(){
        try{
            $movie_actors = MovieActors::whereStatus(1)->get();
            if (!isset($movie_actors) && count($movie_actors) == 0){
                return "No hay relaciones aun";
            }
            return $movie_actors;
        } catch(\Throwable $th){
            return $th;
        }
    }

    public function getMovieActorById($id){
        try{
            if (!isset($id)){
                return "Falta ingresar el ID de la relación";    
            }
            $movie_actors = MovieActors::find($id);
            if (!isset($movie_actors)){
                return "Esta Relación aun no existe";   
            }
            return $movie_actors;
        } catch(\Throwable $th){
            return $th;
        }
    }

    public function createMovieActor(Request $request){
        try{
            $movie_actors = MovieActors::whereActorId($request->actor_id)->whereMovieId($request->movie_id)->first();
            if (isset($movie_actors)){
                return "Este actor ya se encuentra registrado a esta pelicula";
            }
            $movie_actors = new MovieActors();
            $movie_actors->actor_id = $request->actor_id;
            $movie_actors->movie_id = $request->movie_id;
            $movie_actors->status = true;
            $movie_actors->save();
            return $movie_actors->id;
        } catch(\Throwable $th){
            return $th;
        }
    }

    public function deleteMovieActor($id){
        try{
            $movie_actors = MovieActors::find($id);
            if (!isset($movie_actors)){
                return "La relacion con el id %id no existe";
            }
            $movie_actors->status = false;
            $movie_actors->save();
            return "relación eliminada";
        } catch(\Throwable $th){
            return $th;
        }
    }
}
