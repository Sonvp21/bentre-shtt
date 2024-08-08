<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\PatentType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PatentTypeController extends Controller
{
    public function index(): View
    {
        $patentType = PatentType::orderBy('updated_at', 'desc')->get();
        return view('admin.patents.patent_types.index', compact('patentType'));
    }

    public function create(): View
    {
        return view('admin.patents.patent_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:555',
        ]);

        PatentType::create($request->all());

        return redirect()->route('admin.patent_types.index')->with('success', 'Thêm thành công.');
    }

    public function edit(PatentType $patentType): View
    {
        return view('admin.patents.patent_types.edit', compact('patentType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PatentType $patentType): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:555',
        ]);
        $patentType->update($request->all());

        return redirect()->route('admin.patent_types.index')->with('success', 'Cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PatentType $patentType): RedirectResponse
    {
        // Kiểm tra nếu có dữ liệu liên quan trước khi xóa
        if ($patentType->patents()->count() > 0) {
            return redirect()->route('admin.patent_types.index')->with('error', 'Không thể xoá lĩnh vực này vì nó có dữ liệu sáng chế liên quan.');
        }
        
        $patentType->delete();
        return redirect()->route('admin.patent_types.index')->with('success', 'Xoá thành công.');
    }
    
    
}
