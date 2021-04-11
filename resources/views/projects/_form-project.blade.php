<div class="fiel">
    <label class="label" for="title">titulo</label>
    <div class="control">
        <input class="input" id="title" name="title" placeholder="titulo del proyecto" type="text"
            value="{{ $project->title }}">
    </div>
</div>
<div class="fiel">
    <label class="label" for="description">Descripcion</label>
    <div class="control">
        <textarea class="textarea" name="description" id="description" cols="30" rows="10">
                {{ $project->description }}
            </textarea>
    </div>
</div>
<div class="field">
    <div class="control">
        <button type="submit" class="button">{{ $buttonText }}</button>
        <a href="{{ $project->path() }}">Cancelar</a>
    </div>
</div>
@if ($errors->any())
    <div class="field">
            @foreach ($errors->all as $error)
                <li>  {{ $error }}</li>
            @endforeach
    </div>
@endif
