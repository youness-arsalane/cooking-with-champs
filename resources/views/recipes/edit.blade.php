<x-layout>
    <x-card class="max-w-lg mx-auto mt-24">
    <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">
            Edit Recipe
        </h2>
        <p class="mb-4">Here you can make changes to your recipe called {{$recipe->title}}</p>
    </header>

    <form method="POST" action="/recipes/{{$recipe->id}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-6">
            <label
                for="title"
                class="inline-block text-lg mb-2"
                >Title</label
            >
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="title"
                value="{{$recipe->title}}"/>
            @error('title')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="tags" class="inline-block text-lg mb-2">
                Tags (Comma Separated)
            </label>
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="tags"
                value="{{$recipe->tags}}"
                />
            @error('tags')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="logo" class="inline-block text-lg mb-2">
                Company Logo
            </label>
            <input
                type="file"
                class="border border-gray-200 rounded p-2 w-full"
                name="logo"
            />
            <img
            class="w-48 mr-6 mb-6"
            src="{{$recipe->logo ? asset('storage/' . $recipe->logo) : asset('images/no-image.png')}}"
            alt=""
            />
            @error('logo')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label
                for="description"
                class="inline-block text-lg mb-2"
            >
                Recipe Description
            </label>
            <textarea
                class="border border-gray-200 rounded p-2 w-full"
                name="description"
                rows="15"
                placeholder="Include ingredients, steps, cooking time, etc"
                >{{$recipe->description}}</textarea>
            @error('description')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <button
                class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
            >
                Update Recipe
            </button>

            <a href="/" class="text-black ml-4"> Back </a>
        </div>
    </form>
    </x-card>

    </x-layout>
