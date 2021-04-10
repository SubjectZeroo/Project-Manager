@extends('layouts.app')
@section('content')

    <header class="d-flex justify-content-between  align-items-center mb-3 py-3 ">
        <h2 class="h5 text-muted ">Mis Proyectos</h2>
        <a class="btn btn-info text-white" href="/projects/create">Nuevo Proyecto</a>
    </header>
    <main class="row  -mx-3-t">
        @forelse ($projects as $project)
        <div class="col-sm-12 col-lg-4  px-3-t pb-6-t ">
            <div class="card p-3 shadow" style="height: 200px">
                <h3 class="card-title py-3">
                    <a class="text-dark" href="{{ $project->path() }}">  {{ $project->title }}</a>
                </h3>
                <div class=" text-muted">
                    {{ \Illuminate\Support\Str::limit($project->description, 100) }}
                </div>
            </div>
        </div>
        @empty
            <div>No projects yet.</div>
        @endforelse
    </main>

    {{-- <ul>

            <li>
                <a href="{{ $project->path() }}">{{ $project->title }}</a>
            </li>


    </ul> --}}
@endsection

