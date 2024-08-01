<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InfringementRequest;
use App\Models\Admin\Infringement;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InfringementController extends Controller
{
    public function index(): View
    {
        $infringements = Infringement::orderBy('updated_at', 'desc')->get();
        return view('admin.infringements.index', compact('infringements'));
    }

    public function create(): View
    {
        return view('admin.infringements.create');
    }

    public function store(InfringementRequest $request): RedirectResponse
    {
        $infringement = Infringement::create($request->validated());

        if ($request->hasFile('document')) {
            $infringement->clearMediaCollection('document_infringement');
            $infringement->addMedia($request->file('document'))->toMediaCollection('document_infringement');
        }

        return redirect()->route('admin.infringements.index')->with('success', 'Thêm mới thành công.');
    }

    public function edit(Infringement $infringement): View
    {
        return view('admin.infringements.edit', compact('infringement'));
    }

    public function update(InfringementRequest $request, Infringement $infringement): RedirectResponse
    {
        $infringement->update($request->validated());

        if ($request->hasFile('document')) {
            $infringement->clearMediaCollection('document_infringement');
            $infringement->addMedia($request->file('document'))->toMediaCollection('document_infringement');
        }

        return redirect()->route('admin.infringements.index')->with('success', 'Cập nhật thành công.');
    }

    public function destroy(Infringement $infringement): RedirectResponse
    {
        $infringement->clearMediaCollection('document_infringement');
        $infringement->delete();
        return redirect()->route('admin.infringements.index')->with('success', 'Xoá thành công!');
    }
}
