<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPhoneRequest;
use App\Http\Requests\StorePhoneRequest;
use App\Http\Requests\UpdatePhoneRequest;
use App\Models\Phone;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PhoneController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('phone_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $phones = Phone::with(['created_by'])->get();

        $users = User::get();

        return view('admin.phones.index', compact('phones', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('phone_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.phones.create');
    }

    public function store(StorePhoneRequest $request)
    {
        $phone = Phone::create($request->all());

        return redirect()->route('admin.phones.index');
    }

    public function edit(Phone $phone)
    {
        abort_if(Gate::denies('phone_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $phone->load('created_by');

        return view('admin.phones.edit', compact('phone'));
    }

    public function update(UpdatePhoneRequest $request, Phone $phone)
    {
        $phone->update($request->all());

        return redirect()->route('admin.phones.index');
    }

    public function show(Phone $phone)
    {
        abort_if(Gate::denies('phone_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $phone->load('created_by');

        return view('admin.phones.show', compact('phone'));
    }

    public function destroy(Phone $phone)
    {
        abort_if(Gate::denies('phone_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $phone->delete();

        return back();
    }

    public function massDestroy(MassDestroyPhoneRequest $request)
    {
        $phones = Phone::find(request('ids'));

        foreach ($phones as $phone) {
            $phone->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
