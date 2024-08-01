<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\TrademarksExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TrademarkRequest;
use App\Models\Admin\Commune;
use App\Models\Admin\District;
use App\Models\Admin\Trademark;
use App\Traits\Filterable;
use App\Models\Admin\TrademarkType;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class TrademarkController extends Controller
{
    use Filterable;
    public function index(Request $request): View
    {
        $districts = District::pluck('name', 'id')->toArray();
        $communes = Commune::pluck('name', 'id')->toArray();
        $types = TrademarkType::pluck('name', 'id')->toArray();
        $uniqueNames = Trademark::select('name')->distinct()->pluck('name')->toArray();
        $uniqueSubmissionStatuses = Trademark::select('submission_status')->distinct()->pluck('submission_status')->toArray();
        $uniquePublicationYears = Trademark::select(DB::raw('DISTINCT EXTRACT(YEAR FROM publication_date) as year'))
            ->orderBy('year')
            ->pluck('year')
            ->toArray();
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

        $query = Trademark::query();
        $filters = ['district_id', 'commune_id', 'type_id', 'name', 'owner', 'submission_status', 'publication_date'];
        $query = $this->applyFilters($request, $query, $filters);

        // Order by updated_at in descending order
        $trademarks = $query->with('commune.district')->orderBy('updated_at', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('admin.trademarks.ajax_list', compact('trademarks'))->render();
        }

        return view('admin.trademarks.index', compact(
            'trademarks',
            'districts',
            'communes',
            'types',
            'uniqueNames',
            'uniqueSubmissionStatus',
            'uniquePublicationYears'
        ));
    }

    public function ajaxList(Request $request)
    {
        $query = Trademark::query();
        $filters = ['district_id', 'commune_id', 'type_id', 'name', 'owner', 'submission_status', 'publication_date'];
        $query = $this->applyFilters($request, $query, $filters);

        // Order by updated_at in descending order
        $trademarks = $query->with('commune.district')->orderBy('updated_at', 'desc')->paginate(10);

        return view('admin.trademarks.ajax_list', compact('trademarks'))->render();
    }

    public function create(): View
    {
        $districts = District::all();
        $communes = collect([]);
        $trademark_types = TrademarkType::all();
        return view('admin.trademarks.create', compact('districts', 'communes', 'trademark_types'));
    }

    public function getCommunes($district_id)
    {
        $communes = Commune::where('district_id', $district_id)->get();
        return response()->json($communes);
    }


    public function store(trademarkRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $trademark = trademark::create($validatedData);

        if ($request->hasFile('document')) {
            $trademark->clearMediaCollection('document_trademark');
            $trademark->addMedia($request->file('document'))->toMediaCollection('document_trademark');
        }
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $trademark->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('trademark_image');
        }
        return redirect()->route('admin.trademarks.index')->with('success', 'Sáng chế đã được tạo thành công.');
    }

    public function edit(trademark $trademark): View
    {
        $districts = District::all();
        $communes = Commune::where('district_id', $trademark->district_id)->get();

        $trademark_types = TrademarkType::all();
        return view('admin.trademarks.edit', compact('trademark', 'districts', 'communes', 'trademark_types'));
    }

    public function update(trademarkRequest $request, trademark $trademark): RedirectResponse
    {
        $validatedData = $request->validated();

        $trademark->update($validatedData);

        if ($request->hasFile('document')) {
            $trademark->clearMediaCollection('document_trademark');
            $trademark->addMedia($request->file('document'))->toMediaCollection('document_trademark');
        }

        if ($request->hasFile('image')) {
            // Xóa hình ảnh cũ nếu có
            $trademark->clearMediaCollection('trademark_image');
            $imageFile = $request->file('image');
            $trademark->addMedia($imageFile->getRealPath())
                ->usingFileName($imageFile->getClientOriginalName())
                ->usingName($imageFile->getClientOriginalName())
                ->toMediaCollection('trademark_image');
        }
        return redirect()->route('admin.trademarks.index')->with('success', 'Sáng chế đã được cập nhật thành công.');
    }


    public function destroy(trademark $trademark): RedirectResponse
    {
        $trademark->clearMediaCollection('document_trademark');
        $trademark->clearMediaCollection('trademark_image');
        $trademark->delete();
        return redirect()->route('admin.trademarks.index')->with('success', 'Xoá thành công.');
    }

    public function exportExcel(Request $request)
    {
        $trademarks = json_decode($request->input('trademarks'), true);
        if (!is_array($trademarks) || empty($trademarks)) {
            return back()->with('error', 'Không có dữ liệu để xuất.');
        }
        return Excel::download(new TrademarksExport($trademarks), 'trademarks.xlsx');
    }


    public function exportPdf(Request $request)
    {
        $trademarks = json_decode($request->input('trademarks'), true);
        if (!is_array($trademarks) || empty($trademarks)) {
            return back()->with('error', 'Không có dữ liệu để xuất.');
        }
        $pdf = Pdf::loadView('admin.export_pdf.trademarks', compact('trademarks'))->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function ajaxExport(Request $request)
    {
        $query = Trademark::query();
        $filters = ['district_id', 'commune_id', 'type_id', 'name', 'owner', 'submission_status','publication_date'];
        $query = $this->applyFilters($request, $query, $filters);

        // Order by updated_at in descending order
        $trademarks = $query->with('commune.district')->orderBy('updated_at', 'desc')->get();

        return view('admin.trademarks.ajax_export', compact('trademarks'))->render();
    }

    public function statistical(Request $request): View
    {
        $districts = District::pluck('name', 'id')->toArray();
        $communes = Commune::pluck('name', 'id')->toArray();
        $types = TrademarkType::pluck('name', 'id')->toArray();
        $uniqueNames = Trademark::select('name')->distinct()->pluck('name')->toArray();
        $uniqueSubmissionStatuses = Trademark::select('submission_status')->distinct()->pluck('submission_status')->toArray();
        $uniquePublicationYears = Trademark::select(DB::raw('DISTINCT EXTRACT(YEAR FROM publication_date) as year'))
        ->orderBy('year')
        ->pluck('year')
        ->toArray();
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

        $query = Trademark::query();
        $filters = ['district_id', 'commune_id', 'type_id', 'name', 'owner', 'submission_status', 'publication_date'];
        $query = $this->applyFilters($request, $query, $filters);

        // Order by updated_at in descending order
        $trademarks = $query->with('commune.district')->orderBy('updated_at', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('admin.trademarks.ajax_list', compact('trademarks'))->render();
        }

        return view('admin.trademarks.statistical', compact(
            'trademarks',
            'districts',
            'communes',
            'types',
            'uniqueNames',
            'uniqueSubmissionStatus',
            'uniquePublicationYears'
        ));
    }
}
