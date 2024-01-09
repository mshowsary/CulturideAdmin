<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTicketRequest;
use App\Models\Customer;
use App\Models\Ticket;
use App\Models\Zone;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TicketController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ticket_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tickets = Ticket::with(['customer', 'zone'])->get();

        $customers = Customer::get();

        $zones = Zone::get();

        return view('admin.tickets.index', compact('customers', 'tickets', 'zones'));
    }

    public function show(Ticket $ticket)
    {
        abort_if(Gate::denies('ticket_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ticket->load('customer', 'zone');

        return view('admin.tickets.show', compact('ticket'));
    }

    public function destroy(Ticket $ticket)
    {
        abort_if(Gate::denies('ticket_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ticket->delete();

        return back();
    }

    public function massDestroy(MassDestroyTicketRequest $request)
    {
        $tickets = Ticket::find(request('ids'));

        foreach ($tickets as $ticket) {
            $ticket->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
