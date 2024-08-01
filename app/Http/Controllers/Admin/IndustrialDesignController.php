<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\IndustrialDesignsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\IndustrialDesignRequest;
use App\Models\Admin\Commune;
use App\Models\Admin\District;
use App\Models\Admin\IndustrialDesign;
use App\Models\Admin\IndustrialDesignType;
use App\Traits\Filterable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class IndustrialDesignController extends Controller
{
    use Filterable;
    public function index(Request $request): View
    {
        $districts = District::pluck('name', 'id')->toArray();
        $communes = Commune::pluck('name', 'id')->toArray();
        $types = IndustrialDesignType::pluck('name', 'id')->toArray();
        $uniqueIssueYears = IndustrialDesign::select(DB::raw('DISTINCT EXTRACT(YEAR FROM publication_date) as year'))
            ->orderBy('year')
            ->pluck('year')
            ->toArray();

        $query = IndustrialDesign::query();
        $filters = ['district_id', 'commune_id', 'type_id', 'name', 'owner', 'application_number', 'publication_date',];
        $query = $this->applyFilters($request, $query, $filters);

        // Order by updated_at in descending order
        $IndustrialDesigns = $query->with('commune.district')->orderBy('updated_at', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('admin.industrial_designs.ajax_list', compact('IndustrialDesigns'))->render();
        }

        return view('admin.industrial_designs.index', compact(
            'IndustrialDesigns',
            'districts',
            'communes',
            'types',
            'uniqueIssueYears'
        ));
    }

    public function ajaxList(Request $request)
    {
        $query = IndustrialDesign::query();
        $filters = ['district_id', 'commune_id', 'type_id', 'name', 'owner', 'application_number', 'publication_date',];
        $query = $this->applyFilters($request, $query, $filters);

        // Order by updated_at in descending order
        $IndustrialDesigns = $query->with('commune.district')->orderBy('updated_at', 'desc')->paginate(10);

        return view('admin.industrial_designs.ajax_list', compact('IndustrialDesigns'))->render();
    }

    public function create(): View
    {
        $districts = District::all();
        $communes = collect([]);
        $industrialDesignType = IndustrialDesignType::all();
        return view('admin.industrial_designs.create', compact('districts', 'communes', 'industrialDesignType'));
    }

    public function store(IndustrialDesignRequest $request): RedirectResponse
    {
        $industrialDesign = IndustrialDesign::create($request->all());

        if ($request->hasFile('document')) {
            $industrialDesign->clearMediaCollection('document_design');
            $industrialDesign->addMedia($request->file('document'))->toMediaCollection('document_design');
        }
    
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $industrialDesign->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('design_image');
        }
        return redirect()->route('admin.industrial_designs.index')->with('success', 'kiểu dáng đã được tạo thành công.');
    }

    public function edit(IndustrialDesign $industrialDesign): View
    {
        $districts = District::all();
        $communes = Commune::where('district_id', $industrialDesign->district_id)->get();

        $industrialDesignType = IndustrialDesignType::all();
        return view('admin.industrial_designs.edit', compact('industrialDesign', 'districts', 'communes', 'industrialDesignType'));
    }

    public function update(industrialDesignRequest $request, IndustrialDesign $industrialDesign): RedirectResponse
    {
        $validatedData = $request->validated();

        $industrialDesign->update($validatedData);

        if ($request->hasFile('document')) {
            $industrialDesign->clearMediaCollection('document_design');
            $industrialDesign->addMedia($request->file('document'))->toMediaCollection('document_design');
        }

        if ($request->hasFile('image')) {
            // Xóa hình ảnh cũ nếu có
            $industrialDesign->clearMediaCollection('design_image');
            $imageFile = $request->file('image');
            $industrialDesign->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('design_image');
        }
        return redirect()->route('admin.industrial_designs.index')->with('success', 'Kiểu dáng đã được cập nhật thành công.');
    }


    public function destroy(IndustrialDesign $industrialDesign): RedirectResponse
    {
        $industrialDesign->clearMediaCollection('document_design');
        $industrialDesign->clearMediaCollection('design_image');
        $industrialDesign->delete();
        return redirect()->route('admin.industrial_designs.index')->with('success', 'Xoá thành công.');
    }

    /////
    public function exportExcel(Request $request)
    {
        $IndustrialDesigns = json_decode($request->input('IndustrialDesigns'), true);
        if (!is_array($IndustrialDesigns) || empty($IndustrialDesigns)) {
            return back()->with('error', 'Không có dữ liệu để xuất.');
        }
        return Excel::download(new IndustrialDesignsExport($IndustrialDesigns), 'IndustrialDesigns.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $IndustrialDesigns = json_decode($request->input('IndustrialDesigns'), true);
        if (!is_array($IndustrialDesigns) || empty($IndustrialDesigns)) {
            return back()->with('error', 'Không có dữ liệu để xuất.');
        }
        $pdf = Pdf::loadView('admin.export_pdf.industrial_designs', compact('IndustrialDesigns'))->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function ajaxExport(Request $request)
    {
        $query = IndustrialDesign::query();
        $filters = ['district_id', 'commune_id', 'type_id', 'name', 'owner', 'application_number', 'publication_date',];
        $query = $this->applyFilters($request, $query, $filters);

        // Order by updated_at in descending order
        $IndustrialDesigns = $query->with('commune.district')->orderBy('updated_at', 'desc')->get();

        return view('admin.industrial_designs.ajax_export', compact('IndustrialDesigns'))->render();
    }

    public function statistical(Request $request): View
    {
        $districts = District::pluck('name', 'id')->toArray();
        $communes = Commune::pluck('name', 'id')->toArray();
        $types = IndustrialDesignType::pluck('name', 'id')->toArray();
        $uniqueIssueYears = IndustrialDesign::select(DB::raw('DISTINCT EXTRACT(YEAR FROM publication_date) as year'))
            ->orderBy('year')
            ->pluck('year')
            ->toArray();

        $query = IndustrialDesign::query();
        $filters = ['district_id', 'commune_id', 'type_id', 'name', 'owner', 'application_number', 'publication_date',];
        $query = $this->applyFilters($request, $query, $filters);

        // Order by updated_at in descending order
        $IndustrialDesigns = $query->with('commune.district')->orderBy('updated_at', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('admin.industrial_designs.ajax_list', compact('IndustrialDesigns'))->render();
        }

        return view('admin.industrial_designs.statistical', compact(
            'IndustrialDesigns',
            'districts',
            'communes',
            'types',
            'uniqueIssueYears'
        ));
    }
}
