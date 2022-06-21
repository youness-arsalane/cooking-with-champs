@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="clearfix mb-3">
            <h2 class="float-start">Categorieën</h2>
            <a href="/admin/categories/add" class="btn btn-primary float-end">Voeg toe +</a>
        </div>
        <div class="card">
            <div class="card-body">
                @if ($categories->count() > 0)
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Titel</th>
                            <th scope="col" class="text-end">Acties</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td class="text-end">
                                    <a href="{{ URL::to('admin/categories/edit/' . $category->id) }}">Bewerken</a>
                                    <a href="{{ URL::to('admin/categories/delete/' . $category->id) }}" class="text-danger">Verwijderen</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h4 class="text-center my-4">Er zijn nog geen categorieën aangemaakt.</h4>
                @endif
            </div>
        </div>
    </div>
@endsection
