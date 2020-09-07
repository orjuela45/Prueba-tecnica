<?php

namespace App\Http\Controllers;

use App\Actors;
use Illuminate\Http\Request;

class ActorsController extends Controller
{
    public function getActors(){
        try{
            $actors = Actors::whereStatus(true)->get();
            if (!isset($actors) || count($actors) == 0){
                return "No hay actores registrados";
            }
            return $actors;
        } catch(\Throwable $th){
            return $th;
        }
    }

    public function getActorById($id){
        try{
            if (!isset($id)){
                return "Falta ingresar el ID del actor";    
            }
            $actors = Actors::find($id);
            if (!isset($actors)){
                return "El actor con id $id no existe";    
            }
            return $actors;
        } catch(\Throwable $th){
            return $th;
        }
    }

    public function getActorByName($name){
        try{
            if (!isset($name)){
                return "Falta ingresar el nombre del actor";    
            }
            $actors = Actors::where('name', 'like', "'%$name%'");
            if (!isset($actors)){
                return "El actor con nombre $name no existe";    
            }
            return $actors;
        } catch(\Throwable $th){
            return $th;
        }
    }

    public function createActor(Request $request){
        return $request;
        try{
            $actor = Actors::whereName($request->name)->first();
            if (isset($actor)){
                return "Ya existe un actor registrado con el nombre $actor->name";
            }
            $actor = new Actors();
            $actor->name = $request->name;
            $actor->rol = $request->rol;
            $actor->gender = $request->gender;
            $actor->age = $request->age;
            $actor->height = $request->height;
            $actor->status = true;
            $actor->save();
            return $actor->id;
        } catch(\Throwable $th){
            return $th;
        }
    }

    public function updateActor(Request $request, $id){
        try{
            $actor = Actors::find($id);
            if (!isset($actor)){
                return "El Actor con id $id no existe";
            }
            $actor->name = $request->name;
            $actor->rol = $request->rol;
            $actor->gender = $request->gender;
            $actor->age = $request->age;
            $actor->height = $request->height;
            $actor->status = true;
            $actor->save();
            return $actor;
        } catch(\Throwable $th){
            return $th;
        }
    }

    public function deleteActor($id){
        try{
            $actor = Actors::find($id);
            if (!isset($actor)){
                return "El Actor con id $id no existe";
            }
            $actor->status = false;
            $actor->save();
            return "Actor eliminado";
        } catch(\Throwable $th){
            return $th;
        }
    }
}
