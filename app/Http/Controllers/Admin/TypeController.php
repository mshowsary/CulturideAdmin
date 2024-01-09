<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Models\Type;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Http\Requests\MassDestroyTypeRequest;
use Symfony\Component\HttpFoundation\Response;

class TypeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('type_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $types = Type::with(['categories'])->get();

        $categories = Category::get();

        return view('admin.types.index', compact('categories', 'types'));
    }

    public function create()
    {
        abort_if(Gate::denies('type_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::pluck('name', 'id');

        return view('admin.types.create', compact('categories'));
    }

    public function store(StoreTypeRequest $request)
    {            
        $type = Type::create([ ...$request->all(), 'slug' => Str::slug($request->input('name'), '-')]);
        $type->categories()->sync($request->input('categories', []));

        return redirect()->route('admin.types.index');
    }

    public function edit(Type $type)
    {
        abort_if(Gate::denies('type_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = Category::pluck('name', 'id');

        $type->load('categories');

        return view('admin.types.edit', compact('categories', 'type'));
    }

    public function update(UpdateTypeRequest $request, Type $type)
    {        
        $type->update([...$request->all(), 'slug' => Str::slug($request->input('name'), '-')]);
        $type->categories()->sync($request->input('categories', []));

        return redirect()->route('admin.types.index');
    }

    public function show(Type $type)
    {
        abort_if(Gate::denies('type_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $type->load('categories');

        return view('admin.types.show', compact('type'));
    }

    public function destroy(Type $type)
    {
        abort_if(Gate::denies('type_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $type->delete();

        return back();
    }

    public function massDestroy(MassDestroyTypeRequest $request)
    {
        $types = Type::find(request('ids'));

        foreach ($types as $type) {
            $type->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
