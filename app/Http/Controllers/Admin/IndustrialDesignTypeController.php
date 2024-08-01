<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\IndustrialDesignType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IndustrialDesignTypeController extends Controller
{
    public function index(): View
    {
        $industrialDesignType = IndustrialDesignType::orderBy('updated_at', 'desc')->get();
        return view('admin.industrial_designs.industrial_design_types.index', compact('industrialDesignType'));
    }

    public function create(): View
    {
        return view('admin.industrial_designs.industrial_design_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:555',
        ]);

        IndustrialDesignType::create($request->all());

        return redirect()->route('admin.industrial_design_types.index')->with('success', 'Thêm thành công.');
    }

    public function edit(IndustrialDesignType $industrialDesignType): View
    {
        return view('admin.industrial_designs.industrial_design_types.edit', compact('industrialDesignType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IndustrialDesignType $industrialDesignType): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:555',
        ]);
        $industrialDesignType->update($request->all());

        return redirect()->route('admin.industrial_design_types.index')->with('success', 'Cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IndustrialDesignType $industrialDesignType): RedirectResponse
    {
        $industrialDesignType->delete();
        return redirect()->route('admin.industrial_design_types.index')->with('success', 'Xoá thành công.');
    }
}
