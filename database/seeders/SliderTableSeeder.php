<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SliderTableSeeder extends Seeder
{
    public function run()
    {
        $sliders = [
            ['id' => 1, 'name' => 'Event 1', 'active' => 1, 'position' => 2], 	
            ['id' => 2, 'name' => 'Event 2', 'active' => 1, 'position' => 1],
            ];

        Slider::insert($sliders);
        $media = [
            ['id' => 30, 'model_type' => 'App\Models\Slider', 'model_id' => 1, 'uuid' => 'c9ed5871-8b06-43d5-ad38-195615071675' , 'collection_name' => 'photo', 'name' => '65612126ae921_starmania_g', 'file_name' => '65612126ae921_starmania_g.jpg', 'mime_type' => 'image/webp', 'disk' =>  'public', 'conversions_disk' => 'public', 'size' => '119210', 'manipulations' => '[]', 'custom_properties' => '[]', 'generated_conversions' => '{"thumb": true, "preview": true}', 'responsive_images' => '[]', 'order_column' => 1],            
            ['id' => 35, 'model_type' => 'App\Models\Slider', 'model_id' => 2, 'uuid' => 'f3c41e97-28e7-4419-8b62-3fde50badefa' , 'collection_name' => 'photo', 'name' => '65661a82ae146_noel_g', 'file_name' => '65661a82ae146_noel_g.png', 'mime_type' => 'image/webp', 'disk' =>  'public', 'conversions_disk' => 'public', 'size' => '309806', 'manipulations' => '[]', 'custom_properties' => '[]', 'generated_conversions' => '{"thumb": true, "preview": true}', 'responsive_images' => '[]', 'order_column' => 1],
        ];

        Media::insert($media);        
    }
}



