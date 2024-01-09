<?php

namespace App\Http\Controllers\Api\V1\Front;

use Gate;


use Throwable;
use Dirape\Token\Token;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\Signin\StoreRequest;
use Symfony\Component\HttpFoundation\Response;

class SigninApiController extends Controller{

    public function index(StoreRequest $request){
        try{
            $data = $request->validated();            
            $customer = Customer::where('email', $data['email'])->where('password', md5($data['password']))->get();
            
            if($customer->count() == 1){
                if($customer->first()->token_reset_password)
                {
                    Customer::where('email', $data['email'])->update(['token_reset_password' => NULL, 
                                                                     'expire_at' => NULL]);
                }
                return response()->json(['success' => true , 'token' => $customer->first()->token, 'name' => $customer->first()->name]); 
            }
            return response()->json(['success' => false , 'msg' => 'These credentials do not match our records']);
        }catch(Throwable $e){
            return response()->json(['success' => false, 'msg' => 'These credentials do not match our records']);
        }
    }  

    public function validToken(Request $request)
    {       
        $count = Customer::where('token', $request->token)->count();
        return response()->json(['valid' => ($count == 1)? true:false]);
    }

    public function logout(Request $request){
        try
        {
            $customer = Customer::where('token', $request->bearerToken())->first();
            Customer::where('id', $customer->id ?? 0)
                    ->update(['token' => (new Token())->Unique('customers', 'token', 50)]);
        } catch (Throwable $e) {
            return response()->json(['success' => false]);
        }                
    }
}