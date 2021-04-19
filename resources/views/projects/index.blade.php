@extends('layouts.app')
@section('content')

    <header class="d-flex justify-content-between  align-items-center mb-3 py-3 ">
        <h2 class="h5 text-muted ">Mis Proyectos</h2>
        <a class="btn btn-info text-white font-bold py-2 px-4" href="/projects/create">Nuevo Proyecto</a>
    </header>
    <main class="row -mx-3-t">
        @forelse ($projects as $project)
            <div class="col-sm-12 col-lg-3 mb-3">
                <div class="card p-3 shadow position-relative overflow-hidden" style="height:200px">
                    <div class="project__tag"></div>
                    <h3 class="card-title py-3">
                        <a class="text-dark" href="{{ $project->path() }}">  {{ $project->title }}</a>
                    </h3>
                    <div class="text-muted mb-4">
                        {{ \Illuminate\Support\Str::limit($project->description, 100) }}
                    </div>
                    @can('manage', $project)
                        <footer>
                            <form method="POST" action="{{ $project->path() }}" class="text-right">
                                @method('DELETE')
                                @csrf
                                <button title="Eliminar Proyecto" class="btn"  type="submit">
                                    <svg class="text-danger" style="width: 1.5rem" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                      </svg>
                                </button>
                            </form>
                        </footer>
                    @endcan
                </div>
            </div>
        @empty
            <div class="container d-flex flex-column justify-content-center align-items-center">
                <img style="width: 20rem" src="{{ asset('images/undraw_No_data_re_kwbl.svg') }}" alt="Images">
                 <h3 class="text-muted mt-3">No hay ningun proyecto</h3>
            </div>
        @endforelse
    </main>
@endsection

