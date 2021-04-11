@extends('layouts.app')
@section('content')

    <h1>Editat Proyecto</h1>
    <form action="{{ $project->path() }}" method="POST">
        @csrf
        @method('PATCH')
        @include('projects._form-project', [
            'buttonText' => 'Actualizar Proyecto'
        ])
    </form>
@endsection
