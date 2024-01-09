<?php

namespace App\Http\Controllers\Api\V1\Front;

use Gate;

use Throwable;
use Carbon\Carbon;
use App\Models\Zone;
use App\Models\Event;
use App\Models\Ticket;
use Dirape\Token\Token;
use App\Models\Customer;
use App\Models\Carpooling;
use Illuminate\Http\Request;
use App\Models\CarpoolingRequest;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\Api\Carpooling\StoreRequest;
use App\Http\Requests\Api\Carpooling\InvitationRequest;

class DashboardApiController extends Controller{


    public function index(Request $request){ 
          //dd(Customer::find($request->get('customer_id')));
        $tickets = Ticket::with(["zone", "carpooling"])->where('customer_id', $request->get('customer_id'))->orderby('created_at', 'desc')->get()->map(function($ticket) {
            return ["id" => $ticket["id"],
                    "codebar" => $ticket["codebar"],
                     "seat" => $ticket['seat'],
                     "zone" => $ticket['zone']['name'],
                    //  "price" => $ticket['zone']['price'],
                     "event" => $ticket['zone']['event']['name'],
                     "event_id" => $ticket['zone']['event']['id'],
                     "date" => Carbon::parse($ticket['zone']['event']['date'])->format('d-m-y H:i'),
                     "time" => $ticket['zone']['event']['time'],
                     "city" => $ticket['zone']['event']['city']['name'],
                     "artist" => [
                        "id" => $ticket['zone']['event']['artist']['id'],
                        "name" => $ticket['zone']['event']['artist']['name']],
                     "carpooling" => [
                        "exist" => (isset($ticket["carpooling"]) && $ticket["carpooling"]["status"] == 'owner')? true:false,
                        "city" => isset($ticket["carpooling"])?  $ticket["carpooling"]["city"]["name"]:""]];
        })->toArray();  
        $tickets = $this->paginate($tickets, 10, $request->page ?? 1); 
        return response()->json([
            "tickets" => $tickets]);
    }

