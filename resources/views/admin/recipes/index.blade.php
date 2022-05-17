@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="clearfix mb-3">
            <h2 class="float-start">Recepten</h2>
            <a href="/admin/recipes/add" class="btn btn-primary float-end">Voeg toe +</a>
        </div>
        <div class="card">
            <div class="card-body">
                @if ($recipes->count() > 0)
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Titel</th>
                            <th scope="col">Actief</th>
                            <th scope="col" class="text-end">Acties</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($recipes as $recipe)
                            <tr>
                                <td>{{ $recipe->id }}</td>
                                <td>{{ $recipe->title }}</td>
                                <td>
                                    @if ($recipe->active)
                                        <span class="text-success">Actief</span>
                                    @else
                                        <span class="text-danger">Inactief</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ $recipe->getURL() }}" target="_blank">Bekijken</a>
                                    <a href="{{ URL::to('admin/recipes/edit/' . $recipe->id) }}">Bewerken</a>
                                    <a href="{{ URL::to('admin/recipes/delete/' . $recipe->id) }}" class="text-danger">Verwijderen</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h4 class="text-center my-4">Er zijn nog geen recepten aangemaakt.</h4>
                @endif
            </div>
        </div>
    </div>
@endsection
