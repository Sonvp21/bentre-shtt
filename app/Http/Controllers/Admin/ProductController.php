<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Admin\Commune;
use App\Models\Admin\District;
use App\Models\Admin\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::orderBy('updated_at', 'desc')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        $districts = District::all();
        $communes = collect([]);
        return view('admin.products.create', compact('districts', 'communes'));
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        $product = Product::create($request->validated());

        if ($request->hasFile('document')) {
            $product->clearMediaCollection('document_product');
            $product->addMedia($request->file('document'))->toMediaCollection('document_product');
        }
    
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $product->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('image_product');
        }

        return redirect()->route('admin.products.index')->with('success', 'Thêm mới thành công.');
    }

    public function edit(Product $product): View
    {
        $districts = District::all();
        $communes = Commune::where('district_id', $product->district_id)->get();
        return view('admin.products.edit', compact('product', 'districts', 'communes'));
    }

    public function update(productRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());

        if ($request->hasFile('document')) {
            $product->clearMediaCollection('document_product');
            $product->addMedia($request->file('document'))->toMediaCollection('document_product');
        }

        if ($request->hasFile('image')) {
            // Xóa hình ảnh cũ nếu có
            $product->clearMediaCollection('image_product');
            $imageFile = $request->file('image');
            $product->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('image_product');
        }

        return redirect()->route('admin.products.index')->with('success', 'Cập nhật thành công.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->clearMediaCollection('document_product');
        $product->clearMediaCollection('image_product');
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Xoá thành công!');
    }
}
