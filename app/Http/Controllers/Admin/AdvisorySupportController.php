<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdvisorySupportRequest;
use App\Models\Admin\AdvisorySupport;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdvisorySupportController extends Controller
{
    public function index(): View
    {
        $advisorySupports = AdvisorySupport::orderBy('updated_at', 'desc')->get();
        return view('admin.advisory_supports.index', compact('advisorySupports'));
    }

    public function create(): View
    {
        return view('admin.advisory_supports.create');
    }

    public function store(AdvisorySupportRequest $request): RedirectResponse
    {
        $advisorySupport = AdvisorySupport::create($request->validated());

        if ($request->hasFile('document')) {
            $advisorySupport->clearMediaCollection('document_support');
            $advisorySupport->addMedia($request->file('document'))->toMediaCollection('document_support');
        }
    
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $advisorySupport->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('image_support');
        }

        return redirect()->route('admin.advisory_supports.index')->with('success', 'Thêm mới thành công.');
    }

    public function edit(AdvisorySupport $advisorySupport): View
    {
        return view('admin.advisory_supports.edit', compact('advisorySupport'));
    }

    public function update(AdvisorySupportRequest $request, AdvisorySupport $advisorySupport): RedirectResponse
    {
        $advisorySupport->update($request->validated());

        if ($request->hasFile('document')) {
            $advisorySupport->clearMediaCollection('document_support');
            $advisorySupport->addMedia($request->file('document'))->toMediaCollection('document_support');
        }

        if ($request->hasFile('image')) {
            // Xóa hình ảnh cũ nếu có
            $advisorySupport->clearMediaCollection('image_support');
            $imageFile = $request->file('image');
            $advisorySupport->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('image_support');
        }

        return redirect()->route('admin.advisory_supports.index')->with('success', 'Cập nhật thành công.');
    }

    public function destroy(AdvisorySupport $advisorySupport): RedirectResponse
    {
        $advisorySupport->clearMediaCollection('document_support');
        $advisorySupport->clearMediaCollection('image_support');
        $advisorySupport->delete();
        return redirect()->route('admin.advisory_supports.index')->with('success', 'Xoá thành công!');
    }
}
