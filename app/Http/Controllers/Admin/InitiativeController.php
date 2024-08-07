<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\InitiativesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InitiativeRequest;
use App\Models\Admin\Initiative;
use App\Traits\Filterable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class InitiativeController extends Controller
{
    use Filterable;

    public function index(Request $request): View
    {
        $uniqueNames = Initiative::select('name')->distinct()->pluck('name')->toArray();
        $uniqueFields = Initiative::select('fields')->distinct()->pluck('fields')->toArray();
        $uniqueRecognitionYears = Initiative::select('recognition_year')->distinct()->pluck('recognition_year')->toArray();
        // Lấy các giá trị status duy nhất từ cơ sở dữ liệu
        $uniqueStatuses = Initiative::select('status')->distinct()->pluck('status')->toArray();
        // Ánh xạ các giá trị trạng thái với các văn bản mô tả
        $statusMap = [
            1 => 'Đang xử lý',
            2 => 'Đã cấp',
            3 => 'Bị từ chối',
            1 => 'Đang chờ xử lý',
            2 => 'Đang được xem xét',
            3 => 'Được phê duyệt',
            4 => 'Bị từ chối',
            5 => 'Đã triển khai',
            6 => 'Hết hạn',
            7 => 'Đã rút',
        ];

        // Tạo mảng các tùy chọn trạng thái
        $uniqueStatus = [];
        foreach ($uniqueStatuses as $status) {
            if (isset($statusMap[$status])) {
                $uniqueStatus[$status] = $statusMap[$status];
            }
        }

        $query = Initiative::query();
        $filters = [
            'name', 'author', 'owner', 'address', 'fields', 'recognition_year', 'status',
        ];
        $query = $this->applyFilters($request, $query, $filters);

        // Order by updated_at in descending order
        $initiatives = $query->orderBy('updated_at', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('admin.initiatives.ajax_list', compact('initiatives'))->render();
        }

        return view('admin.initiatives.index', compact(
            'initiatives',
            'uniqueNames',
            'uniqueFields',
            'uniqueRecognitionYears',
            'uniqueStatus'
        ));
    }

    public function ajaxList(Request $request)
    {
        $query = Initiative::query();
        $filters = ['name', 'author', 'owner', 'address', 'fields', 'recognition_year', 'status'];
        $query = $this->applyFilters($request, $query, $filters);

        // Order by updated_at in descending order
        $initiatives = $query->orderBy('updated_at', 'desc')->paginate(10);

        return view('admin.initiatives.ajax_list', compact('initiatives'))->render();
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

    ////
    public function exportExcel(Request $request)
    {
        $initiatives = json_decode($request->input('initiatives'), true);
        if (!is_array($initiatives) || empty($initiatives)) {
            return back()->with('error', 'Không có dữ liệu để xuất.');
        }
        return Excel::download(new InitiativesExport($initiatives), 'initiatives.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $initiatives = json_decode($request->input('initiatives'), true);
        if (!is_array($initiatives) || empty($initiatives)) {
            return back()->with('error', 'Không có dữ liệu để xuất.');
        }
        $pdf = Pdf::loadView('admin.export_pdf.initiatives', compact('initiatives'))->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function ajaxExport(Request $request)
    {
        $query = Initiative::query();
        $filters = ['name', 'author', 'owner', 'address', 'fields', 'recognition_year', 'status',];
        $query = $this->applyFilters($request, $query, $filters);

        // Order by updated_at in descending order
        $initiatives = $query->orderBy('updated_at', 'desc')->get();

        return view('admin.initiatives.ajax_export', compact('initiatives'))->render();
    }

    public function statistical(Request $request): View
    {
        $uniqueNames = Initiative::select('name')->distinct()->pluck('name')->toArray();
        $uniqueFields = Initiative::select('fields')->distinct()->pluck('fields')->toArray();
        $uniqueRecognitionYears = Initiative::select('recognition_year')->distinct()->pluck('recognition_year')->toArray();
        // Lấy các giá trị status duy nhất từ cơ sở dữ liệu
        $uniqueStatuses = Initiative::select('status')->distinct()->pluck('status')->toArray();
        // Ánh xạ các giá trị trạng thái với các văn bản mô tả
        $statusMap = [
            1 => 'Đang xử lý',
            2 => 'Đã cấp',
            3 => 'Bị từ chối',
            1 => 'Đang chờ xử lý',
            2 => 'Đang được xem xét',
            3 => 'Được phê duyệt',
            4 => 'Bị từ chối',
            5 => 'Đã triển khai',
            6 => 'Hết hạn',
            7 => 'Đã rút',
        ];

        // Tạo mảng các tùy chọn trạng thái
        $uniqueStatus = [];
        foreach ($uniqueStatuses as $status) {
            if (isset($statusMap[$status])) {
                $uniqueStatus[$status] = $statusMap[$status];
            }
        }

        $query = Initiative::query();
        $filters = [
            'name', 'author', 'owner', 'address', 'fields', 'recognition_year', 'status',
        ];
        $query = $this->applyFilters($request, $query, $filters);

        // Order by updated_at in descending order
        $initiatives = $query->orderBy('updated_at', 'desc')->paginate(10);

        if ($request->ajax()) {
            return view('admin.initiatives.ajax_list', compact('initiatives'))->render();
        }

        return view('admin.initiatives.statistical', compact(
            'initiatives',
            'uniqueNames',
            'uniqueFields',
            'uniqueRecognitionYears',
            'uniqueStatus'
        ));
    }
}
