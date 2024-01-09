<?php

namespace App\Http\Controllers\Api\V1\Front;

use Gate;


use Carbon\Carbon;
use Dirape\Token\Token;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Api\Signup\StoreRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Api\ForgetPassword\ResetPasswordRequest;
use App\Http\Requests\Api\ForgetPassword\UpdatePasswordRequest;

class ForgetPasswordApiController extends Controller{

    public function resetPassword(ResetPasswordRequest $request){
        $data = $request->validated();

        $count = Customer::where('email', $data['email'])->count();

        //INSERT TOKEN RESET PASSWORD AND SEND REST PASSWORD EMAIL
        if($count == 1){
            Customer::where('email', $data['email'])->update([
                                        'token_reset_password' => (new Token())->Unique('customers', 'token_reset_password', 40), 
                                        'expire_at' => Carbon::now()->add(1, 'day')]
                                    );
             //SEND EMAIL
             //http://localhost:3000/update-password/token_reset_password
            return response()->json(['success' => true, 'msg' => 'réinitialiser le mot de passe email envoyé avec succès']);
        }else{
            return response()->json(['success' => false, 'msg' => "e-mail n'existe pas"]);
        }
    }

    public function updatePassword(Request $request){
        if($request->token){
            $count = Customer::where('token_reset_password', '=',$request->token)->where('expire_at' ,'>=', Carbon::now())->count();
                        
            if($count == 1){
                return response()->json(['success' => true]);
            }
        }       
            
        return response()->json(['success' => false, 'msg' => '404 Page non trouvée']);        
    }

    public function storePassword(UpdatePasswordRequest $request, $token){
    
        if($token){
            $count = Customer::where('token_reset_password', '=',$token)->where('expire_at' ,'>=', Carbon::now())->count();
                        
            if($count == 1){

                $data = $request->validated();
                Customer::where('token_reset_password', '=',$token)->update([
                                    'password' => md5($data['password']),
                                    'token_reset_password' => NULL, 
                                    'expire_at' => NULL]);

                return response()->json(['success' => true, 'msg' =>'Mot de passe mis à jour avec succès']);
            }
        }       
            
        return response()->json(['success' => false, 'msg' => '404 Page non trouvée']);       
    }
}