<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrewRequest;
use App\Http\Requests\UpdateBrewRequest;
use App\Models\Brew;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BrewController extends Controller
{
    public function index(): View
    {
        $brews = auth()->user()->brews()->with('bean')->latest('brewed_at')->paginate(15);

        return view('brews.index', compact('brews'));
    }

    public function create(): View
    {
        $beans = auth()->user()->beans()->orderBy('name')->get();

        return view('brews.create', compact('beans'));
    }

    public function store(StoreBrewRequest $request): RedirectResponse
    {
        auth()->user()->brews()->create($request->validated());

        return redirect()->route('brews.index')->with('status', 'brew-created');
    }

    public function show(Brew $brew): View
    {
        abort_if($brew->user_id !== auth()->id(), 403);

        return view('brews.show', compact('brew'));
    }

    public function edit(Brew $brew): View
    {
        abort_if($brew->user_id !== auth()->id(), 403);

        $beans = auth()->user()->beans()->orderBy('name')->get();

        return view('brews.edit', compact('brew', 'beans'));
    }

    public function update(UpdateBrewRequest $request, Brew $brew): RedirectResponse
    {
        $brew->update($request->validated());

        return redirect()->route('brews.index')->with('status', 'brew-updated');
    }

    public function destroy(Brew $brew): RedirectResponse
    {
        abort_if($brew->user_id !== auth()->id(), 403);

        $brew->delete();

        return redirect()->route('brews.index')->with('status', 'brew-deleted');
    }
}
