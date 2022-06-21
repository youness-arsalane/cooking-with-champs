@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="clearfix mb-3">
            <h2 class="float-start">{{ !empty($category->id) ? 'Categorie bewerken' : 'Nieuw categorie' }}</h2>
            @if (!empty($category->id))
                <a href="{{ URL::to('admin/categories/delete/' . $category->id) }}" class="btn btn-danger float-end ms-2">Verwijderen</a>
            @endif
            <button type="button" class="btn btn-primary float-end ms-2 save-category">Opslaan</button>
            <a href="{{ URL::to('admin/categories/') }}" class="btn float-end">Terug</a>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">Algemeen</div>
                    <div class="card-body">
                        <form action="/admin/categories/save/{{ $category->id }}" method="post" id="categoryForm">
                            @csrf
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Titel</label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{ $category->name }}">
                                        @error('name')
                                        <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                @if (!empty($category->id))
                    <div class="card">
                        <div class="card-header">Afbeelding</div>
                        <div class="card-body">
                            <form method="post" action="{{ URL::to('admin/categories/saveImage/' . $category->id) }}" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="image">
                                @if (!empty($category->image_filename))
                                    <img class="w-100 mt-3" src="{{ $category->imageURL() }}" alt="">
                                @endif
                                <div class="clearfix mt-2">
                                    @if (!empty($category->image_filename))
                                        <a href="{{ URL::to('admin/categories/deleteImage/' . $category->id) }}" class="btn btn-outline-danger ms-2 float-end">Verwijderen</a>
                                    @endif
                                    <button type="submit" class="btn btn-outline-primary float-end">Opslaan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $(document).on('click', '.save-category', function () {
            $('#categoryForm').submit();
        });
    });
</script>
