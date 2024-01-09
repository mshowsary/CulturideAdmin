<?php

namespace App\Http\Controllers\Api\V1\Front;

use Gate;

use Throwable;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Account\UpdateProfileRequest;
use App\Http\Requests\Api\Account\UpdatePasswordRequest;

class AccountApiController extends Controller{
    
    public function index(Request $request){        
        return response()->json(['user' => Customer::select('name', 'phone', 'email')->find($request->get('customer_id'))]);
    }

    public function updateProfile(UpdateProfileRequest $request){          
        Customer::where('id', $request->get('customer_id'))->update($request->validated());
        return response()->json(['success' => true, 'msg' => 'Mise à jour du profil avec succès']); 
    }

     public function updatePassword(UpdatePasswordRequest $request){
        $data = $request->validated();
        $count = Customer::where('id', $request->get('customer_id'))->where('password', md5($data['old_password']))->count();
        if($count ==1 ){
            Customer::where('id', $request->get('customer_id'))->update(['password' => md5($data['password'])]);
            return response()->json(['success' => true, 'msg' => 'Mot de passe mis à jour avec succès']); 
        }
        return response()->json(['success' => false, 'msg' => 'Ancien mot de passe incorrect']);
     }
}