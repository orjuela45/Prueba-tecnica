@extends('layouts.base')
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script>
    function guardar(){
        var name = document.getElementById("name")
        var rol = document.getElementById("rol")
        var gender = document.getElementById("gender")
        var age = document.getElementById("age")
        var heigth = document.getElementById("heigth")
        $.ajax({
            url: 'http://127.0.0.1:8000/api/actors/createActor',
            type: 'POST',
            data: {
                "name" : this.name,
                "rol": this.rol,
                "gender": this.gender,
                "age": this.age,
                "heigth": this.heigth
            },
            success: function(respuesta) {
                console.log(respuesta);
            },
            error: function() {
                console.error("No se pudo crear el actor");
            }
        });
    }
    $( document ).ready(function() {
        $.ajax({
            url: 'http://127.0.0.1:8000/api/actors/getActors',
            type: 'GET',
            success: function(respuesta) {
                console.log(respuesta);
            },
            error: function() {
                console.error("No es posible completar la operación");
            }
        });
    });
</script>
<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">Menu</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="/actors">Actores</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/movies">Peliculas</a>
            </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-xl-4">
                <div class="card" id="cardInsertar">
                    <div class="card-header text-center"> Agregar actor </div>
                    <div class="card-body">
                        <div class="row form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" id="name" class="form-control ">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row form-group">
                            <label for="nombre">Papel</label>
                            <input type="text" id="rol" class="form-control ">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row form-group">
                            <label for="nombre">Genero</label>
                            <select class="form-control" id="gender">
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row form-group">
                            <label for="nombre">Edad</label>
                            <input type="number" id="age" class="form-control "min="0">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row form-group">
                            <label for="nombre">Altura</label>
                            <input type="number" id="heigth" class="form-control " min="0">
                        </div>
                    </div>
                    <div class="row justify-content-center mb-5">
                        <button onclick="guardar()" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>