<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\ProductsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Admin\Commune;
use App\Models\Admin\District;
use App\Models\Admin\Product;
use App\Traits\Filterable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    use Filterable;
    public function index(Request $request): View
    {
        $districts = District::pluck('name', 'id')->toArray();
        $communes = Commune::pluck('name', 'id')->toArray();
        $uniqueSubmissionYears = Product::select(DB::raw('DISTINCT EXTRACT(YEAR FROM submission_date) as year'))
            ->orderBy('year')
            ->pluck('year')
            ->toArray();

        $query = Product::query();
        $filters = ['district_id', 'commune_id', 'name', 'owner', 'representatives', 'submission_date'];
        $query = $this->applyFilters($request, $query, $filters);

        // Order by updated_at in descending order
        $products = $query->with('commune.district')->orderBy('updated_at', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('admin.products.ajax_list', compact('products'))->render();
        }

        return view('admin.products.index', compact(
            'products',
            'districts',
            'communes',
            'uniqueSubmissionYears'
        ));
    }

    public function ajaxList(Request $request)
    {
        $query = Product::query();
        $filters = ['district_id', 'commune_id', 'name', 'owner', 'representatives', 'submission_date'];
        $query = $this->applyFilters($request, $query, $filters);

        // Order by updated_at in descending order
        $products = $query->with('commune.district')->orderBy('updated_at', 'desc')->paginate(10);

        return view('admin.products.ajax_list', compact('products'))->render();
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

    public function exportExcel(Request $request)
    {
        $products = json_decode($request->input('products'), true);
        if (!is_array($products) || empty($products)) {
            return back()->with('error', 'Không có dữ liệu để xuất.');
        }
        return Excel::download(new ProductsExport($products), 'products.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $products = json_decode($request->input('products'), true);
        if (!is_array($products) || empty($products)) {
            return back()->with('error', 'Không có dữ liệu để xuất.');
        }
        $pdf = Pdf::loadView('admin.export_pdf.products', compact('products'))->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function ajaxExport(Request $request)
    {
        $query = Product::query();
        $filters = ['district_id', 'commune_id', 'name', 'owner', 'representatives', 'submission_date'];
        $query = $this->applyFilters($request, $query, $filters);

        // Order by updated_at in descending order
        $products = $query->with('commune.district')->orderBy('updated_at', 'desc')->get();

        return view('admin.products.ajax_export', compact('products'))->render();
    }

    public function statistical(Request $request): View
    {
        $districts = District::pluck('name', 'id')->toArray();
        $communes = Commune::pluck('name', 'id')->toArray();
        $uniqueSubmissionYears = Product::select(DB::raw('DISTINCT EXTRACT(YEAR FROM submission_date) as year'))
            ->orderBy('year')
            ->pluck('year')
            ->toArray();

        $query = Product::query();
        $filters = ['district_id', 'commune_id', 'name', 'owner', 'representatives', 'submission_date'];
        $query = $this->applyFilters($request, $query, $filters);

        $products = $query->with('commune.district')->orderBy('updated_at', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('admin.products.ajax_list', compact('products'))->render();
        }

        return view('admin.products.statistical', compact(
            'products',
            'districts',
            'communes',
            'uniqueSubmissionYears'
        ));
    }
}
