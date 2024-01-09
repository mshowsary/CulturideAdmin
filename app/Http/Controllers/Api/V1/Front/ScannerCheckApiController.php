<?php

namespace App\Http\Controllers\Api\V1\Front;

use Gate;


use App\Models\City;
use App\Models\Ticket;
use App\Models\Carpooling;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\CarpoolingRequest;
use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Symfony\Component\HttpFoundation\Response;

class ScannerCheckApiController extends Controller{

    public function parkCheck(Request $request){        
        $carpoolings = Carpooling::where('id', $request->carpoolingId)->where('codebar', $request->codebar);

        if($carpoolings->count() == 1){
            $carpooling = $carpoolings->first();

            //SEARCH IF THE CARPOOLING ALREADY USED
            $CarpoolingsUsed = Carpooling::where('codebar', $request->codebar)->where('used', 1);

            if($CarpoolingsUsed->count() == 1 || $carpooling->check_point_at == '') return false;
            else $carpooling->update(['used' => 1]);                 
            
            return true;
        }
        else return false;  

        // return response()->json();
    }

    public function meetingPointCheck(Request $request){

        $tickets = Ticket::where('codebar', $request->codebar)->where('used', 0);
        
        if($tickets->count() == 1 && isset($tickets->first()->carpooling)){            
           
            if($tickets->first()->carpooling->check_point_at != '') return false;
            else $tickets->first()->carpooling->update(['check_point_at' => Carbon::now()]);
            return true;
        }
        else return false;        
        //return response()->json();
    }
    
    public function pdf(Request $request){
        
        $tickets = Ticket::where('codebar', $request->codebar);
        
            if($tickets->count() == 1){
                
                $ticket = $tickets->first();
                $data = ["id" => $ticket["id"],                     
                        "qrTicket" =>  base64_encode(QrCode::size(150)->generate('http://127.0.0.1:8000/api/v1/ticket/'.$ticket["codebar"].'/check')),
                        //"link" => 'http://127.0.0.1:8000/api/v1/ticket/'.$ticket["codebar"].'/check', 
                        "seat" => $ticket['seat'],
                        "zone" => $ticket->zone->name ?? '',
                        "event" => $ticket->zone->event->name,                    
                        "date" => Carbon::parse($ticket->zone->event->date)->format('d-m-y H:i'),
                        "time" => Carbon::parse($ticket->zone->event->date)->subHour(2)->format('d-m-y H:i'),
                        "period" => $ticket->zone->event->time,
                        "city" => $ticket->zone->event->city->name,                        
                        "artist" => [
                            "name" => $ticket->zone->event->artist->name
                        ]
                    ];
                    
                    if((isset($ticket->carpooling))){

                        if($ticket->carpooling->status == 'passanger' && $ticket->carpooling->codebar != ''){
                            
                            $data["carpooling"] = ["qrCarpooling" => base64_encode(QrCode::size(150)->generate('http://127.0.0.1:8000/api/v1/park/'.$ticket->carpooling->id.'/'.$ticket->carpooling->codebar.'/check')),                                                 
                                                    //"link" => 'http://127.0.0.1:8000/api/v1/park/'.$ticket->carpooling->id.'/'.$ticket->carpooling->codebar.'/check',
                                                    "city" =>  $ticket->carpooling->city->name,
                                                    "meeting_point" => $ticket->carpooling->city->carpooling_location,
                                                ];
                        }
                        //IF CARPOOLING IS OWNER MAKE COUNT OF ACCEPTED CARPOOLING REQUEST TO SHOW IN TICKET CARPOOLING INFOS 
                        $carpoolingRequests = CarpoolingRequest::where('parent_id', $ticket->carpooling->id)->where('accepted', 1);
                        
                        if($ticket->carpooling->status == 'owner' && $carpoolingRequests->count() > 0 ){
                            $data["carpooling"]["city"] = $ticket->carpooling->city->name;                                                
                            $data["carpooling"]["meeting_point"] = $ticket->carpooling->city->carpooling_location;    
                            
                         }
                    }
                    
                //return view('ticket.pdf', compact('data'));
            $pdf = Pdf::loadView('ticket.pdf', compact('data'))->setPaper('a5', 'landscape');
            return $pdf->download('billet.pdf');
        }

    }
}