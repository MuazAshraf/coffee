<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBeanRequest;
use App\Http\Requests\UpdateBeanRequest;
use App\Models\Bean;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BeanController extends Controller
{
    public function index(): View
    {
        $beans = auth()->user()->beans()->latest()->paginate(15);

        return view('beans.index', compact('beans'));
    }

    public function create(): View
    {
        return view('beans.create');
    }

    public function store(StoreBeanRequest $request): RedirectResponse
    {
        auth()->user()->beans()->create($request->validated());

        return redirect()->route('beans.index')->with('status', 'bean-created');
    }

    public function show(Bean $bean): View
    {
        abort_if($bean->user_id !== auth()->id(), 403);

        return view('beans.show', compact('bean'));
    }

    public function edit(Bean $bean): View
    {
        abort_if($bean->user_id !== auth()->id(), 403);

        return view('beans.edit', compact('bean'));
    }

    public function update(UpdateBeanRequest $request, Bean $bean): RedirectResponse
    {
        $bean->update($request->validated());

        return redirect()->route('beans.index')->with('status', 'bean-updated');
    }

    public function destroy(Bean $bean): RedirectResponse
    {
        abort_if($bean->user_id !== auth()->id(), 403);

        $bean->delete();

        return redirect()->route('beans.index')->with('status', 'bean-deleted');
    }
}
