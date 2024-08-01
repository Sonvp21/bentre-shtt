<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TechnicalInnovationCommitteeRequest;
use App\Models\Admin\TechnicalInnovationCommittee;
use App\Models\Admin\TechnicalInnovationDossier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TechnicalInnovationCommitteeController extends Controller
{
    public function index(): View
    {
        $technicalInnovationCommittees = TechnicalInnovationCommittee::orderBy('updated_at', 'desc')->get();
        return view('admin.technical_innovations.technical_innovation_committees.index', compact('technicalInnovationCommittees'));
    }

    public function create(): View
    {
        $dossiers = TechnicalInnovationDossier::select('id', 'name')->get();
        return view('admin.technical_innovations.technical_innovation_committees.create', compact('dossiers'));
    }

    public function store(TechnicalInnovationCommitteeRequest $request): RedirectResponse
    {
        $technicalInnovationCommittee = TechnicalInnovationCommittee::create($request->validated());

        return redirect()->route('admin.technical_innovation_committees.index')->with('success', 'Thêm mới thành công.');
    }

    public function edit(TechnicalInnovationCommittee $technicalInnovationCommittee): View
    {
        $dossiers = TechnicalInnovationDossier::select('id', 'name')->get();
        return view('admin.technical_innovations.technical_innovation_committees.edit', compact('technicalInnovationCommittee', 'dossiers'));
    }

    public function update(TechnicalInnovationCommitteeRequest $request, TechnicalInnovationCommittee $technicalInnovationCommittee): RedirectResponse
    {
        $technicalInnovationCommittee->update($request->validated());

        return redirect()->route('admin.technical_innovation_committees.index')->with('success', 'Cập nhật thành công.');
    }

    public function destroy(TechnicalInnovationCommittee $technicalInnovationCommittee): RedirectResponse
    {
        $technicalInnovationCommittee->delete();
        return redirect()->route('admin.technical_innovation_committees.index')->with('success', 'Xoá thành công!');
    }
}
