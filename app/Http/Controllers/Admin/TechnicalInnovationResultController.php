<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TechnicalInnovationResultRequest;
use App\Models\Admin\TechnicalInnovationDossier;
use App\Models\Admin\TechnicalInnovationResult;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TechnicalInnovationResultController extends Controller
{
    public function index(): View
    {
        $technicalInnovationResults = TechnicalInnovationResult::orderBy('updated_at', 'desc')->get();
        return view('admin.technical_innovations.technical_innovation_results.index', compact('technicalInnovationResults'));
    }

    public function create(): View
    {
        $dossiers = TechnicalInnovationDossier::select('id', 'name')->get();
        return view('admin.technical_innovations.technical_innovation_results.create', compact('dossiers'));
    }

    public function store(TechnicalInnovationResultRequest $request): RedirectResponse
    {
        $technicalInnovationResult = TechnicalInnovationResult::create($request->validated());

        if ($request->hasFile('document')) {
            $technicalInnovationResult->clearMediaCollection('document_technical');
            $technicalInnovationResult->addMedia($request->file('document'))->toMediaCollection('document_technical');
        }

        return redirect()->route('admin.technical_innovation_results.index')->with('success', 'Thêm mới thành công.');
    }

    public function edit(TechnicalInnovationResult $technicalInnovationResult): View
    {
        $dossiers = TechnicalInnovationDossier::select('id', 'name')->get();
        return view('admin.technical_innovations.technical_innovation_results.edit', compact('technicalInnovationResult', 'dossiers'));
    }

    public function update(TechnicalInnovationResultRequest $request, TechnicalInnovationResult $technicalInnovationResult): RedirectResponse
    {
        $technicalInnovationResult->update($request->validated());

        if ($request->hasFile('document')) {
            $technicalInnovationResult->clearMediaCollection('document_technical');
            $technicalInnovationResult->addMedia($request->file('document'))->toMediaCollection('document_technical');
        }

        return redirect()->route('admin.technical_innovation_results.index')->with('success', 'Cập nhật thành công.');
    }

    public function destroy(TechnicalInnovationResult $technicalInnovationResult): RedirectResponse
    {
        $technicalInnovationResult->clearMediaCollection('document_technical');
        $technicalInnovationResult->delete();
        return redirect()->route('admin.technical_innovation_results.index')->with('success', 'Xoá thành công!');
    }
}
