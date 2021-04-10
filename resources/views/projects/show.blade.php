@extends('layouts.app')
@section('content')
    <header class="d-flex justify-content-between  align-items-center mb-3 py-3 ">

            <p class="text-muted">
               <a href="/projects">Mis Proyectos</a>  / {{ $project->title }}
            </p>
            <a class="btn btn-info text-white" href="/projects/create">Nuevo Proyecto</a>

    </header>
    <main>
        <h2 class="text-muted">Tareas</h2>
        <div class="row">
            <div class="col-sm-12 col-lg-8 mb-4">
                <div>
                    <div class="mb-5">
                        @foreach ($project->tasks as $task)
                        <div class="card mb-3">
                            <div class="card-body">
                                {{ $task->body }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="mb-4">
                        <h2 class="text-muted">Notas Generales</h2>
                        <textarea class="card w-100" style="min-height:200px" name="" id="" cols="30" rows="10"></textarea>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4  px-3">
                {{-- <div class="card">
                    <div class="card-body">
                        <h1>{{ $project->title }}</h1>
                        <div>{{$project->description }}</div>
                        <a href="/projects">Ir atras</a>
                    </div>
                </div> --}}
                <div class="card p-3 shadow" style="height: 200px">
                    <h3 class="card-title py-3 -ml-5-tw mb-3 border-l-4 pl-4">
                        <a href="{{ $project->path() }}">  {{ $project->title }}</a>
                    </h3>
                    <div class=" text-muted">
                        {{ \Illuminate\Support\Str::limit($project->description, 100) }}
                    </div>
                </div>
            </div>
        </div>
    </main>



@endsection


