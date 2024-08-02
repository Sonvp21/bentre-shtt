<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdvisorySupportRequest;
use App\Models\Admin\AdvisorySupport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdvisorySupportController extends Controller
{
    // Function to create a new category view
    public function createCategory(): View
    {
        return view('admin.advisory_supports.categories.create_category');
    }

    // Function to store a new category
    public function storeCategory(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        AdvisorySupport::create([
            'title' => $request->name,
            'content' => '',
            'status' => '',
            'published_at' => now(),
            'parent_id' => null,
        ]);

        return redirect()->route('admin.advisory_supports.categories.index')->with('success', 'Tạo danh mục thành công.');
    }

    public function indexCategories(): View
    {
        // Lấy danh sách danh mục không có parent_id (danh mục chính)
        $categories = AdvisorySupport::whereNull('parent_id')
            ->orderBy('updated_at', 'desc')
            ->get();
        
        // Trả về view với dữ liệu
        return view('admin.advisory_supports.categories.index', compact('categories'));
    }
    
    

    // Function to display category edit form
    public function editCategory(AdvisorySupport $category): View
    {
        return view('admin.advisory_supports.categories.edit', compact('category'));
    }

    // Function to update a category
    public function updateCategory(Request $request, AdvisorySupport $category): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update([
            'title' => $request->name,
        ]);

        return redirect()->route('admin.advisory_supports.categories.index')->with('success', 'Cập nhật danh mục thành công.');
    }

    // Function to display all advisory supports
    public function index(): View
    {
        $advisorySupports = AdvisorySupport::whereNotNull('parent_id')->orderBy('updated_at', 'desc')->get();
        return view('admin.advisory_supports.index', compact('advisorySupports'));
    }

    // Function to create a new advisory support view
    public function create(): View
    {
        $categories = AdvisorySupport::whereNull('parent_id')->get();
        return view('admin.advisory_supports.create', compact('categories'));
    }

    // Function to store a new advisory support
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

    // Function to display advisory support edit form
    public function edit(AdvisorySupport $advisorySupport): View
    {
        $categories = AdvisorySupport::whereNull('parent_id')->get();
        return view('admin.advisory_supports.edit', compact('advisorySupport', 'categories'));
    }

    // Function to update an advisory support
    public function update(AdvisorySupportRequest $request, AdvisorySupport $advisorySupport): RedirectResponse
    {
        $advisorySupport->update($request->validated());

        if ($request->hasFile('document')) {
            $advisorySupport->clearMediaCollection('document_support');
            $advisorySupport->addMedia($request->file('document'))->toMediaCollection('document_support');
        }

        if ($request->hasFile('image')) {
            $advisorySupport->clearMediaCollection('image_support');
            $imageFile = $request->file('image');
            $advisorySupport->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('image_support');
        }

        return redirect()->route('advisory_supports.index')->with('success', 'Cập nhật thành công.');
    }

    // Function to delete an advisory support
    public function destroy(AdvisorySupport $advisorySupport): RedirectResponse
    {
        $advisorySupport->clearMediaCollection('document_support');
        $advisorySupport->clearMediaCollection('image_support');
        $advisorySupport->delete();
        return redirect()->route('admin.advisory_supports.index')->with('success', 'Xóa thành công!');
    }
}
