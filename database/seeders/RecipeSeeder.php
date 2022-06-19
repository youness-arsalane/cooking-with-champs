<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recipes')->insert([
            'user_id' => 1,
            'title' => 'Slow Cooker Beef Stew with Fruit Chutney',
            'logo' => 'Slowcooker_chutney_beef_veggie_casserole.jpeg',
            'tags' => 'dinner',
            'description' => 'Season flour with salt and pepper and coat the beef cubes
Preheat a large frying pan on medium-high heat. Add 2 tbsp oil and brown the beef on all sides, in batches. Transfer to slow cooker
In the same pan, heat remaining oil. Add onion, garlic and thyme. Cook, stirring often, over medium heat for 3-4 minutes until onion is tender. Stir in tomato paste. Add red wine. Bring to the boil
Transfer onion mixture to the bowl of slow cooker. Add stock, carrots, celery and chutney
Cover and cook on HIGH for 4-6 hours, or LOW for 7-8 hours. Top with chopped parsley. Serve with mashed potato and beans',
            'created_at' => '2022-06-14 11:47:44',
            'updated_at' => '2022-06-18 14:18:35',
        ]);
        DB::table('recipes')->insert([
            'user_id' => 1,
            'title' => 'Glazed Teriyaki Eggplant with Edamame Rice Salad',
            'logo' => 'Roasted_glazed_teriyaki_eggplant_2423.jpeg',
            'tags' => 'dinner',
            'description' => 'Preheat oven 200°C/180°C (fan-forced). Grease a large baking tray with vegetable oil
Slice the eggplants in half, lengthways, and score the flesh in a diagonal pattern, taking care not to slice through the skin
Heat oil in a small pan over medium heat and add ginger and garlic paste sachet. Cook for 10 seconds. Stir in Japanese Teriyaki Chicken Stir-fry Sauce and simmer for 1-2 minutes until thickened. Spoon liberally over eggplants. Bake in oven for 40-45 minutes or until eggplants are tender and top is glazed
Toast sesame seeds in a dry frying pan for a few minutes or until golden
BROWN RICE AND EDAMAME SALAD
Follow packet instruction to cook edamame, cool and add to cooked brown rice, radish, green onion and coriander
DRESSING
Mix together rice vinegar, soy sauce, and olive oil. Season with salt and pepper. Drizzle over edamame rice salad and mix well
To serve, sprinkle toasted sesame seeds and green onions over eggplants. Serve immediately with edamame rice salad garnished with extra coriander.',
            'created_at' => '2022-06-14 11:47:44',
            'updated_at' => '2022-06-18 14:18:35',
        ]);
        DB::table('recipes')->insert([
            'user_id' => 1,
            'title' => 'Pumpkin and Lentil Rogan Josh Curry',
            'logo' => 'passage_to_india_pumpkin_with_lentils_rogan_josh.jpeg',
            'tags' => 'dinner',
            'description' => 'Preheat oven 200°C/180°C (fan-forced) and line a baking tray with baking paper
Scoop out seeds from pumpkin and score flesh in a criss-cross pattern. Place onto baking tray, cut side up. Drizzle over 1 tbsp of oil and season with salt and pepper. Roast for 45 minutes
Meanwhile, heat 1 tbsp oil in a large pan over medium-high heat and cook onion for 3 minutes. Add Rogan Josh Simmer Sauce and lentils. Reduce heat and simmer for 2 minutes. Stir in spinach. Remove from heat and set aside
Using a large spoon, scoop out large chunks of pumpkin, making sure to leave approx. 1.5 - 2cm of flesh around the skin and base
Add pumpkin chunks to curry and mix well
Divide curry into hollowed out pumpkins and top with grated paneer. Drizzle over remaining oil. Bake for a further 15 minutes or until the top is golden. Top with coriander and serve with steamed basmati rice',
            'created_at' => '2022-06-14 11:47:44',
            'updated_at' => '2022-06-18 14:18:35',
        ]);
        DB::table('recipes')->insert([
            'user_id' => 1,
            'title' => 'Beef Stroganoff in Garlic Cob Loaf "The Cobanoff"',
            'logo' => 'WS_Winter_Cobanoff_001.jpeg',
            'tags' => 'dinner',
            'description' => 'Preheat oven to 200°C/180°C fan forced. Line a large baking tray with baking paper. Use a serrated knife to slice about 3cm from the top of the cob. Scoop out the bread inside leaving a 1.5cm-thick shell. Place the scooped-out bread pieces in a bowl. Cut the cob lid into 4 pieces and add to the bowl
Combine the melted Spreadable, garlic and parsley in a bowl. Drizzle over the bread pieces, toss to ensure they are evenly coated. Brush the inside and top cut edge of the cob with the remaining garlic spread
Add the bread pieces to the prepared baking tray, leaving room for the cob. Bake for 20 minutes, adding the cob for the final 10 minutes
While the cob is baking, make the beef stroganoff
BEEF STROGANOFF
Heat half the Spreadable in a large frying pan over high heat. Add beef in 2 batches and cook for 2-3 minutes or until browned all over. Transfer to a plate
Heat the remaining 1 tbsp Spreadable in the pan. Add the onion, mushrooms and garlic and cook for 4-5 minutes or until the onion softens. Add the paprika, cream, 2/3 cup beef stock, tomato paste and Worcestershire sauce. Stir to combine. Return beef to pan.
Combine the cornflour and extra tablespoon of beef stock and stir into the pan. Simmer for 6-8 minutes or until slightly thickened and creamy. Season to taste. Stir through parsley.
When ready to serve, spoon the stroganoff into the cob. Serve with the garlic bread pieces',
            'created_at' => '2022-06-14 11:47:44',
            'updated_at' => '2022-06-18 14:18:35',
        ]);
        DB::table('recipes')->insert([
            'user_id' => 1,
            'title' => 'Vegetarian Cabbage Rolls',
            'logo' => 'whisk_rosella_cabbage_rolls_vegetarian.jpeg',
            'tags' => 'dinner',
            'description' => 'Steam cabbage leaves and set aside to cool (see tips). Heat oil in a large deep pan and cook onion, garlic and mushroom for 3 minutes. Add carrot and zucchini and continue cooking for a further 5 minutes or until softened. Transfer to a bowl and cool slightly
Add unheated 7 ancient grains sachet and eggs. Season with salt and pepper. Add 2 tbsp of condensed tomato soup to the mixture and mix well. Set aside
Transfer steamed cabbage to a chopping board and pat dry with paper towel. Cut out thick centre vein from each cabbage leaf. Spoon 2 heaped tbsp of mixture along the base of the leaf. Roll up cabbage leaf, folding in sides, to enclose filling. Repeat with remaining leaves and filling
Add condensed tomato soup and stock to a large deep pan. Bring to a simmer and nestle cabbage rolls in the sauce in a single layer. Cover. Reduce heat to low and simmer for 20-25 minutes
Garnish with basil and serve with mashed potato and crusty bread',
            'created_at' => '2022-06-14 11:47:44',
            'updated_at' => '2022-06-18 14:18:35',
        ]);
    }
}
