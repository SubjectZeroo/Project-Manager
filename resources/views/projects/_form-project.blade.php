<div class="form-group">
    <label class="label" for="title">Titulo del proyecto</label>
    <div class="control">
        <input
            class="form-control"
            id="title" name="title"
            placeholder="Titulo del proyecto"
            type="text"
            value="{{ $project->title }}">
    </div>
</div>
<div class="form-group">
    <label class="label" for="description">Descripcion del proyecto</label>
    <div class="control">
        <textarea
                class="form-control"
                name="description"
                id="description"
                cols="30"
                rows="10">
                {{ $project->description }}
        </textarea>
    </div>
</div>
<div class="form-groupd">
    <div class="control">
        <button
            type="submit"
            class="btn btn-info text-white font-bold py-2 px-4">{{ $buttonText }}
        </button>
        <a class="text-muted" href="{{ $project->path() }}">Cancelar</a>
    </div>
</div>
@if ($errors->any())
    <div class="form-group">
            @foreach ($errors->all as $error)
                <li>  {{ $error }}</li>
            @endforeach
    </div>
@endif
