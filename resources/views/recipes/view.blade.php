@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="mb-4">
                    <img src="{{ $recipe->imageURL() }}" alt="" class="w-100">
                    <small>Aangemaakt op: {{ date('d F Y H:i', strtotime($recipe->created_at)) }}</small>
                </div>
                <h5>Reacties</h5>
            </div>
            <div class="col-lg-8">
                <h3>{{ $recipe->title }}</h3>
                <h5>Korte introductie</h5>
                <p>{{ $recipe->introduction }}</p>
                <div class="row">
                    <div class="col-lg-6">
                        <h5>Stappen</h5>
                        @foreach($recipe->recipeSteps as $i => $recipeStep)
                            <h6>Stap {{ ($i + 1) }}:</h6>
                            <p>{{ $recipeStep->description }}</p>
                        @endforeach
                    </div>
                    <div class="col-lg-6">
                        <h5>Inhoud</h5>
                        <p>{!! nl2br($recipe->content) !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
