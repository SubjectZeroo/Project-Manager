@extends('layouts.app')
@section('content')
    <h1>Crear nuevo Proyecto</h1>
    <div class="row justify-content-center">
            <div class="col-lg-6">
                <form action="/projects" method="POST">
                    @csrf
                    @include('projects._form-project', [
                        'project' => new App\Models\Project,
                        'buttonText' => 'Crear Proyecto'

                        ]);
                </form>
            </div>

    </div>
@endsection
