<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Models\Artist;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArtistRequest;
use App\Http\Requests\UpdateArtistRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\MassDestroyArtistRequest;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ArtistController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('artist_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $artists = Artist::with(['media'])->get();

        return view('admin.artists.index', compact('artists'));
    }

    public function create()
    {
        abort_if(Gate::denies('artist_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.artists.create');
    }

    public function store(StoreArtistRequest $request)
    {
        $artist = Artist::create([...$request->all(), 'slug' => Str::slug($request->input('name'), '-')]);

        if ($request->input('photo', false)) {
            $artist->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $artist->id]);
        }

        return redirect()->route('admin.artists.index');
    }

    public function edit(Artist $artist)
    {
        abort_if(Gate::denies('artist_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.artists.edit', compact('artist'));
    }

    public function update(UpdateArtistRequest $request, Artist $artist)
    {
        $artist->update([...$request->all(), 'slug' => Str::slug($request->input('name'), '-')]);

        if ($request->input('photo', false)) {
            if (! $artist->photo || $request->input('photo') !== $artist->photo->file_name) {
                if ($artist->photo) {
                    $artist->photo->delete();
                }
                $artist->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($artist->photo) {
            $artist->photo->delete();
        }

        return redirect()->route('admin.artists.index');
    }

    public function show(Artist $artist)
    {
        abort_if(Gate::denies('artist_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.artists.show', compact('artist'));
    }

    public function destroy(Artist $artist)
    {
        abort_if(Gate::denies('artist_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $artist->delete();

        return back();
    }

    public function massDestroy(MassDestroyArtistRequest $request)
    {
        $artists = Artist::find(request('ids'));

        foreach ($artists as $artist) {
            $artist->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('artist_create') && Gate::denies('artist_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Artist();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
