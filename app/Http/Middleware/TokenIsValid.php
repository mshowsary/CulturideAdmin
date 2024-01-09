<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Customer;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {  
        $customer = Customer::where('token', $request->bearerToken())->get();
       
        if($customer->count() == 1){            
            request()->request->set('customer_id', $customer->first()->id);           
            return $next($request);
        }

        else return response()->json(['auth' => false]);
        
    }
}
