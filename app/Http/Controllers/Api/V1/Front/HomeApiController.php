<?php

namespace App\Http\Controllers\Api\V1\Front;

use Gate;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Type;
use App\Models\Event;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class HomeApiController extends Controller{

    public function index(Request $request){
       $homeEvents = Event::where('home', 1)->with('type:id,name,slug')->take(4)->inRandomOrder()->get()->map(function ($event) {
        return ['id' => $event['id'],
                'name' => $event['name'], 
                'description' => $event['description'], 
                'date' => $event['date'],
                'time' => $event['time'], 
                'type' => $event['type']->toArray(),
                'cover' => $event['cover']['url']];
        });
        $allEvents = Event::where('home', 0)->with('type:id,name,slug')->take(9)->orderBy('created_at', 'desc')->get()->map(function ($event) {
            return ['id' => $event['id'],
                    'name' => $event['name'], 
                    'description' => $event['description'], 
                    'date' => $event['date'],
                    'time' => $event['time'], 
                    'type' => $event['type']->toArray(),
                    'cover' => $event['cover']['url']];
            });
        
        return response()->json(
                [                                   
                    "cities" => City::take(7)->get()->toArray(),
                    "homeEvents" => $homeEvents,
                    "types" => array_merge([['slug' => 'all', 'name' => 'Tout']],Type::take(5)->get()->toArray()),
                    "allEvents" => $allEvents,
                ]);
    }

    public function slider(){
        return response()->json(["slider" => Slider::where('active', 1)->orderby('position', 'asc')->get()->map(function($slider){
            return $slider['photo']['url'];
        })]);
    }

}