<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Models\Tag;
use App\Models\Artist;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Http\Requests\MassDestroyTagRequest;
use Symfony\Component\HttpFoundation\Response;

class TagController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tag_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tags = Tag::with(['artists'])->get();

        $artists = Artist::get();

        return view('admin.tags.index', compact('artists', 'tags'));
    }

    public function create()
    {
        abort_if(Gate::denies('tag_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $artists = Artist::pluck('name', 'id');

        return view('admin.tags.create', compact('artists'));
    }

    public function store(StoreTagRequest $request)
    {
        $tag = Tag::create([ ...$request->all(), 'slug' => Str::slug($request->input('name'), '-')]);
        $tag->artists()->sync($requestdenies->input('artists', []));

        return redirect()->route('admin.tags.index');
    }

    public function edit(Tag $tag)
    {
        abort_if(Gate::denies('tag_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $artists = Artist::pluck('name', 'id');

        $tag->load('artists');

        return view('admin.tags.edit', compact('artists', 'tag'));
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $tag->update([...$request->all(), 'slug' => Str::slug($request->input('name'), '-')]);
        $tag->artists()->sync($request->input('artists', []));

        return redirect()->route('admin.tags.index');
    }

    public function show(Tag $tag)
    {
        abort_if(Gate::denies('tag_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tag->load('artists');

        return view('admin.tags.show', compact('tag'));
    }

    public function destroy(Tag $tag)
    {
        abort_if(Gate::denies('tag_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tag->delete();

        return back();
    }

    public function massDestroy(MassDestroyTagRequest $request)
    {
        $tags = Tag::find(request('ids'));

        foreach ($tags as $tag) {
            $tag->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
