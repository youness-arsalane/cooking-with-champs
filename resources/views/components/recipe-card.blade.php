@props(['recipe'])
@props(['tags-'])
<x-card>
    <!-- Item -->
      <div class="flex">
          <img
              class="hidden w-48 mr-6 md:block"
              src="{{$recipe->logo ? asset('storage/' . $recipe->logo) : asset('images/no-image.png')}}"
              alt=""
          />
          <div>
              <h3 class="text-2xl">
                  <a href="/recipes/{{$recipe->id}}">{{$recipe->title}}</a>
              </h3>
              <div class="text-xl font-bold mb-4">Acme Corp</div>
              <x-recipe-tags :tagsCsv="$recipe->tags"/>
              <div class="text-lg mt-4">
                  <i class="fa-solid fa-location-dot"></i> Boston,
                  MA
              </div>
          </div>
      </div>
   
</x-card>