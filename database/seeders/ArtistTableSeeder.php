<?php

namespace Database\Seeders;

use App\Models\Tag;

use App\Models\Artist;
use Illuminate\Database\Seeder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ArtistTableSeeder extends Seeder
{
    public function run()
    {
        $Artists = [
            ['id' => 1, 'name' => 'Arthur Jugnot', 'slug' => 'arthur-jugnot',
            'description' => '<p>Mauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit amet</p>',
            'link_facebook' => 'https://facebook.com/arthur_jugnot', 'link_twitter' => 'https://twitter.com/arthur_jugnot', 'link_insta' => 'https://instagram.com/arthur_jugnot'],
            ['id' => 2, 'name' => 'Gil Alma', 'slug' => 'gil-alma',
            'description' => '<p>Mauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit amet</p>',
            'link_facebook' => 'https://facebook.com/gil-alma', 'link_twitter' => 'https://twitter.com/gil-alma', 'link_insta' => 'https://instagram.com/gil-alma'],
            ['id' => 3, 'name' => 'Alison Wheeler', 'slug' => 'alison-wheeler',
            'description' => '<p>Mauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit amet</p>',
            'link_facebook' => 'https://facebook.com/alison-wheeler', 'link_twitter' => 'https://twitter.com/alison-wheeler', 'link_insta' => 'https://instagram.com/alison-wheeler'],
            ['id' => 4, 'name' => 'Chantal Ladesou', 'slug' => 'chantal-ladesou',
            'description' => '<p>Mauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit amet</p>',
            'link_facebook' => 'https://facebook.com/chantal-ladesou', 'link_twitter' => 'https://twitter.com/chantal-ladesou', 'link_insta' => 'https://instagram.com/chantal-ladesou'],
            ['id' => 5, 'name' => 'Laura Felpin', 'slug' => 'laura-felpin',
            'description' => '<p>Mauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit amet</p>',
            'link_facebook' => 'https://facebook.com/laura-felpin', 'link_twitter' => 'https://twitter.com/laura-felpin', 'link_insta' => 'https://instagram.com/laura-felpin'],
            ['id' => 6, 'name' => 'West Side Story', 'slug' => 'west-side-story',
            'description' => '<p>Mauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit amet</p>',
            'link_facebook' => 'https://facebook.com/west-side-story', 'link_twitter' => 'https://twitter.com/west-side-story', 'link_insta' => 'https://instagram.com/west-side-story'],                                                            
            ['id' => 7, 'name' => "l'opéra urbain", 'slug' => 'moliere-lopera-urbain',
            'description' => '<p>Mauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit ametMauris blandit aliquet elit, eget tincidunt nibh dolor sit amet</p>',
            'link_facebook' => 'https://facebook.com/moliere-lopera-urbain', 'link_twitter' => 'https://twitter.com/moliere-lopera-urbain', 'link_insta' => 'https://instagram.com/moliere-lopera-urbain'],                                                                        
        ];

        Artist::insert($Artists);
        
        $media = [
            ['id' => 1, 'model_type' => 'App\Models\Artist', 'model_id' => 1, 'uuid' => '59921120-8c3a-4d43-aabc-e8629a794275' , 'collection_name' => 'photo', 'name' => '65578161e657a_arthur-jugnot-841545', 'file_name' => '65578161e657a_arthur-jugnot-841545.jpg', 'mime_type' => 'image/jpeg', 'disk' =>  'public', 'conversions_disk' => 'public', 'size' => '7233', 'manipulations' => '[]', 'custom_properties' => '[]', 'generated_conversions' => '{"thumb": true, "preview": true}', 'responsive_images' => '[]', 'order_column' => 1],           
            ['id' => 2, 'model_type' => 'App\Models\Artist', 'model_id' => 2, 'uuid' => '2c5d277e-dcff-4293-b51f-22299908560b' , 'collection_name' => 'photo', 'name' => '655782b1df314_gil-alma-20230214163832', 'file_name' => '655782b1df314_gil-alma-20230214163832.jpg', 'mime_type' => 'image/jpeg', 'disk' =>  'public', 'conversions_disk' => 'public', 'size' => '56343', 'manipulations' => '[]', 'custom_properties' => '[]', 'generated_conversions' => '{"thumb": true, "preview": true}', 'responsive_images' => '[]', 'order_column' => 1],
            ['id' => 3, 'model_type' => 'App\Models\Artist', 'model_id' => 3, 'uuid' => '9468e748-4522-4f92-a5ba-2b9222ef9bbc' , 'collection_name' => 'photo', 'name' => '655782f76780d_alison-wheeler-uq7o', 'file_name' => '655782f76780d_alison-wheeler-uq7o.jpg', 'mime_type' => 'image/jpeg', 'disk' =>  'public', 'conversions_disk' => 'public', 'size' => '16439', 'manipulations' => '[]', 'custom_properties' => '[]', 'generated_conversions' => '{"thumb": true, "preview": true}', 'responsive_images' => '[]', 'order_column' => 1],
            ['id' => 4, 'model_type' => 'App\Models\Artist', 'model_id' => 4, 'uuid' => 'fcc741d9-6922-4b83-a7af-950b39a52299' , 'collection_name' => 'photo', 'name' => '655783c473e46_chantal-ladesou-20190821115158', 'file_name' => '655783c473e46_chantal-ladesou-20190821115158.jpg', 'mime_type' => 'image/jpeg', 'disk' =>  'public', 'conversions_disk' => 'public', 'size' => '22669', 'manipulations' => '[]', 'custom_properties' => '[]', 'generated_conversions' => '{"thumb": true, "preview": true}', 'responsive_images' => '[]', 'order_column' => 1],
            ['id' => 5, 'model_type' => 'App\Models\Artist', 'model_id' => 5, 'uuid' => '677d9b6d-76ae-40ff-8552-49c1c12b7df8 ' , 'collection_name' => 'photo', 'name' => '6557840fb69b8_laura-felpin-20230424154821', 'file_name' => '6557840fb69b8_laura-felpin-20230424154821.jpg', 'mime_type' => 'image/jpeg', 'disk' =>  'public', 'conversions_disk' => 'public', 'size' => '9585', 'manipulations' => '[]', 'custom_properties' => '[]', 'generated_conversions' => '{"thumb": true, "preview": true}', 'responsive_images' => '[]', 'order_column' => 1],          
            ['id' => 6, 'model_type' => 'App\Models\Artist', 'model_id' => 6, 'uuid' => '2011b0d8-b6c9-43de-af3b-a569d160dbe3' , 'collection_name' => 'photo', 'name' => '65578469f315c_west-side-story--rk-93705693', 'file_name' => '65578469f315c_west-side-story--rk-93705693.jpg ', 'mime_type' => 'image/jpeg', 'disk' =>  'public', 'conversions_disk' => 'public', 'size' => '9137', 'manipulations' => '[]', 'custom_properties' => '[]', 'generated_conversions' => '{"thumb": true, "preview": true}', 'responsive_images' => '[]', 'order_column' => 1],
            ['id' => 7, 'model_type' => 'App\Models\Artist', 'model_id' => 7, 'uuid' => '8cab27a8-ea95-485f-a081-257fb4929536' , 'collection_name' => 'photo', 'name' => '655784d3bc9e2_moliere-l-opera-urbain-20230404114207', 'file_name' => '655784d3bc9e2_moliere-l-opera-urbain-20230404114207.jpg', 'mime_type' => 'image/jpeg', 'disk' =>  'public', 'conversions_disk' => 'public', 'size' => '82759', 'manipulations' => '[]', 'custom_properties' => '[]', 'generated_conversions' => '{"thumb": true, "preview": true}', 'responsive_images' => '[]', 'order_column' => 1],
        ];

        Media::insert($media);
       
       $Tags = [
        ['name' => 'Comedy', 'slug' => 'comedy', 'artists' => [1, 2, 3, 4, 5, 6]],
        ['name' => 'Humorist', 'slug' => 'humorist', 'artists' => [2, 3, 7]],
        ['name' => 'Musical Show', 'slug' => 'musical-show', 'artists' => [5, 7]],
        ['name' => 'Musical', 'slug' => 'musical', 'artists' => [4, 6, 7]],
        ['name' => 'tags', 'slug' => 'tags', 'artists' => [1, 2, 3]]
       ];

       foreach($Tags as $tag){
        $tg = Tag::create(['name' => $tag['name'], 'slug' => $tag['slug']]);
        $tg->artists()->sync($tag['artists']);
        } 

    }
}












