{{-- {{ dd(count($activity->changes['after']) == 2) }} --}}


@if (count($activity->changes['after']) == 2)
   {{ $activity->user->name }} Actualizaste el {{ key($activity->changes['after']) }}
@else
    {{ $activity->user->name }} actualizo el proyecto
@endif
