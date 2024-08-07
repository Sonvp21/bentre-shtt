<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InitiativeEvaluateRequest;
use App\Models\Admin\Initiative;
use App\Models\Admin\InitiativeDossier;
use App\Models\Admin\InitiativeEvaluate;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InitiativeEvaluateController extends Controller
{
    public function index(): View
    {
        $initiativeEvaluates = InitiativeEvaluate::orderBy('updated_at', 'desc')->get();
        return view('admin.initiatives.initiative_evaluates.index', compact('initiativeEvaluates'));
    }

    public function create(): View
    {
        $initiativeDossier = InitiativeDossier::select('id', 'name')->get();
        return view('admin.initiatives.initiative_evaluates.create', compact('initiativeDossier'));
    }

    public function store(InitiativeEvaluateRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $initiativeEvaluate = InitiativeEvaluate::create($validatedData);
        return redirect()->route('admin.initiative_evaluates.index', compact('initiativeEvaluate'))->with('success', 'Hội dồng đã được tạo thành công.');
    }

    public function edit(InitiativeEvaluate $initiativeEvaluate): View
    {
        $initiativeDossier = InitiativeDossier::select('id', 'name')->get();
        return view('admin.initiatives.initiative_evaluates.edit', compact('initiativeEvaluate', 'initiativeDossier'));
    }

    public function update(InitiativeEvaluateRequest $request, InitiativeEvaluate $initiativeEvaluate): RedirectResponse
    {
        $validatedData = $request->validated();

        $initiativeEvaluate->update($validatedData);
        return redirect()->route('admin.initiative_evaluates.index')->with('success', 'Hội dồng đã được cập nhật thành công.');
    }


    public function destroy(InitiativeEvaluate $initiativeEvaluate): RedirectResponse
    {
        $initiativeEvaluate->delete();
        return redirect()->route('admin.initiative_evaluates.index')->with('success', 'Xoá thành công.');
    }

    public function getDossiers($initiativeId)
    {
        // Fetch dossiers for the selected initiative
        $dossiers = InitiativeDossier::where('initiative_id', $initiativeId)->get();

        return response()->json($dossiers);
    }
}
