@extends('layouts.app')
@section('content')

    <div class="d-flex justify-content-between  align-items-center mb-3">
        <h1>Projects</h1>
        <a href="/projects/create">Crear Nuevo Proyecto</a>
    </div>
    <div class="d-flex">
        @forelse ($projects as $project)
            <div class="bg-white mr-4 rounded p-4 shadow w-25 ">
                <h3 class="font-weight-normal py-3">{{ $project->title }}</h3>
                <div class="text-muted">{{ \Illuminate\Support\Str::limit($project->description, 100) }}</div>
            </div>
        @empty
            <div>No projects yet.</div>
        @endforelse
    </div>

    {{-- <ul>

            <li>
                <a href="{{ $project->path() }}">{{ $project->title }}</a>
            </li>


    </ul> --}}
@endsection

