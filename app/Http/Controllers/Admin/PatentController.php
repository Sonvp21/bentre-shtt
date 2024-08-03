<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\PatentsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PatentRequest;
use App\Models\Admin\Commune;
use App\Models\Admin\District;
use App\Models\Admin\Patent;
use App\Traits\Filterable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class PatentController extends Controller
{
    use Filterable;
    public function index(Request $request): View
    {
        $districts = District::pluck('name', 'id')->toArray();
        $communes = Commune::pluck('name', 'id')->toArray();
        $uniqueApplicationNumbers = Patent::select('application_number')->distinct()->pluck('application_number')->toArray();
        $uniqueNames = Patent::select('name')->distinct()->pluck('name')->toArray();
        $uniqueLegalRepresentatives = Patent::select('legal_representative')->distinct()->pluck('legal_representative')->toArray();
        $uniquePublicationYears = Patent::select(DB::raw('DISTINCT EXTRACT(YEAR FROM publication_date) as year'))
            ->orderBy('year')
            ->pluck('year')
            ->toArray();
        // Lấy các giá trị submission_status duy nhất từ cơ sở dữ liệu
        $uniqueSubmissionStatuses = Patent::select('submission_status')->distinct()->pluck('submission_status')->toArray();
        // Ánh xạ các giá trị trạng thái với các văn bản mô tả
        $submissionStatusMap = [
            1 => 'Đang xử lý',
            2 => 'Đã cấp',
            3 => 'Bị từ chối',
        ];

        // Tạo mảng các tùy chọn trạng thái
        $uniqueSubmissionStatus = [];
        foreach ($uniqueSubmissionStatuses as $status) {
            if (isset($submissionStatusMap[$status])) {
                $uniqueSubmissionStatus[$status] = $submissionStatusMap[$status];
            }
        }

        $query = Patent::query();
        $filters = ['district_id', 'commune_id', 'application_number', 'name', 'code', 'publication_date', 'legal_representative', 'submission_status'];
        $query = $this->applyFilters($request, $query, $filters);

        // Order by updated_at in descending order
        $patents = $query->with('commune.district')->orderBy('updated_at', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('admin.patents.ajax_list', compact('patents'))->render();
        }

        return view('admin.patents.index', compact(
            'patents',
            'districts',
            'communes',
            'uniqueApplicationNumbers',
            'uniqueNames',
            'uniqueLegalRepresentatives',
            'uniqueSubmissionStatus',
            'uniquePublicationYears'
        ));
    }

    public function ajaxList(Request $request)
    {
        $query = Patent::query();
        $filters = ['district_id', 'commune_id', 'application_number', 'name', 'code', 'publication_date', 'legal_representative', 'submission_status'];
        $query = $this->applyFilters($request, $query, $filters);

        // Order by updated_at in descending order
        $patents = $query->with('commune.district')->orderBy('updated_at', 'desc')->paginate(10);

        return view('admin.patents.ajax_list', compact('patents'))->render();
    }

    public function getCommunes($district_id)
    {
        $communes = Commune::where('district_id', $district_id)->get();
        return response()->json($communes);
    }

    public function create(): View
    {
        $districts = District::all();
        $communes = collect([]);
        return view('admin.patents.create', compact('districts', 'communes'));
    }


    public function store(PatentRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $patent = Patent::create($validatedData);

        if ($request->hasFile('document')) {
            $patent->clearMediaCollection('documents');
            $patent->addMedia($request->file('document'))->toMediaCollection('documents');
        }


        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $patent->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('patent_image');
        }

        // Cập nhật tọa độ
        $longitude = $request->input('longitude');
        $latitude = $request->input('latitude');

        $patent->updateCoordinates($patent->id, $longitude, $latitude);

        return redirect()->route('admin.patents.index')->with('success', 'Sáng chế đã được tạo thành công.');
    }

    public function edit(Patent $patent): View
    {
        $districts = District::all();
        $communes = Commune::where('district_id', $patent->district_id)->get();
        return view('admin.patents.edit', compact('patent', 'districts', 'communes'));
    }

    public function update(PatentRequest $request, Patent $patent): RedirectResponse
    {
        $validatedData = $request->validated();

        $patent->update($validatedData);

        // Cập nhật tọa độ
        $longitude = $request->input('longitude');
        $latitude = $request->input('latitude');
        $patent->updateCoordinates($patent->id, $longitude, $latitude);

        if ($request->hasFile('document')) {
            $patent->clearMediaCollection('documents'); // Xóa tất cả media trong collection 'documents'
            $patent->addMedia($request->file('document'))->toMediaCollection('documents');
        }

        if ($request->hasFile('image')) {
            // Xóa hình ảnh cũ nếu có
            $patent->clearMediaCollection('patent_image');
            $imageFile = $request->file('image');
            $patent->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('patent_image');
        }
        return redirect()->route('admin.patents.index')->with('success', 'Sáng chế đã được cập nhật thành công.');
    }

    public function destroy(Patent $patent): RedirectResponse
    {
        $patent->clearMediaCollection('documents');
        $patent->clearMediaCollection('patent_image');
        $patent->delete();
        return redirect()->route('admin.patents.index')->with('success', 'Xoá thành công.');
    }
    /////

    public function exportExcel(Request $request)
    {
        $patents = json_decode($request->input('patents'), true);
        if (!is_array($patents) || empty($patents)) {
            return back()->with('error', 'Không có dữ liệu để xuất.');
        }
        return Excel::download(new PatentsExport($patents), 'patents.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $patents = json_decode($request->input('patents'), true);
        if (!is_array($patents) || empty($patents)) {
            return back()->with('error', 'Không có dữ liệu để xuất.');
        }
        $pdf = Pdf::loadView('admin.export_pdf.patents', compact('patents'))->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function ajaxExport(Request $request)
    {
        $query = Patent::query();
        $filters = ['district_id', 'commune_id', 'application_number', 'name', 'legal_representative', 'submission_status'];
        $query = $this->applyFilters($request, $query, $filters);

        // Order by updated_at in descending order
        $patents = $query->with('commune.district')->orderBy('updated_at', 'desc')->get();

        return view('admin.patents.ajax_export', compact('patents'))->render();
    }

    public function statistical(Request $request): View
    {
        $districts = District::pluck('name', 'id')->toArray();
        $communes = Commune::pluck('name', 'id')->toArray();
        $uniqueApplicationNumbers = Patent::select('application_number')->distinct()->pluck('application_number')->toArray();
        $uniqueNames = Patent::select('name')->distinct()->pluck('name')->toArray();
        $uniqueLegalRepresentatives = Patent::select('legal_representative')->distinct()->pluck('legal_representative')->toArray();
        $uniquePublicationYears = Patent::select(DB::raw('DISTINCT EXTRACT(YEAR FROM publication_date) as year'))
            ->orderBy('year')
            ->pluck('year')
            ->toArray();
        // Lấy các giá trị submission_status duy nhất từ cơ sở dữ liệu
        $uniqueSubmissionStatuses = Patent::select('submission_status')->distinct()->pluck('submission_status')->toArray();
        // Ánh xạ các giá trị trạng thái với các văn bản mô tả
        $submissionStatusMap = [
            1 => 'Đang xử lý',
            2 => 'Đã cấp',
            3 => 'Bị từ chối',
        ];

        // Tạo mảng các tùy chọn trạng thái
        $uniqueSubmissionStatus = [];
        foreach ($uniqueSubmissionStatuses as $status) {
            if (isset($submissionStatusMap[$status])) {
                $uniqueSubmissionStatus[$status] = $submissionStatusMap[$status];
            }
        }

        $query = Patent::query();
        $filters = ['district_id', 'commune_id', 'application_number', 'name', 'legal_representative', 'submission_status'];
        $query = $this->applyFilters($request, $query, $filters);

        // Order by updated_at in descending order
        $patents = $query->with('commune.district')->orderBy('updated_at', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('admin.patents.ajax_list', compact('patents'))->render();
        }

        return view('admin.patents.statistical', compact(
            'patents',
            'districts',
            'communes',
            'uniqueApplicationNumbers',
            'uniqueNames',
            'uniqueLegalRepresentatives',
            'uniqueSubmissionStatus',
            'uniquePublicationYears'
        ));
    }
}
