@extends('layouts.app')
@section('content')
    <header class="d-flex justify-content-between  align-items-center mb-3 py-3 ">
        <h2 class="text-muted">Mis Proyectos</h2>
        <a class="btn btn-info text-white" href="/projects/create">Nuevo Proyecto</a>
    </header>
    <main>
        <div class="row">
            <div class="col-8">
                <h2 class="text-muted">Tareas</h2>

                <h2 class="text-muted">Notas Generales</h2>
            </div>
            <div class="col-4">
                <div class="card">
                    <h1>{{ $project->title }}</h1>

                    <a href="/projects">Ir atras</a>
                    <div>{{$project->description }}</div>
                </div>

            </div>

        </div>
    </main>



@endsection


