<?php

namespace App\Http\Controllers\Api\V1\Front;

use Gate;


use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;


class CarpoolingLocationApiController extends Controller{

    public function index(){
        return response()->json(['cities' => City::all()]);
    }

}