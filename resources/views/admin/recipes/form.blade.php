@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="clearfix mb-3">
            <h2 class="float-start">{{ !empty($recipe->id) ? 'Recept bewerken' : 'Nieuw recept' }}</h2>
            @if (!empty($recipe->id))
                <a href="{{ URL::to('admin/recipes/delete/' . $recipe->id) }}" class="btn btn-danger float-end ms-2">Verwijderen</a>
            @endif
            <button type="button" class="btn btn-primary float-end ms-2 save-recipe">Opslaan</button>
            <a href="{{ URL::to('admin/recipes/') }}" class="btn float-end">Terug</a>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">Algemeen</div>
                    <div class="card-body">
                        <form action="/admin/recipes/save/{{ $recipe->id }}" method="post" id="recipeForm">
                            @csrf
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Titel</label>
                                        <input type="text" class="form-control" name="title" id="title" value="{{ $recipe->title }}">
                                        @error('title')
                                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="active" class="form-label">Status</label>
                                        <select name="active" id="active" class="form-control">
                                            <option value="1" {{ !empty($recipe->id) && $recipe->active ? 'selected' : '' }}>Actief</option>
                                            <option value="0" {{ !empty($recipe->id) && !$recipe->active ? 'selected' : '' }}>Inactief</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <label for="slug" class="form-label">URL</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">{{ URL::to('/') }}/</span>
                                <input type="text" class="form-control" name="slug" id="slug" value="{{ $recipe->slug }}">
                            </div>
                            @error('slug')
                            <p class="text-danger text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <div class="mb-3">
                                <label for="introduction" class="form-label">Introductie</label>
                                <textarea class="form-control" name="introduction" id="introduction" rows="3">{{ $recipe->introduction }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Inhoud</label>
                                <textarea class="form-control" name="content" id="content" rows="6">{{ $recipe->content }}</textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                @if (!empty($recipe->id))
                    <div class="card">
                        <div class="card-header">Afbeelding</div>
                        <div class="card-body">
                            <form method="post" action="{{ URL::to('admin/recipes/saveImage/' . $recipe->id) }}" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="image">
                                @if (!empty($recipe->image_filename))
                                    <img class="w-100 mt-3" src="{{ $recipe->imageURL() }}" alt="">
                                @endif
                                <div class="clearfix mt-2">
                                    @if (!empty($recipe->image_filename))
                                        <a href="{{ URL::to('admin/recipes/deleteImage/' . $recipe->id) }}" class="btn btn-outline-danger ms-2 float-end">Verwijderen</a>
                                    @endif
                                    <button type="submit" class="btn btn-outline-primary float-end">Opslaan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header">Categorieën</div>
                        <div class="card-body">
                            Categorieën...
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header">Stappen</div>
                        <div class="card-body">
                            Stappen...
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $(document).on('click', '.save-recipe', function () {
            $('#recipeForm').submit();
        });
    });
</script>
