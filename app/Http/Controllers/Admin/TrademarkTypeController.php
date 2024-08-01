<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\TrademarkType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TrademarkTypeController extends Controller
{
    public function index(): View
    {
        $trademarkTypes = TrademarkType::orderBy('updated_at', 'desc')->get();
        return view('admin.trademark_types.index', compact('trademarkTypes'));
    }

    public function create(): View
    {
        return view('admin.trademark_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:555',
        ]);

        TrademarkType::create($request->all());

        return redirect()->route('admin.trademark_types.index')->with('success', 'Thêm thành công.');
    }

    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     $trademarkType = TrademarkType::findOrFail($id);
    //     return view('admin.trademark_types.show', compact('trademarkType'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrademarkType $trademarkType): View
    {
        return view('admin.trademark_types.edit', compact('trademarkType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TrademarkType $trademarkType): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:555',
        ]);
        $trademarkType->update($request->all());

        return redirect()->route('admin.trademark_types.index')->with('success', 'Cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrademarkType $trademarkType): RedirectResponse
    {
        $trademarkType->delete();
        return redirect()->route('admin.trademark_types.index')->with('success', 'Xoá thành công.');
    }
}
