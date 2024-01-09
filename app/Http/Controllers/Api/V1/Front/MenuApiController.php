<?php

namespace App\Http\Controllers\Api\V1\Front;

use Gate;


use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class MenuApiController extends Controller{

    public function index(){        
        return response()->json(['menu' => Category::with('types')->orderBy('name')->get()->map(function($menu){
            return ['id' => $menu['id'], 'name' => $menu['name'], 'types' => $menu['types']->map(function($type) {
                return ['id' => $type['id'], 'name' => $type['name'], 'slug' => $type['slug']];
            })];
        })]);
    }
}