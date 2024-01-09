<?php

namespace App\Http\Controllers\Api\V1\Front;

use Gate;


use Carbon\Carbon;
use App\Models\City;
use App\Models\Type;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Laravel\Prompts\Concerns\Events;
use Symfony\Component\HttpFoundation\Response;

class EventApiController extends Controller{

    public function search(Request $request){        
        
        $city = '';        
        $search = '';

        if($request->city && $request->city != 'all'){
            $req =  City::where('name', $request->city)->get();   
            $city = ($req->count() == 1) ? $req->first()['id']:'none';
        }
        
        if($request->search && $request->search != '') $search = $request->search;
        else $search = 'no event found';

        $events = Event::with(["type:id,name,slug"])
        ->select('events.*', 'artists.name as artist')
        ->join('artists', 'artists.id','=', 'events.artist_id')
        ->when($city, function($query, $city){
            return $query->where(function($query) use($city){
                return $query->where('city_id', $city);
            });
        })->where(function($query) use ($search){
            return $query->where('events.name', 'like', '%'.$search.'%')
                ->orWhere('events.description', 'like', '%'.$search.'%')
                ->orWhere('artists.name', 'like', '%'.$search.'%');
        })   
        ->orderBy('events.created_at', 'desc')
        ->paginate(9);
        
        return response()->json([
            "events" => $events,
            "selectedCity" => $city ?? 0,
            "menu" => Category::with('types')->orderBy('name')->get()->map(function($menu){
                return ['id' => $menu['id'], 'name' => $menu['name'], 'types' => $menu['types']->map(function($type) {
                    return ['id' => $type['id'], 'name' => $type['name'], 'slug' => $type['slug']];
                })];
            })]);
    }

    public function index(Request $request){
        
        $type = '';
        $city = '';        

        if($request->param && $request->param == 'type'){
            if($request->name != 'all'){
                $reqT =  Type::where('slug', $request->name)->get(); 
                $type = ($reqT->count() == 1) ? $reqT->first()['id']:'none';
            }
  
            $req =  City::where('name', $request->city)->get();   
            $city = ($req->count() == 1) ? $req->first()['id']:'';         
        }elseif($request->param && $request->param == 'city' && $request->name != 'all'){
            $req =  City::where('name', $request->name)->get();   
            $city = ($req->count() == 1) ? $req->first()['id']:'none';
        }

        $events = Event::with(["type:id,name,slug"])
        ->select('events.*', 'artists.name as artist')
        ->join('artists', 'artists.id','=', 'events.artist_id')
        ->when($type, function($query, $type){
            return $query->where(function($query) use($type){
                return $query->where('type_id', $type);
            });
        })->when($city, function($query, $city){
            return $query->where(function($query) use($city){
                return $query->where('city_id', $city);
            });
        })       
        ->orderBy('events.created_at', 'desc')
        ->paginate(9);

        return response()->json([
            "cities" => City::orderby('name', 'asc')->get()->toArray(),
            "events" => $events,
            "selectedCity" => $city ?? 0]);
    }

    public function details(Event $event){        
        return response()->json(['event' =>  ['id' => $event['id'],
                                    'name' => $event['name'], 
                                    'description' => $event['description'],                                             
                                    'date' => Carbon::parse($event['date'])->format('d-m-y H:i'),
                                    'time' => $event['time'], 
                                    'type' => $event['type']->toArray(),
                                    'cover' => $event['cover']['url'],
                                    'city' => $event['city']['name'],
                                    'artist' => $event['artist']['name']]
                                ]);
    }

    public function zones(Event $event){
        return response()->json([
            "zones" => array_merge([['id' => 0, 'name' => '--  Classe --']], $event->zones->map(function($zone) {
                return ["id" => $zone['id'], "name" => $zone['name'], 'seat' => $zone['seat'] , 'sold' => $zone['sold_seat'], 'price' =>$zone['price']];
            })->toArray()),
            "cities" => array_merge([['id' => 0, 'name' => '-- Choisir --']],City::orderby('name', 'asc')->get()->toArray()),]);
    }
}