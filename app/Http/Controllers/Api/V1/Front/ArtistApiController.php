<?php

namespace App\Http\Controllers\Api\V1\Front;

use Gate;


use Carbon\Carbon;
use App\Models\Tag;
use App\Models\City;
use App\Models\Artist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class ArtistApiController extends Controller{

    public function index(Request $request){
        
        return response()->json([
            "artists" => Artist::paginate(3),
            // ->map(function($artist){
            //     return ["id" => $artist['id'], 
            //             "name" => $artist['name'],
            //             'photo' => $artist['photo']['url']];
            // }),
            "tags" => array_merge([['id' => 'all', 'slug' => 'all','name' => 'All']],Tag::orderBy("name")->take(20)->get()->toArray())]);
    }

    public function artistsBytags(Request $request){      

            $artists = Artist::paginate(6);    
            if($request->tag && $request->tag != 'all') 
            {                
                $tag =  Tag::where('slug', $request->tag)->get();
                $artists = ($tag->count() == 1) ? $tag->first()->artists()->paginate(3):[];
            }
           return response()->json([
            "artists" => $artists,
            "tags" => array_merge([['id' => 'all', 'slug' => 'all','name' => 'Tout']],Tag::orderBy("name")->take(20)->get()->toArray())
           ]);     
    }

    public function events(Request $request){
        $req = Artist::where('slug' , $request->artist)->get();
        if($req->count() == 1){
            $artist = $req->first();
            return response()->json(["artist" => 
                    ['name' => $artist['name'], 'slug' => $artist['slug'], 'description' => $artist['description'],
                    'facebook' => $artist['link_facebook'], 'twitter' => $artist['link_twitter'],
                    'instagram' => $artist['link_insta'], 'photo' => $artist['photo']['url']],  
            "cities" => City::orderby('name', 'asc')->get()->toArray(),
            "events" => $artist->events()->orderBy('created_at', 'desc')->get()->map(function ($event) {
                return ['id' => $event['id'],
                        'name' => $event['name'], 
                        'description' => $event['description'],                                             
                        'date' => $event['date'],
                        'time' => $event['time'], 
                        'type' => $event['type']->toArray(),
                        'cover' => $event['cover']['url'],
                        'city_id' => $event['city_id']];
                }), 'status' => 200]);
        }
        return response()->json(['status' => 404]);
    }
}