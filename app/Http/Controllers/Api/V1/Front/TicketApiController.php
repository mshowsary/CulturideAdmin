<?php

namespace App\Http\Controllers\Api\V1\Front;

use Gate;

use App\Models\Zone;
use App\Models\Ticket;
use App\Models\Carpooling;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Api\Ticket\StoreRequest;

class TicketApiController extends Controller{

    public function index(StoreRequest $request){
        $data = $request->validated();        
        $Zone = Zone::find($data['zone']);

        if(($Zone['seat'] - $Zone['sold_seat']) >= $data['seats']){

            //CARPOOLING VALIDATION
            $carpooling = false;
            if(isset($data['carpooling']['value']) && $data['carpooling']['value']){

                $carpooling = true;
                if(in_array($data['carpooling']['type'], ['passanger', 'owner'])){
                    if($data['carpooling']['type'] == 'owner' && (!isset($data['carpooling']['seats']) || $data['carpooling']['seats'] == 0)){
                        throw ValidationException::withMessages(['message' => 'carpooling owner seats is null']);                        
                    }
                }else{
                    throw ValidationException::withMessages(['message' => 'carpooling true type error']);
                }
            }

            $ticket = Ticket::create(['seat'=> $data['seats'], 
                                    'codebar' => date('his').$this->generateBarCode(), 
                                    'zone_id' => $data['zone'], 
                                    'customer_id' => $request->get('customer_id')]);

            //UPDATE SOLD SEAT IN ZONE            
            if($Zone){
                $Zone->update(['sold_seat' => $Zone['sold_seat'] + $data['seats']]);
            }

            if($carpooling){
                Carpooling::create(['seat' => $data['carpooling']['seats'],
                                    'status' => $data['carpooling']['type'],
                                    'codebar' => ($data['carpooling']['type'] == 'owner')? $this->generateBarCode():null,
                                     'city_id' => $data['city'], 'ticket_id' => $ticket->id]);
            }

            return response()->json(['success' => true, 'msg' => 'Achat effectué avec succès']);
        }else
        {
            throw ValidationException::withMessages(['message' => 'Error Seats']);
        }
        
    }

    private function generateBarCode(){
        return mt_rand(1000000000, 9999999999).date('i').date('s');
    }
}