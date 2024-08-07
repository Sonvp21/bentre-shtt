<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\DistrictsExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\District;
use App\Traits\Filterable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\View as FacadesView;
use Maatwebsite\Excel\Facades\Excel;

class DistrictController extends Controller
{
    use Filterable;

    public function index(Request $request)
    {
        $uniqueNames = District::select('name')->distinct()->get();
        $uniqueAreas = District::select('area')->distinct()->get();
        $uniquePopulations = District::select('population')->distinct()->get();
        $uniqueUpdatedYears = District::select('updated_year')->distinct()->get();

        $query = District::query();
        $filters = ['name', 'area', 'population', 'updated_year'];
        $query = $this->applyFilters($request, $query, $filters);

        $districts = $query->select('id', 'name', 'area', 'population', 'updated_year')->paginate(10);

        if ($request->ajax()) {
            return view('admin.districts.ajax_list', compact('districts'))->render();
        }

        return view('admin.districts.index', compact('districts', 'uniqueNames', 'uniqueAreas', 'uniquePopulations', 'uniqueUpdatedYears'));
    }

    public function ajaxList(Request $request)
    {
        $query = District::query();
        $filters = ['name', 'area', 'population', 'updated_year'];
        $query = $this->applyFilters($request, $query, $filters);

        $districts = $query->select('id', 'name', 'area', 'population', 'updated_year')->paginate(10);

        return view('admin.districts.ajax_list', compact('districts'))->render();
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(District $district)
    {
        return view('admin.districts.edit', compact('district'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, District $district)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'area' => 'nullable|numeric',
            'population' => 'nullable|numeric',
            'updated_year' => 'nullable|string|max:255',
        ]);

        $district->name = $request->input('name');
        $district->area = $request->input('area');
        $district->population = $request->input('population');
        $district->updated_year = $request->input('updated_year');
        $district->save();

        return redirect()->route('admin.districts.index')->with('success', 'Cập nhật thành công.');
    }

    public function destroy(District $district)
    {
        $district->delete();
        return redirect()->route('admin.districts.index')->with('success', 'Xoá thành công.');
    }

    public function exportExcel(Request $request)
    {
        $districts = json_decode($request->input('districts'), true);
        if (!is_array($districts) || empty($districts)) {
            return back()->with('error', 'Không có dữ liệu để xuất.');
        }
        return Excel::download(new DistrictsExport($districts), 'districts.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $districts = json_decode($request->input('districts'), true);
        if (!is_array($districts) || empty($districts)) {
            return back()->with('error', 'Không có dữ liệu để xuất.');
        }
        $pdf = Pdf::loadView('admin.export_pdf.districts', compact('districts'));
        return $pdf->download('districts.pdf');
    }

    public function ajaxExport(Request $request)
    {
        $query = District::query();
        $filters = ['name', 'area', 'population', 'updated_year'];
        $query = $this->applyFilters($request, $query, $filters);

        $districts = $query->select('id', 'name', 'area', 'population', 'updated_year')->get();

        return view('admin.districts.ajax_export', compact('districts'))->render();
    }
}
