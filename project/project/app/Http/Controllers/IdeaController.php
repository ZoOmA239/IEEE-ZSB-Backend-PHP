<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use App\Http\Requests\IdeaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;
use App\Notifications\IdeaPublished;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $ideas = Idea::query()->when(request('state'), function ($query, $state) {
        //     $query->where('state', $state);
        // })->get();



        return view('ideas.index', [

            'ideas' => Auth::user()->ideas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Gate::authorize('create', Idea::class);

        return view('ideas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IdeaRequest $request)
    {
        // $request->validate([
        //     'description' => 'required|min:5',
        // ]);

        $idea = Idea::create([
            'description' => request('description'),
            'state' => 'pending',
            'user_id' => Auth::id(),
        ]);

        //notify the user that the idea has been created
        Notification::send(Auth::user(), new IdeaPublished($idea));
        return redirect('/ideas');
    }

    /**
     * Display the specified resource.
     */
    public function show(Idea $idea)
    {

        Gate::authorize('update', $idea);

        return view('ideas.show', [
            'idea' => $idea,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea)
    {
        Gate::authorize('update', $idea);

        return view('ideas.edit', [
            'idea' => $idea,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IdeaRequest $request, Idea $idea)
    {
        $idea->update([
            'description' => request('description'),
        ]);
        Gate::authorize('update', $idea);



        return redirect('/ideas/' . $idea->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea)
    {
        Gate::authorize('update', $idea);


        $idea->delete();
        return redirect('/ideas');
    }
}
