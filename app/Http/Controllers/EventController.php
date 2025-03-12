<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.organizer')->only(['create', 'edit', 'destroy', 'store', 'update']);
    }

    public function index()
    {
        $events = Event::all();
        return view('events.index', compact('events'));
    }


    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $event = Event::create($request->all());

        $event->users()->attach(auth()->id(), ['isOrganizer' => true]);

        return redirect()->route('events.index')->with('success', 'Événement créé avec succès');
    }


    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }


    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }


    public function update(Request $request, Event $event)
    {
        $event->update($request->all());
        return redirect()->route('events.index')->with('success', 'Événement mis à jour avec succès');
    }


    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Événement supprimé');
    }


    public function detach(Event $event, Request $request)
    {
        $event->users()->detach($request->user_id);
        return redirect()->route('events.index')->with('success', 'Utilisateur détaché avec succès');
    }

    public function sync(Event $event, Request $request)
    {
        $event->users()->sync($request->user_ids);
        return redirect()->route('events.index')->with('success', 'Utilisateurs synchronisés');
    }
}
