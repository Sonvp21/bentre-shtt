<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\GeographicalIndicationsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GeographicalIndicationRequest;
use App\Models\Admin\Commune;
use App\Models\Admin\District;
use App\Models\Admin\GeographicalIndication;
use App\Traits\Filterable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class GeographicalIndicationController extends Controller
{
    use Filterable;
    public function index(Request $request): View
    {
        $districts = District::pluck('name', 'id')->toArray();
        $communes = Commune::pluck('name', 'id')->toArray();
        $uniqueApplicationNumbers = GeographicalIndication::select('application_number')->distinct()->pluck('application_number')->toArray();
        $uniqueNames = GeographicalIndication::select('name')->distinct()->pluck('name')->toArray();
        $uniqueManagementUnits = GeographicalIndication::select('management_unit')->distinct()->pluck('management_unit')->toArray();
        $uniqueIssueYears = GeographicalIndication::select(DB::raw('DISTINCT EXTRACT(YEAR FROM issue_date) as year'))
            ->orderBy('year')
            ->pluck('year')
            ->toArray();

        $query = GeographicalIndication::query();
        $filters = ['district_id', 'commune_id', 'name', 'management_unit', 'application_number', 'certificate_number', 'issue_date',  'authorized_unit'];
        $query = $this->applyFilters($request, $query, $filters);

        // Order by updated_at in descending order
        $geographicalIndications = $query->with('commune.district')->orderBy('updated_at', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('admin.geographical_indications.ajax_list', compact('geographicalIndications'))->render();
        }

        return view('admin.geographical_indications.index', compact(
            'geographicalIndications',
            'districts',
            'communes',
            'uniqueApplicationNumbers',
            'uniqueNames',
            'uniqueManagementUnits',
            'uniqueIssueYears'
        ));
    }

    public function ajaxList(Request $request)
    {
        $query = GeographicalIndication::query();
        $filters = ['district_id', 'commune_id', 'name', 'management_unit', 'application_number', 'certificate_number', 'issue_date',  'authorized_unit'];
        $query = $this->applyFilters($request, $query, $filters);

        // Order by updated_at in descending order
        $geographicalIndications = $query->with('commune.district')->orderBy('updated_at', 'desc')->paginate(10);

        return view('admin.geographical_indications.ajax_list', compact('geographicalIndications'))->render();
    }

    public function create(): View
    { 
        $districts = District::all();
        $communes = collect([]);
        return view('admin.geographical_indications.create', compact('districts', 'communes'));
    }

    public function store(GeographicalIndicationRequest $request): RedirectResponse
    {
        $geographicalIndication = GeographicalIndication::create($request->validated());

        if ($request->hasFile('document')) {
            $geographicalIndication->clearMediaCollection('document_geographical');
            $geographicalIndication->addMedia($request->file('document'))->toMediaCollection('document_geographical');
        }
    
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $geographicalIndication->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('image_geographical');
        }

        return redirect()->route('admin.geographical_indications.index')->with('success', 'Geographical Indication created successfully.');
    }

    public function edit(GeographicalIndication $geographicalIndication): View
    {
        $districts = District::all();
        $communes = Commune::where('district_id', $geographicalIndication->district_id)->get();
        return view('admin.geographical_indications.edit', compact('geographicalIndication', 'districts', 'communes'));
    }

    public function update(GeographicalIndicationRequest $request, GeographicalIndication $geographicalIndication): RedirectResponse
    {
        $geographicalIndication->update($request->validated());

        if ($request->hasFile('document')) {
            $geographicalIndication->clearMediaCollection('document_geographical');
            $geographicalIndication->addMedia($request->file('document'))->toMediaCollection('document_geographical');
        }

        if ($request->hasFile('image')) {
            // Xóa hình ảnh cũ nếu có
            $geographicalIndication->clearMediaCollection('image_geographical');
            $imageFile = $request->file('image');
            $geographicalIndication->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('image_geographical');
        }

        return redirect()->route('admin.geographical_indications.index')->with('success', 'Geographical Indication updated successfully.');
    }

    public function destroy(GeographicalIndication $geographicalIndication): RedirectResponse
    {
        $geographicalIndication->clearMediaCollection('document_geographical');
        $geographicalIndication->clearMediaCollection('image_geographical');
        $geographicalIndication->delete();
        return redirect()->route('admin.geographical_indications.index')->with('success', 'Geographical Indication deleted successfully.');
    }

////

    public function exportExcel(Request $request)
    {
        $geographicalIndications = json_decode($request->input('geographicalIndications'), true);
        if (!is_array($geographicalIndications) || empty($geographicalIndications)) {
            return back()->with('error', 'Không có dữ liệu để xuất.');
        }
        return Excel::download(new GeographicalIndicationsExport($geographicalIndications), 'geographicalIndications.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $geographicalIndications = json_decode($request->input('geographicalIndications'), true);
        if (!is_array($geographicalIndications) || empty($geographicalIndications)) {
            return back()->with('error', 'Không có dữ liệu để xuất.');
        }
        $pdf = Pdf::loadView('admin.export_pdf.geographical_indications', compact('geographicalIndications'))->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function ajaxExport(Request $request)
    {
        $query = GeographicalIndication::query();
        $filters = ['district_id', 'commune_id', 'name', 'management_unit', 'application_number', 'certificate_number', 'issue_date',  'authorized_unit'];
        $query = $this->applyFilters($request, $query, $filters);

        // Order by updated_at in descending order
        $geographicalIndications = $query->with('commune.district')->orderBy('updated_at', 'desc')->get();

        return view('admin.geographical_indications.ajax_export', compact('geographicalIndications'))->render();
    }

    public function statistical(Request $request): View
    {
        $districts = District::pluck('name', 'id')->toArray();
        $communes = Commune::pluck('name', 'id')->toArray();
        $uniqueApplicationNumbers = GeographicalIndication::select('application_number')->distinct()->pluck('application_number')->toArray();
        $uniqueNames = GeographicalIndication::select('name')->distinct()->pluck('name')->toArray();
        $uniqueManagementUnits = GeographicalIndication::select('management_unit')->distinct()->pluck('management_unit')->toArray();
        $uniqueIssueYears = GeographicalIndication::select(DB::raw('DISTINCT EXTRACT(YEAR FROM issue_date) as year'))
            ->orderBy('year')
            ->pluck('year')
            ->toArray();

        $query = GeographicalIndication::query();
        $filters = ['district_id', 'commune_id', 'name', 'management_unit', 'application_number', 'certificate_number', 'issue_date',  'authorized_unit'];
        $query = $this->applyFilters($request, $query, $filters);

        // Order by updated_at in descending order
        $geographicalIndications = $query->with('commune.district')->orderBy('updated_at', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('admin.geographical_indications.ajax_list', compact('geographicalIndications'))->render();
        }

        return view('admin.geographical_indications.statistical', compact(
            'geographicalIndications',
            'districts',
            'communes',
            'uniqueApplicationNumbers',
            'uniqueNames',
            'uniqueManagementUnits',
            'uniqueIssueYears'
        ));
    }
}
