<?php

namespace Database\Seeders;

use App\Models\Zone;
use App\Models\Event;
use App\Models\Slider;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class EventTableSeeder extends Seeder
{
    public function run()
    {
        $HomeEvents = [           
            ['id' => 6, 'name' => 'ANDRE RIEU', 'description' =>  '<p>Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet, Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet,</p>', 'home' =>  1, 'date' => Carbon::now(), 'time' => '1H 45min',  'city_id' => 1, 'artist_id' => 1, 'type_id'=>5 ,'category_id' => 3, 'created_by_id' => 2],
            ['id' => 7, 'name' => 'SOPRANO', 'description' =>  '<p>Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet, Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet,</p>', 'home' =>  1, 'date' => Carbon::now(), 'time' => '1H 45min',  'city_id' => 5, 'artist_id' => 2, 'type_id'=>12 ,'category_id' => 4, 'created_by_id' => 2],
            ['id' => 8, 'name' => 'MURMURATION', 'description' =>  '<p>Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet, Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet,</p>', 'home' =>  1, 'date' => Carbon::now(), 'time' => '1H 45min',  'city_id' => 4, 'artist_id' => 5, 'type_id'=>5 ,'category_id' => 5, 'created_by_id' => 2],
            ['id' => 9, 'name' => '1983', 'description' =>  '<p>Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet, Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet,</p>', 'home' =>  1, 'date' => Carbon::now(), 'time' => '1H 45min',  'city_id' => 1, 'artist_id' => 3, 'type_id'=>24 ,'category_id' => 4, 'created_by_id' => 2],
        ];

        Event::insert($HomeEvents);

        $media = [
            ['id' => 13, 'model_type' => 'App\Models\Event', 'model_id' => 6, 'uuid' => '325e403b-996f-4213-bec1-969aba4fca36' , 'collection_name' => 'cover', 'name' => '6561018da6c5e_n_andre-rieu_g ', 'file_name' => '6561018da6c5e_n_andre-rieu_g-.jpg', 'mime_type' => 'image/webp', 'disk' =>  'public', 'conversions_disk' => 'public', 'size' => '19172', 'manipulations' => '[]', 'custom_properties' => '[]', 'generated_conversions' => '{"thumb": true, "preview": true}', 'responsive_images' => '[]', 'order_column' => 1],            
            ['id' => 14, 'model_type' => 'App\Models\Event', 'model_id' => 7, 'uuid' => '350c9b96-d636-44e7-90d3-5527ae95b29f' , 'collection_name' => 'cover', 'name' => '656101ea8a4b8_n_soprano_g ', 'file_name' => '656101ea8a4b8_n_soprano_g-.jpg', 'mime_type' => 'image/webp', 'disk' =>  'public', 'conversions_disk' => 'public', 'size' => '21032', 'manipulations' => '[]', 'custom_properties' => '[]', 'generated_conversions' => '{"thumb": true, "preview": true}', 'responsive_images' => '[]', 'order_column' => 1],
            ['id' => 15, 'model_type' => 'App\Models\Event', 'model_id' => 8, 'uuid' => '95d04fb5-651d-4925-b7f6-c82c039388b2' , 'collection_name' => 'cover', 'name' => '656102748d73f_a_558317_g ', 'file_name' => '656102748d73f_a_558317_g-.jpg', 'mime_type' => 'image/webp', 'disk' =>  'public', 'conversions_disk' => 'public', 'size' => '18614', 'manipulations' => '[]', 'custom_properties' => '[]', 'generated_conversions' => '{"thumb": true, "preview": true}', 'responsive_images' => '[]', 'order_column' => 1],
            ['id' => 16, 'model_type' => 'App\Models\Event', 'model_id' => 9, 'uuid' => '232fa1af-5c98-41d3-a67c-bf69a2124dc9' , 'collection_name' => 'cover', 'name' => '656102b56f3c8_n_1983_g ', 'file_name' => '656102b56f3c8_n_1983_g-.jpg', 'mime_type' => 'image/webp', 'disk' =>  'public', 'conversions_disk' => 'public', 'size' => '22106', 'manipulations' => '[]', 'custom_properties' => '[]', 'generated_conversions' => '{"thumb": true, "preview": true}', 'responsive_images' => '[]', 'order_column' => 1],
        ];

        Media::insert($media); 
        
        $Events = [           
            ['id' => 2, 'name' => 'Lorem ipsum dolor sit sed dmi amet', 'description' =>  '<p>Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet, Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet,</p>', 'home' =>  0, 'date' => Carbon::now(), 'time' => '1H 45min',  'city_id' => 2, 'artist_id' => 4, 'type_id'=>5 ,'category_id' => 4, 'created_by_id' => 2],
            ['id' => 3, 'name' => 'Lorem ipsum dolor sit sed dmi amet', 'description' =>  '<p>Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet, Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet,</p>', 'home' =>  0, 'date' => Carbon::now(), 'time' => '2H 15min',  'city_id' => 4, 'artist_id' => 2, 'type_id'=>1 ,'category_id' => 5, 'created_by_id' => 2],
            ['id' => 4, 'name' => 'Lorem ipsum dolor sit sed dmi amet', 'description' =>  '<p>Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet, Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet,</p>', 'home' =>  0, 'date' => Carbon::now(), 'time' => '2H 00min',  'city_id' => 2, 'artist_id' => 5, 'type_id'=>5 ,'category_id' => 5, 'created_by_id' => 2],
            ['id' => 5, 'name' => 'Lorem ipsum dolor sit sed dmi amet', 'description' =>  '<p>Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet, Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet,</p>', 'home' =>  0, 'date' => Carbon::now(), 'time' => '1H 00min',  'city_id' => 2, 'artist_id' => 3, 'type_id'=>5 ,'category_id' => 5, 'created_by_id' => 2],
            ['id' => 10, 'name' => 'Lorem ipsum dolor sit sed dmi amet', 'description' =>  '<p>Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet, Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet,</p>', 'home' =>  0, 'date' => Carbon::now(), 'time' => '1H 50min',  'city_id' => 1, 'artist_id' => 1, 'type_id'=>5 ,'category_id' => 3, 'created_by_id' => 2],
            ['id' => 11, 'name' => 'Lorem ipsum dolor sit sed dmi amet', 'description' =>  '<p>Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet, Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet,</p>', 'home' =>  0, 'date' => Carbon::now(), 'time' => '1H 15min',  'city_id' => 1, 'artist_id' => 2, 'type_id'=>12 ,'category_id' => 4, 'created_by_id' => 2],
            ['id' => 12, 'name' => 'Lorem ipsum dolor sit sed dmi amet', 'description' =>  '<p>Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet, Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet,</p>', 'home' =>  0, 'date' => Carbon::now(), 'time' => '2H 45min',  'city_id' => 2, 'artist_id' => 7, 'type_id'=>5 ,'category_id' => 5, 'created_by_id' => 2],
            ['id' => 13, 'name' => 'Lorem ipsum dolor sit sed dmi amet', 'description' =>  '<p>Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet, Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet,</p>', 'home' =>  0, 'date' => Carbon::now(), 'time' => '1H 30min',  'city_id' => 4, 'artist_id' => 3, 'type_id'=>24 ,'category_id' => 4, 'created_by_id' => 2],
            ['id' => 14, 'name' => 'Lorem ipsum dolor sit sed dmi amet', 'description' =>  '<p>Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet, Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet,</p>', 'home' =>  0, 'date' => Carbon::now(), 'time' => '1H 00min',  'city_id' => 1, 'artist_id' => 1, 'type_id'=>5 ,'category_id' => 3, 'created_by_id' => 2],
            ['id' => 15, 'name' => 'Lorem ipsum dolor sit sed dmi amet', 'description' =>  '<p>Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet, Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet,</p>', 'home' =>  0, 'date' => Carbon::now(), 'time' => '3H 00min',  'city_id' => 5, 'artist_id' => 7, 'type_id'=>12 ,'category_id' => 4, 'created_by_id' => 2],
            ['id' => 16, 'name' => 'Lorem ipsum dolor sit sed dmi amet', 'description' =>  '<p>Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet, Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet,</p>', 'home' =>  0, 'date' => Carbon::now(), 'time' => '1H 05min',  'city_id' => 5, 'artist_id' => 5, 'type_id'=>5 ,'category_id' => 5, 'created_by_id' => 2],
            ['id' => 17, 'name' => 'Lorem ipsum dolor sit sed dmi amet', 'description' =>  '<p>Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet, Mauris blandit aliquet elit, eget tincidunt nibh dolor sit amet,</p>', 'home' =>  0, 'date' => Carbon::now(), 'time' => '2H 35min',  'city_id' => 4, 'artist_id' => 7, 'type_id'=>24 ,'category_id' => 4, 'created_by_id' => 2],                        
        ];   
        Event::insert($Events);
        $medias = [
            ['id' => 9, 'model_type' => 'App\Models\Event', 'model_id' => 2, 'uuid' => '96d9ab6c-671d-4199-aa6c-b42d2d165825' , 'collection_name' => 'cover', 'name' => '65579665f2a56_n_andre-rieu_g', 'file_name' => '65579665f2a56_n_andre-rieu_g.png', 'mime_type' => 'image/webp', 'disk' =>  'public', 'conversions_disk' => 'public', 'size' => '19172', 'manipulations' => '[]', 'custom_properties' => '[]', 'generated_conversions' => '{"thumb": true, "preview": true}', 'responsive_images' => '[]', 'order_column' => 1],            
            ['id' => 10, 'model_type' => 'App\Models\Event', 'model_id' => 3, 'uuid' => 'f1bd797b-3edf-427a-82a8-4e8e9290f23a' , 'collection_name' => 'cover', 'name' => '6557995e0e07e_n_andre-rieu_g', 'file_name' => '6557995e0e07e_n_andre-rieu_g.png', 'mime_type' => 'image/webp', 'disk' =>  'public', 'conversions_disk' => 'public', 'size' => '19172', 'manipulations' => '[]', 'custom_properties' => '[]', 'generated_conversions' => '{"thumb": true, "preview": true}', 'responsive_images' => '[]', 'order_column' => 1],
            ['id' => 11, 'model_type' => 'App\Models\Event', 'model_id' => 4, 'uuid' => '6aab70dd-29d7-4864-bfd5-67b6da0f38bf' , 'collection_name' => 'cover', 'name' => '65579b1fbfad6_arthur-jugnot-841545', 'file_name' => '65579b1fbfad6_arthur-jugnot-841545.jpg', 'mime_type' => 'image/jpeg', 'disk' =>  'public', 'conversions_disk' => 'public', 'size' => '7233', 'manipulations' => '[]', 'custom_properties' => '[]', 'generated_conversions' => '{"thumb": true, "preview": true}', 'responsive_images' => '[]', 'order_column' => 1],
            ['id' => 12, 'model_type' => 'App\Models\Event', 'model_id' => 5, 'uuid' => '9d6f9507-538d-4f55-abd8-3eaa68b8c6f7' , 'collection_name' => 'cover', 'name' => '65579e30403ab_chantal-ladesou-20190821115158', 'file_name' => '65579e30403ab_chantal-ladesou-20190821115158.jpg', 'mime_type' => 'image/jpeg', 'disk' =>  'public', 'conversions_disk' => 'public', 'size' => '22669', 'manipulations' => '[]', 'custom_properties' => '[]', 'generated_conversions' => '{"thumb": true, "preview": true}', 'responsive_images' => '[]', 'order_column' => 1],
            ['id' => 17, 'model_type' => 'App\Models\Event', 'model_id' => 10, 'uuid' => '646c75e7-a976-46fc-b01d-64fc882372f1' , 'collection_name' => 'cover', 'name' => '656116131d588_a_549071_g ', 'file_name' => '656116131d588_a_549071_g-.jpg', 'mime_type' => 'image/webp', 'disk' =>  'public', 'conversions_disk' => 'public', 'size' => '19172', 'manipulations' => '[]', 'custom_properties' => '[]', 'generated_conversions' => '{"thumb": true, "preview": true}', 'responsive_images' => '[]', 'order_column' => 1],            
            ['id' => 18, 'model_type' => 'App\Models\Event', 'model_id' => 11, 'uuid' => '01668ce4-ccb0-4e20-8811-87ccbf974656' , 'collection_name' => 'cover', 'name' => '65611655b96fb_a_558285_g ', 'file_name' => '65611655b96fb_a_558285_g-.jpg', 'mime_type' => 'image/webp', 'disk' =>  'public', 'conversions_disk' => 'public', 'size' => '19172', 'manipulations' => '[]', 'custom_properties' => '[]', 'generated_conversions' => '{"thumb": true, "preview": true}', 'responsive_images' => '[]', 'order_column' => 1],
            ['id' => 19, 'model_type' => 'App\Models\Event', 'model_id' => 12, 'uuid' => '88d3b8bf-d00c-4a74-8e0f-335c52d5aaec' , 'collection_name' => 'cover', 'name' => '6561168632d84_a_558317_g ', 'file_name' => '6561168632d84_a_558317_g-.jpg', 'mime_type' => 'image/jpeg', 'disk' =>  'public', 'conversions_disk' => 'public', 'size' => '7233', 'manipulations' => '[]', 'custom_properties' => '[]', 'generated_conversions' => '{"thumb": true, "preview": true}', 'responsive_images' => '[]', 'order_column' => 1],
            ['id' => 20, 'model_type' => 'App\Models\Event', 'model_id' => 13, 'uuid' => '6618504b-db21-4371-9757-fc5fafaf358c' , 'collection_name' => 'cover', 'name' => '656116ad770e9_a_559596_g ', 'file_name' => '656116ad770e9_a_559596_g-.jpg', 'mime_type' => 'image/jpeg', 'disk' =>  'public', 'conversions_disk' => 'public', 'size' => '22669', 'manipulations' => '[]', 'custom_properties' => '[]', 'generated_conversions' => '{"thumb": true, "preview": true}', 'responsive_images' => '[]', 'order_column' => 1],
            ['id' => 21, 'model_type' => 'App\Models\Event', 'model_id' => 14, 'uuid' => '2881a866-7731-4a95-ac69-507ad4585fec' , 'collection_name' => 'cover', 'name' => '656116d426a8b_a_568022_g ', 'file_name' => '656116d426a8b_a_568022_g-.jpg', 'mime_type' => 'image/webp', 'disk' =>  'public', 'conversions_disk' => 'public', 'size' => '19172', 'manipulations' => '[]', 'custom_properties' => '[]', 'generated_conversions' => '{"thumb": true, "preview": true}', 'responsive_images' => '[]', 'order_column' => 1],            
            ['id' => 22, 'model_type' => 'App\Models\Event', 'model_id' => 15, 'uuid' => '30953928-53f1-4bcb-bfd9-0e3726499027' , 'collection_name' => 'cover', 'name' => '656116f9f1cfa_n_1983_g ', 'file_name' => '656116f9f1cfa_n_1983_g-.jpg', 'mime_type' => 'image/webp', 'disk' =>  'public', 'conversions_disk' => 'public', 'size' => '19172', 'manipulations' => '[]', 'custom_properties' => '[]', 'generated_conversions' => '{"thumb": true, "preview": true}', 'responsive_images' => '[]', 'order_column' => 1],
            ['id' => 23, 'model_type' => 'App\Models\Event', 'model_id' => 16, 'uuid' => 'c7590fd8-0071-4ab3-b3b5-35fec622a7d7' , 'collection_name' => 'cover', 'name' => '65611726285ce_n_fary_g ', 'file_name' => '65611726285ce_n_fary_g-.jpg', 'mime_type' => 'image/jpeg', 'disk' =>  'public', 'conversions_disk' => 'public', 'size' => '7233', 'manipulations' => '[]', 'custom_properties' => '[]', 'generated_conversions' => '{"thumb": true, "preview": true}', 'responsive_images' => '[]', 'order_column' => 1],
            ['id' => 24, 'model_type' => 'App\Models\Event', 'model_id' => 17, 'uuid' => '632ffa9a-5359-47b3-88c2-0a60fb5f5ce6' , 'collection_name' => 'cover', 'name' => '6561174a0de76_n_pat-patrouille-le-spectacle_g ', 'file_name' => '6561174a0de76_n_pat-patrouille-le-spectacle_g-.jpg', 'mime_type' => 'image/jpeg', 'disk' =>  'public', 'conversions_disk' => 'public', 'size' => '22669', 'manipulations' => '[]', 'custom_properties' => '[]', 'generated_conversions' => '{"thumb": true, "preview": true}', 'responsive_images' => '[]', 'order_column' => 1],                        
        ];

        Media::insert($medias); 
        
        //ZONE
        $zones = [
            ['name' => 'Class A', 'seat' => 100, 'sold_seat' => 0, 'price' => '150.00'],
            ['name' => 'Class B', 'seat' => 200, 'sold_seat' => 0, 'price' => '50.00'],
        ];
      
        $events = [2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17];
        foreach($events as $event)
        {
            foreach($zones as $zone){
                Zone::create([...$zone, 'event_id' => $event, 'created_by_id' => 2]);
            }
        }
	 
    }
}



