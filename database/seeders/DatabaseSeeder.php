<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Recipe;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@mail.com'
        ]);

        Recipe::factory(6)->create([
            'user_id' => $user->id
        ]);

        // Recipe::create([
        //     'title' => 'Chowmein met kip', 
        //     'tags' => 'kip, noodles, bosui',
        //     'description' => 'Chow mein, je kent het misschien wel. Chow mein is een Chinees gerecht met noedels en groenten en soms ook vlees of tofu. Wij hebben dit recept gemaakt met paksoi, kip, shii-take en peen. In ongeveer 25 minuten staat het gerecht op tafel.'         
        // ]);
        // Recipe::create([
        //     'title' => 'Noedelsalade met kip',
        //     'tags' => 'noodles, kip, bosui',
        //     'description' => 'We kregen het verzoek of we eens een recept met noedels konden maken. Wij zijn meteen de keuken ingedoken en hebben een noedelsalade met kip, komkommer, wortel en taugé gemaakt. Je kunt de salade warm eten, lauwwarm of koud. Net wat jij lekker vindt.'        
        // ]);
        // Recipe::create([
        //     'title' => 'Kip pesto tosti', 
        //     'tags' => 'kip, noodles, bosui',
        //     'description' => 'Veel beter dan deze kip pesto tosti voor de lunch gaat het niet worden, zo lekker! Dus lunch je thuis en heb je wat meer tijd? Maak dan zeker deze tosti!'         
        // ]);
        // Recipe::create([
        //     'title' => 'Mexicaanse ovenschoten met kip',
        //     'tags' => 'kip, noodles, bosui',
        //     'description' => 'Veel makkelijker dan dit recept, een Mexicaanse ovenschotel met kip, gaat het niet worden. Het is een kwestie van alle ingrediënten in stukjes snijden, op smaak brengen en dan hup de oven in. Als je weinig tijd of zin hebt, is dit recept ideaal!'        
        // ]);
        // Recipe::create([
        //     'title' => 'Kip hawai met rijst', 
        //     'tags' => 'kip, noodles, bosui',
        //     'description' => 'Kip hawai, wie kent het niet? Dit lekkere gerecht met kip, ananas, paprika en ui zet je in 25 tot 30 minuten op tafel. Serveer de kip hawai met rijst. Wij vinden het ook lekker om er wat cassave kroepoek bij te serveren.'         
        // ]);
        // Recipe::create([
        //     'title' => 'Pasta met kip en aubergine',
        //     'tags' => 'kip, noodles, bosui',
        //     'description' => 'Maken jullie wel eens een recept met aubergine? Wij eigenlijk niet zo vaak terwijl we aubergine wel erg lekker vinden. Dus daarom dit recept voor een pasta met kip en aubergine. Makkelijk, lekker en heel snel klaar, in 20-25 minuten staat dit pastarecept op tafel.'        
        // ]);
    }
}