    public function carpoolingTickets(Ticket $ticket, Request $request)
    {
        //TEST IF CARPOOLING IS OWNER AND CONNECTED CUSTOMER IS THE OWNER OF THE TICKET
        try{
            if($ticket->carpooling->status != 'owner' || $request->get('customer_id') != $ticket->customer_id){
                throw ValidationException::withMessages(['message' => 'something goes wrong']);  
            }

            $city = $ticket->carpooling->city_id;
            $event = $ticket->zone->event;
    
            $carpoolingRequest = CarpoolingRequest::where('parent_id',$ticket->carpooling->id);
            $carpoolingIds = $carpoolingRequest->pluck('carpooling_id');
            
            $ticketIds = Ticket::whereIn('zone_id', Zone::where('event_id', $ticket->zone->event_id)->pluck('id'))->pluck('id');
            
            $tickets = Carpooling::with(['ticket'])
                                ->where('city_id', $city)
                                ->where('status', '=', 'passanger')
                                ->whereIn('ticket_id', $ticketIds)
                                ->whereNotIn('id', $carpoolingIds)
                                ->where('codebar', '=', null)                           
                                ->get()
                                ->map(function($carpooling) {            
                                        return [
                                            // "id" => $carpooling['ticket']['id'], 
                                            "seat" => $carpooling['ticket']['seat'],
                                            "customer" => $carpooling['ticket']['customer']['name'],
                                            "carpooling_id" => $carpooling['id']];                        
                                })->toArray();
            $tickets = $this->paginate($tickets, 20, $request->page ?? 1); 
    
            $reservedTickets = Carpooling::with(['ticket'])
                                        ->select('carpoolings.*', 'carpooling_requests.seat as carpooling_request_seat', 'carpooling_requests.accepted')
                                        ->join('carpooling_requests', 'carpoolings.id','=', 'carpooling_requests.carpooling_id')
                                        ->where('city_id', $city)
                                        ->where('status', '=', 'passanger')
                                        ->where('carpooling_requests.parent_id', $ticket->carpooling->id)
                                        ->where('carpooling_requests.deleted_at', '=', null)
                                        //->whereIn('ticket_id', $ticketIds)                                                                            
                                        ->get()
                                        ->map(function($carpooling) {
                                            return [
                                                "id" => $carpooling['ticket']['id'], 
                                                "seat" => $carpooling["carpooling_request_seat"],
                                                "customer" => $carpooling['ticket']['customer']['name'],
                                                "carpooling_id" => $carpooling['id'],
                                                "carpooling_status" => $carpooling["accepted"] ? true:false];                        
                                        });                                        
            return response()->json([
                                    "tickets" => $tickets, 
                                    'reserved' => $reservedTickets,
                                    "event" =>[
                                        "name" => $event['name'],
                                        "description" => $event['description'],
                                        "date" => $event['date'],
                                        "time" => $event['time'],
                                        "city" => $event['city']['name'],
                                        "cover" => $event['cover']['url'],
                                        "type" => $event['type']['name'],
                                        "artist" => $event['artist']['name'],
                                        ],                               
                                    "carpooling" => [
                                        "city" => $ticket->carpooling->city->name,
                                         "parent_id" => $ticket->carpooling->id,
                                         "seat" =>$ticket->carpooling->seat,
                                         "reserved_seat" => $carpoolingRequest->sum('seat')
                                         ]]);
        }catch(Throwable $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function carpoolingStore(StoreRequest $request){
        try
        {
            $data = $request->validated();
   
            $reservedSeat = CarpoolingRequest::where('parent_id', $data['parent'])->sum('seat');
            $seat = collect($data['carpoolings'])->sum('seat');
    
            $carpooling = Carpooling::find($data['parent']);
    
            if($carpooling['seat'] >= ($reservedSeat+$seat)){                
                foreach ($data['carpoolings'] as $carpooling) {             
                    CarpoolingRequest::create(['parent_id' => $data['parent'], 'carpooling_id' => $carpooling['id'], 'seat' => $carpooling['seat']]);
                }
                return response()->json(['success' => true]);
            }else{
                throw ValidationException::withMessages(['message' => 'carpooling seats more then '.$carpooling['seat']]);  
            }  
        } catch (Throwable $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function carpoolingRequest(Request $request)
    {        
        $ticketIds = Ticket::where('customer_id',$request->get('customer_id'))->pluck('id');
        $carpoolinIds = Carpooling::where('status', '=', 'passanger')                                
                                    ->whereIn('ticket_id', $ticketIds)
                                    ->pluck('id');
                                    
        $tickets = CarpoolingRequest::with(["carpooling"])
                                    ->orderby('created_at', 'desc')
                                    ->whereIn('carpooling_id', $carpoolinIds)
                                    ->get()
                                    ->map(function($carpooling) {
                                            return [
                                                "id" => $carpooling['carpooling']['ticket_id'], 
                                                "carpooling_request_id" => $carpooling["id"], 
                                                "seat" => $carpooling["seat"], 
                                                "status" => $carpooling['accepted']? true:false,
                                                "event" => $carpooling['carpooling']['ticket']['zone']['event']['name'],
                                                "from" => $carpooling['carpooling']['city']['name'],
                                                "to" => $carpooling['carpooling']['ticket']['zone']['event']['city']['name'],
                                                "customer" => $carpooling['parent']['ticket']['customer']['name'],
                                            ];                                                               
                                    })->toArray();
        $tickets = $this->paginate($tickets, 20, $request->page ?? 1); 
        return response()->json(['tickets' => $tickets]);
    }

    public function carpoolingInvitation(InvitationRequest $request, CarpoolingRequest $carpoolingRequest){
        try
        {
            if($request->status == 'accepted')
            {                
                $carpoolingRequest->update(['accepted' => 1]);                
                $carpooling = Carpooling::find($carpoolingRequest->parent_id);
                
                Carpooling::where('id',$carpoolingRequest->carpooling_id)->update(['codebar' => $carpooling->codebar]);
                //DELETE OTHER REQUESTS
                CarpoolingRequest::where('carpooling_id', $carpoolingRequest->carpooling_id)->where('id', '<>', $carpoolingRequest->id)->delete();
            }elseif($request->status == 'rejected'){
                $carpoolingRequest->delete();
            }            
            return response()->json(['success' => true, 'msg' => 'Invitation Accepted with success !']);
        } catch (Throwable $e) {
            return response()->json(['success' => false, 'msg' => 'Error Invitation']);
        }
    }

    private static function paginate($items, $perPage = 5, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $total = count($items);
        $currentpage = $page;
        $offset = ($currentpage * $perPage) - $perPage ;
        $itemstoshow = array_slice($items , $offset , $perPage);
        
        return new LengthAwarePaginator($itemstoshow ,$total   ,$perPage);
    }
}