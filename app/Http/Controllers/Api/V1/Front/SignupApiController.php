<?php

namespace App\Http\Controllers\Api\V1\Front;

use Gate;


use Dirape\Token\Token;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Api\Signup\StoreRequest;

class SignupApiController extends Controller{

    public function index(StoreRequest $request){

        $data = $request->validated();
        $data['password'] = md5($data['password']);
        
        $data['token'] = (new Token())->Unique('customers', 'token', 50);

        Customer::create($data);
        return response()->json(['success' => true, 'msg' => 'Inscription a été effectué avec succès']);
    }
}