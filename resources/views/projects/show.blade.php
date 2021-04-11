@extends('layouts.app')
@section('content')
    <header class="d-flex justify-content-between  align-items-center mb-3 py-3 ">

            <p class="text-muted">
               <a href="/projects">Mis Proyectos</a>  / {{ $project->title }}
            </p>
            <a class="btn btn-info text-white" href="{{ $project->path().'/edit' }} ">Editar Proyecto</a>

    </header>
    <main>
        <h2 class="text-muted">Tareas</h2>
        <div class="row">
            <div class="col-sm-12 col-lg-8 mb-4">
                <div>
                    <div class="mb-5">
                        @forelse ($project->tasks as $task)
                        <div class="card mb-3">
                            <div class="card-body">
                                <form method="POST" action="{{$task->path()}}" >
                                    @method('PATCH')
                                    @csrf
                                    <div class="d-flex  justify-content-between ">
                                        <input name="body" id="body" class="form-control mr-3 border-0 {{ $task->completed ? 'text-muted' : '' }}" type="text" value="{{ $task->body }}" >
                                        <input name="completed" type="checkbox" onChange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @empty
                        <div class="card mb-3">
                            <div class="card-body">
                                No se agregaron tareas Todavia...
                            </div>
                        </div>
                        @endforelse
                        <div class="card mb-3">
                            <div class="card-body">
                                <form action="{{ $project->path() . '/tasks' }}" method="POST">
                                    @csrf
                                    <input class="w-100" id="body" name="body"  placeholder="Agregar una nueva tarea">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h2 class="text-muted">Notas Generales</h2>
                        <form method="POST" action="{{ $project->path() }}">
                            @csrf
                            @method('PATCH')
                            <textarea
                            class="card w-100"
                            style="min-height:200px"
                            name="notes"
                            id="notes"
                            cols="30"
                            rows="10">{{ $project->notes }}</textarea>
                            <button type="submit" class="btn">Guardar</button>
                        </form>
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


