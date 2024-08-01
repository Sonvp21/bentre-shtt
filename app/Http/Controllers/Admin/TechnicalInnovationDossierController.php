<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TechnicalInnovationDossierRequest;
use App\Models\Admin\TechnicalInnovationDossier;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TechnicalInnovationDossierController extends Controller
{
    public function index(): View
    {
        $technicalInnovationDossiers = TechnicalInnovationDossier::orderBy('updated_at', 'desc')->get();
        return view('admin.technical_innovations.technical_innovation_dossiers.index', compact('technicalInnovationDossiers'));
    }

    public function create(): View
    {
        return view('admin.technical_innovations.technical_innovation_dossiers.create');
    }

    public function store(TechnicalInnovationDossierRequest $request): RedirectResponse
    {
        $technicalInnovationDossier = TechnicalInnovationDossier::create($request->validated());

        if ($request->hasFile('document')) {
            $technicalInnovationDossier->clearMediaCollection('document_technical');
            $technicalInnovationDossier->addMedia($request->file('document'))->toMediaCollection('document_technical');
        }

        return redirect()->route('admin.technical_innovation_dossiers.index')->with('success', 'Thêm mới thành công.');
    }

    public function edit(TechnicalInnovationDossier $technicalInnovationDossier): View
    {
        return view('admin.technical_innovations.technical_innovation_dossiers.edit', compact('technicalInnovationDossier'));
    }

    public function update(TechnicalInnovationDossierRequest $request, TechnicalInnovationDossier $technicalInnovationDossier): RedirectResponse
    {
        $technicalInnovationDossier->update($request->validated());

        if ($request->hasFile('document')) {
            $technicalInnovationDossier->clearMediaCollection('document_technical');
            $technicalInnovationDossier->addMedia($request->file('document'))->toMediaCollection('document_technical');
        }

        return redirect()->route('admin.technical_innovation_dossiers.index')->with('success', 'Cập nhật thành công.');
    }

    public function destroy(TechnicalInnovationDossier $technicalInnovationDossier): RedirectResponse
    {
        $technicalInnovationDossier->clearMediaCollection('document_technical');
        $technicalInnovationDossier->delete();
        return redirect()->route('admin.technical_innovation_dossiers.index')->with('success', 'Xoá thành công!');
    }
}
