<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Type;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories =[ ["name" => "Concert",
                       'type' => [
                                ['name' => 'French Pop', "slug" => 'french-pop'],
                                ['name' => 'Pop / Rock / Folk', "slug" => 'pop-rock-folk'],
                                ['name' => 'International Pop', "slug" => 'international-pop'],
                                ['name' => 'Rap / Hip-Hop / Slam',"slug" => 'rap-hip-hop-slam'],
                                ['name' => 'Hard rock & metal', "slug" => 'hard-rock-metal']
                                ]
                    ],
                    ["name" => "Festival",
                    'type' => [
                                 ['name' => 'Music Festival', "slug" => 'music-festival'],
                                 ['name' => 'Comedy Festival', "slug" => 'comedy-festival'],
                                 ['name' => 'Theatre Festival', "slug" => 'theatre-festival'],
                                 ['name' => 'Classical Music & Opéra', "slug" => 'classical-music-opera'],
                                 ['name' => 'Other Festivals', "slug" => 'other-festivals']
                             ]
                    ],
                    ["name" => "Shows",
                    'type' => [
                                 ['name' => 'Musical', "slug" => 'musical'],
                                 ['name' => 'Musical Show', "slug" => 'musical-show'],
                                 ['name' => 'Horse Show', "slug" => 'horse-show'],
                                 ['name' => 'Dance', "slug" => 'dance'],
                                 ['name' => 'Circus', "slug" => 'circus'],
                                 ['name' => 'Magic', "slug" => 'magic'],
                                 ['name' => 'Traditional show', "slug" => 'traditional-show'],
                                 ['name' => 'Other Shows', "slug" => 'other-shows']                                 
                             ]
                    ],                    
                    ["name" => "Theatre",
                    'type' => [
                                 ['name' => 'Contemporary Theatre', "slug" => 'contemporary-theatre'],
                                 ['name' => "Children's Theatre", "slug" => 'childrens-theatre'],
                                 ['name' => 'Classical Theatre', "slug" => 'classical-theatre'],
                                 ['name' => 'Story', "slug" => 'story'],
                                 ['name' => 'Other theatres', "slug" => 'other-theatres']
                             ]
                    ],
                    ["name" => "Humor",
                    'type' => [
                                 ['name' => 'Comedy', "slug" => 'comedy'],
                                 ['name' => 'One (wo)man show', "slug" => 'one-woman-show'],
                                 ['name' => 'Humorist', "slug" => 'humorist'],
                                 ['name' => 'Impro', "slug" => 'impro']                                 
                             ]
                    ],
                    ["name" => "Sport",
                    'type' => [
                                 ['name' => 'Soccer', "slug" => 'soccer'],
                                 ['name' => 'Tennis', "slug" => 'tennis'],
                                 ['name' => 'Basketball', "slug" => 'basketball'],
                                 ['name' => 'Rugby', "slug" => 'rugby'],
                                 ['name' => 'Handball', "slug" => 'handball'],
                                 ['name' => 'Athlétics', "slug" => 'athletics'],
                                 ['name' => 'Car sport', "slug" => 'car-sport'],
                                 ['name' => 'Other sports', "slug" => 'other-sports']
                             ]
                    ],
                  
                ];
        foreach($categories as $category){
            
            $cat = Category::create(['name' => $category['name']]);

            foreach($category['type'] as $type){
                $tp = Type::create($type);
                $tp->categories()->sync($cat);
            }  
        }

    }
}












