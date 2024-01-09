<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCarpoolingRequestRequest;
use App\Models\Carpooling;
use App\Models\CarpoolingRequest;
use App\Models\Ticket;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CarpoolingRequestController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('carpooling_request_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carpoolingRequests = CarpoolingRequest::with(['carpooling', 'ticket'])->get();

        $carpoolings = Carpooling::get();

        $tickets = Ticket::get();

        return view('admin.carpoolingRequests.index', compact('carpoolingRequests', 'carpoolings', 'tickets'));
    }

    public function show(CarpoolingRequest $carpoolingRequest)
    {
        abort_if(Gate::denies('carpooling_request_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carpoolingRequest->load('carpooling', 'ticket');

        return view('admin.carpoolingRequests.show', compact('carpoolingRequest'));
    }

    public function destroy(CarpoolingRequest $carpoolingRequest)
    {
        abort_if(Gate::denies('carpooling_request_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carpoolingRequest->delete();

        return back();
    }

    public function massDestroy(MassDestroyCarpoolingRequestRequest $request)
    {
        $carpoolingRequests = CarpoolingRequest::find(request('ids'));

        foreach ($carpoolingRequests as $carpoolingRequest) {
            $carpoolingRequest->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
