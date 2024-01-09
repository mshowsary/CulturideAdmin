<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCarpoolingRequest;
use App\Models\Carpooling;
use App\Models\City;
use App\Models\Ticket;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CarpoolingController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('carpooling_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carpoolings = Carpooling::with(['city', 'ticket'])->get();

        $cities = City::get();

        $tickets = Ticket::get();

        return view('admin.carpoolings.index', compact('carpoolings', 'cities', 'tickets'));
    }

    public function show(Carpooling $carpooling)
    {
        abort_if(Gate::denies('carpooling_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carpooling->load('city', 'ticket');

        return view('admin.carpoolings.show', compact('carpooling'));
    }

    public function destroy(Carpooling $carpooling)
    {
        abort_if(Gate::denies('carpooling_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carpooling->delete();

        return back();
    }

    public function massDestroy(MassDestroyCarpoolingRequest $request)
    {
        $carpoolings = Carpooling::find(request('ids'));

        foreach ($carpoolings as $carpooling) {
            $carpooling->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
