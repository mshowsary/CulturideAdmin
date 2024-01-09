<?php

namespace App\Http\Controllers\Api\V1\Front;

use App\Http\Controllers\Controller;

use App\Models\Contact;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Api\Contact\StoreRequest;


class ContactApiController extends Controller{

    public function index(StoreRequest $request){
        
        Contact::create($request->validated());
        return response()->json(['success' => true, 'msg' => 'Message a été envoyé avec succès']);
    }
}