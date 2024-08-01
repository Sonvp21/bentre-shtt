<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\CommunesExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Commune;
use App\Models\Admin\District;
use App\Traits\Filterable;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class CommuneController extends Controller
{
    use Filterable;
    public function index(Request $request)
    {
        $districts = District::pluck('name', 'id')->toArray();
        $uniqueUpdatedYears = Commune::select('updated_year')->distinct()->pluck('updated_year')->toArray();
        $uniqueNames = Commune::select('name')->distinct()->get();
        // Lấy danh sách các huyện để hiển thị trong filter

        $query = Commune::query();
        $filters = ['district_id', 'updated_year', 'name'];
        $query = $this->applyFilters($request, $query, $filters);

        $communes = $query->with('district')->paginate(10);

        if ($request->ajax()) {
            return view('admin.communes.ajax_list', compact('communes'))->render();
        }

        return view('admin.communes.index', compact('communes', 'districts', 'uniqueUpdatedYears', 'uniqueNames'));
    }
    public function ajaxList(Request $request)
    {
        $query = Commune::query();
        $filters = ['district_id', 'updated_year', 'name'];
        $query = $this->applyFilters($request, $query, $filters);

        $communes = $query->with('district')->paginate(10);

        return view('admin.communes.ajax_list', compact('communes'))->render();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commune $commune)
    {
        $districts = District::all();
        return view('admin.communes.edit', compact('commune', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Commune $commune)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'district_id' => 'required|exists:districts,id',
            'area' => 'nullable|numeric',
            'population' => 'nullable|numeric',
            'updated_year' => 'nullable|string|max:255',
        ]);

        $commune->name = $request->input('name');
        $commune->district_id = $request->input('district_id');
        $commune->area = $request->input('area');
        $commune->population = $request->input('population');
        $commune->updated_year = $request->input('updated_year');
        $commune->save();

        return redirect()->route('admin.communes.index')->with('success', 'Cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commune $commune)
    {
        $commune->delete();
        return redirect()->route('admin.communes.index')->with('success', 'Xoá thành công.');
    }

    public function exportExcel(Request $request)
    {
        $communes = json_decode($request->input('communes'), true);
        if (!is_array($communes) || empty($communes)) {
            return back()->with('error', 'Không có dữ liệu để xuất.');
        }
        return Excel::download(new CommunesExport($communes), 'communes.xlsx');
    }
    

    public function exportPdf(Request $request)
    {
        $communes = json_decode($request->input('communes'), true);
        if (!is_array($communes) || empty($communes)) {
            return back()->with('error', 'Không có dữ liệu để xuất.');
        }
        $pdf = Pdf::loadView('admin.export_pdf.communes', compact('communes'));
        return $pdf->download('communes.pdf');
    }


    public function ajaxExport(Request $request)
    {
        $query = Commune::query();
        $filters = ['district_id', 'updated_year', 'name']; // Thêm các filter cần áp dụng
        $query = $this->applyFilters($request, $query, $filters);

        $communes = $query->with('district')->get();

        return view('admin.communes.ajax_export', compact('communes'))->render();
    }
}
