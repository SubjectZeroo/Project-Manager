@extends('layouts.app')
@section('content')
    <h1>Crear Proyecyo</h1>

    <form action="/projects" method="POST">
        @csrf
        <div class="fiel">
            <label class="label" for="title">titulo</label>
            <div class="control">
                <input class="input" id="title" name="title" placeholder="titulo del proyecto" type="text">
            </div>
        </div>
        <div class="fiel">
            <label class="label" for="description">Descripcion</label>
            <div class="control">
                <textarea class="textarea" name="description" id="description" cols="30" rows="10"></textarea>
            </div>
        </div>
        <div class="field">
            <div class="control">
                <button type="submit" class="button">Crear Proyecto</button>
                <a href="/projects">Cancelar</a>
            </div>
        </div>
    </form>
@endsection
