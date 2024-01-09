<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEventRequest;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Artist;
use App\Models\Category;
use App\Models\City;
use App\Models\Event;
use App\Models\Type;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('event_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::with(['city', 'artist', 'category', 'type', 'created_by', 'media'])->get();

        $cities = City::get();

        $artists = Artist::get();

        $categories = Category::get();

        $types = Type::get();

        $users = User::get();

        return view('admin.events.index', compact('artists', 'categories', 'cities', 'events', 'types', 'users'));
    }

    public function create()
    {
        abort_if(Gate::denies('event_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $artists = Artist::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $types = Type::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.events.create', compact('artists', 'categories', 'cities', 'types'));
    }

    public function store(StoreEventRequest $request)
    {
        $event = Event::create($request->all());

        if ($request->input('cover', false)) {
            $event->addMedia(storage_path('tmp/uploads/' . basename($request->input('cover'))))->toMediaCollection('cover');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $event->id]);
        }

        return redirect()->route('admin.events.index');
    }

    public function edit(Event $event)
    {
        abort_if(Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $artists = Artist::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $types = Type::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $event->load('city', 'artist', 'category', 'type', 'created_by');

        return view('admin.events.edit', compact('artists', 'categories', 'cities', 'event', 'types'));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->all());

        if ($request->input('cover', false)) {
            if (! $event->cover || $request->input('cover') !== $event->cover->file_name) {
                if ($event->cover) {
                    $event->cover->delete();
                }
                $event->addMedia(storage_path('tmp/uploads/' . basename($request->input('cover'))))->toMediaCollection('cover');
            }
        } elseif ($event->cover) {
            $event->cover->delete();
        }

        return redirect()->route('admin.events.index');
    }

    public function show(Event $event)
    {
        abort_if(Gate::denies('event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->load('city', 'artist', 'category', 'type', 'created_by');

        return view('admin.events.show', compact('event'));
    }

    public function destroy(Event $event)
    {
        abort_if(Gate::denies('event_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->delete();

        return back();
    }

    public function massDestroy(MassDestroyEventRequest $request)
    {
        $events = Event::find(request('ids'));

        foreach ($events as $event) {
            $event->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('event_create') && Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Event();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
