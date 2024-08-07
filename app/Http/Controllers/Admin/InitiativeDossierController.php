<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InitiativeDossierRequest;
use App\Models\Admin\Initiative;
use App\Models\Admin\InitiativeDossier;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InitiativeDossierController extends Controller
{
    public function index(): View
    {
        $initiativeDossiers = InitiativeDossier::orderBy('updated_at', 'desc')->get();
        return view('admin.initiatives.initiative_dossiers.index', compact('initiativeDossiers'));
    }

    public function create(): View
    {
        $initiatives = Initiative::select('id', 'name')->get();
        return view('admin.initiatives.initiative_dossiers.create', compact('initiatives'));
    }

    public function store(InitiativeDossierRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $initiativeDossier = InitiativeDossier::create($validatedData);

        if ($request->hasFile('document')) {
            $initiativeDossier->clearMediaCollection('document_initiatives');
            $initiativeDossier->addMedia($request->file('document'))->toMediaCollection('document_initiatives');
        }
        return redirect()->route('admin.initiative_dossiers.index')->with('success', 'Hồ sơ sáng chế đã được tạo thành công.');
    }

    public function edit(InitiativeDossier $initiativeDossier): View
    {
        $initiatives = Initiative::select('id', 'name')->get();
        return view('admin.initiatives.initiative_dossiers.edit', compact('initiativeDossier', 'initiatives'));
    }

    public function update(InitiativeDossierRequest $request, InitiativeDossier $initiativeDossier): RedirectResponse
    {
        $validatedData = $request->validated();

        $initiativeDossier->update($validatedData);

        if ($request->hasFile('document')) {
            $initiativeDossier->clearMediaCollection('document_initiatives');
            $initiativeDossier->addMedia($request->file('document'))->toMediaCollection('document_initiatives');
        }

        return redirect()->route('admin.initiative_dossiers.index')->with('success', 'Hồ sơ sáng chế đã được cập nhật thành công.');
    }


    public function destroy(InitiativeDossier $initiativeDossier): RedirectResponse
    {
        $initiativeDossier->clearMediaCollection('document_initiatives');
        $initiativeDossier->delete();
        return redirect()->route('admin.initiative_dossiers.index')->with('success', 'Xoá thành công.');
    }
}
