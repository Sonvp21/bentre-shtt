<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InitiativeRequest;
use App\Models\Admin\Initiative;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InitiativeController extends Controller
{
    public function index(): View
    {
        $initiatives = Initiative::orderBy('updated_at', 'desc')->get();
        return view('admin.initiatives.index', compact('initiatives'));
    }

    public function create(): View
    {
        return view('admin.initiatives.create');
    }

    public function store(InitiativeRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $initiative = Initiative::create($validatedData);

        return redirect()->route('admin.initiatives.index', compact('initiative'))->with('success', 'Sáng chế đã được tạo thành công.');
    }

    public function edit(Initiative $initiative): View
    {
        return view('admin.initiatives.edit', compact('initiative'));
    }

    public function update(InitiativeRequest $request, Initiative $initiative): RedirectResponse
    {
        $validatedData = $request->validated();

        $initiative->update($validatedData);
        return redirect()->route('admin.initiatives.index')->with('success', 'Sáng chế đã được cập nhật thành công.');
    }


    public function destroy(initiative $initiative): RedirectResponse
    {
        $initiative->delete();
        return redirect()->route('admin.initiatives.index')->with('success', 'Xoá thành công.');
    }
}
