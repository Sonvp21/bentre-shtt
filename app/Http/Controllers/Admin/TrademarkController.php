<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\TrademarksExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TrademarkRequest;
use App\Models\Admin\Commune;
use App\Models\Admin\District;
use App\Models\Admin\Document;
use App\Models\Admin\Image;
use App\Models\Admin\Trademark;
use App\Traits\Filterable;
use App\Models\Admin\TrademarkType;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
        $uniqueStatuses = Trademark::select('status')->distinct()->pluck('status')->toArray();
        $uniquePublicationYears = Trademark::select(DB::raw('DISTINCT EXTRACT(YEAR FROM publication_date) as year'))
            ->orderBy('year')
            ->pluck('year')
            ->toArray();
        // Ánh xạ các giá trị trạng thái với các văn bản mô tả
        $statusMap = [
            'Đang giải quyết' => 'Đang giải quyết',
            'Cấp bằng' => 'Cấp bằng',
            'Hết hạn' => 'Hết hạn',
            'Rút đơn' => 'Rút đơn',
            'Từ bỏ' => 'Từ bỏ',
            'Từ chối' => 'Từ chối',
        ];

        // Tạo mảng các tùy chọn trạng thái
        $uniqueStatus = [];
        foreach ($uniqueStatuses as $status) {
            if (isset($statusMap[$status])) {
                $uniqueStatus[$status] = $statusMap[$status];
            }
        }

        $query = Trademark::query();
        $filters = ['district_id', 'commune_id', 'type_id', 'mark', 'owner', 'status', 'filing_number', 'publication_date'];
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
            'uniqueStatus',
            'uniquePublicationYears'
        ));
    }

    public function ajaxList(Request $request)
    {
        $query = Trademark::query();
        $filters = ['district_id', 'commune_id', 'type_id', 'mark', 'owner', 'status', 'filing_number', 'publication_date'];
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


    public function store(trademarkRequest $request, Trademark $trademark): RedirectResponse
    {
        $validatedData = $request->validated();
        
        $trademark = Trademark::create($validatedData);

        // Lưu các tệp đính kèm
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $fileName = $file->getClientOriginalName(); // Lấy tên gốc của tệp
                $directory = 'public/trademarks/documents/' . $trademark->filing_number;
                $filePath = $file->storeAs($directory, $fileName); // Lưu tệp vào thư mục public
                Document::create([
                    'file_path' => str_replace('public/', '', $filePath), // Lưu đường dẫn lưu trữ
                    'file_name' => $fileName, // Lưu tên gốc
                    'trademark_id' => $trademark->id,
                ]);
            }
        }

        // Lưu các ảnh
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $fileName = $file->getClientOriginalName(); // Lấy tên gốc của tệp
                $directory = 'public/trademarks/images/' . $trademark->filing_number; // Tạo thư mục dựa trên filing_number
                $filePath = $file->storeAs($directory, $fileName); // Lưu tệp vào thư mục
                Image::create([
                    'file_path' => str_replace('public/', '', $filePath), // Lưu đường dẫn lưu trữ
                    'file_name' => $fileName, // Lưu tên gốc
                    'trademark_id' => $trademark->id,
                ]);
            }
        }
        // Cập nhật tọa độ
        $longitude = $request->input('longitude');
        $latitude = $request->input('latitude');

        $trademark->updateCoordinates($trademark->id, $longitude, $latitude);

        return redirect()->route('admin.trademarks.index')->with('success', 'Kiểu dáng đã được tạo thành công.');
    }

    public function edit(trademark $trademark): View
    {
        $districts = District::all();
        $communes = Commune::where('district_id', $trademark->district_id)->get();

        $trademark_types = TrademarkType::all();
        return view('admin.trademarks.edit', compact('trademark', 'districts', 'communes', 'trademark_types'));
    }

    public function update(trademarkRequest $request, Trademark $trademark): RedirectResponse
    {
        // Cập nhật thông tin cơ bản
        $validatedData = $request->validated();
        $trademark->update($validatedData);

        // Cập nhật tọa độ
        $longitude = $request->input('longitude');
        $latitude = $request->input('latitude');
        $trademark->updateCoordinates($trademark->id, $longitude, $latitude);

        // Chỉ xóa các tài liệu và ảnh cũ nếu có tệp đính kèm mới
        $documentsDirectory = 'public/trademarks/documents/' . $trademark->filing_number;
        $imagesDirectory = 'public/trademarks/images/' . $trademark->filing_number;

        if ($request->hasFile('documents') || $request->hasFile('images')) {
            // Xóa các tài liệu cũ trong cơ sở dữ liệu và thư mục lưu trữ
            $trademark->documents()->each(function ($document) use ($documentsDirectory) {
                Storage::delete($documentsDirectory . '/' . $document->file_name);
                $document->delete();
            });

            // Xóa các ảnh cũ trong cơ sở dữ liệu và thư mục lưu trữ
            $trademark->images()->each(function ($image) use ($imagesDirectory) {
                Storage::delete($imagesDirectory . '/' . $image->file_name);
                $image->delete();
            });

            // Xóa thư mục cũ nếu rỗng
            if (Storage::exists($documentsDirectory)) {
                Storage::deleteDirectory($documentsDirectory);
            }

            if (Storage::exists($imagesDirectory)) {
                Storage::deleteDirectory($imagesDirectory);
            }
        }

        // Lưu các tệp đính kèm mới
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                if ($file->isValid()) {
                    $fileName = $file->getClientOriginalName(); // Lấy tên gốc của tệp
                    $directory = 'public/trademarks/documents/' . $trademark->filing_number;
                    $filePath = $file->storeAs($directory, $fileName); // Lưu tệp vào thư mục public
                    Document::create([
                        'file_path' => str_replace('public/', '', $filePath), // Lưu đường dẫn lưu trữ
                        'file_name' => $fileName, // Lưu tên gốc
                        'trademark_id' => $trademark->id,
                    ]);
                }
            }
        }

        // Lưu các ảnh mới
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if ($file->isValid()) {
                    $fileName = $file->getClientOriginalName(); // Lấy tên gốc của tệp
                    $directory = 'public/trademarks/images/' . $trademark->filing_number; // Tạo thư mục dựa trên filing_number
                    $filePath = $file->storeAs($directory, $fileName); // Lưu tệp vào thư mục public
                    Image::create([
                        'file_path' => str_replace('public/', '', $filePath), // Lưu đường dẫn lưu trữ
                        'file_name' => $fileName, // Lưu tên gốc
                        'trademark_id' => $trademark->id,
                    ]);
                }
            }
        }

        return redirect()->route('admin.trademarks.index')->with('success', 'Kiểu dáng đã được cập nhật thành công.');
    }


    public function destroy(Trademark $trademark): RedirectResponse
    {
        // Đường dẫn tới thư mục lưu trữ tài liệu và hình ảnh
        $documentsDirectory = 'public/trademarks/documents/' . $trademark->filing_number;
        $imagesDirectory = 'public/trademarks/images/' . $trademark->filing_number;
    
        // Xóa các tài liệu trong cơ sở dữ liệu và thư mục lưu trữ
        $trademark->documents()->each(function ($document) use ($documentsDirectory) {
            Storage::delete($documentsDirectory . '/' . $document->file_name);
            $document->delete();
        });
    
        // Xóa các hình ảnh trong cơ sở dữ liệu và thư mục lưu trữ
        $trademark->images()->each(function ($image) use ($imagesDirectory) {
            Storage::delete($imagesDirectory . '/' . $image->file_name);
            $image->delete();
        });
    
        // Xóa thư mục cũ nếu rỗng
        if (Storage::exists($documentsDirectory)) {
            Storage::deleteDirectory($documentsDirectory);
        }
    
        if (Storage::exists($imagesDirectory)) {
            Storage::deleteDirectory($imagesDirectory);
        }
    
        // Xóa nhãn hiệu
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
        $filters = ['district_id', 'commune_id', 'type_id', 'mark', 'owner', 'status', 'filing_number', 'publication_date'];
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
        $uniqueStatuses = Trademark::select('status')->distinct()->pluck('status')->toArray();
        $uniquePublicationYears = Trademark::select(DB::raw('DISTINCT EXTRACT(YEAR FROM publication_date) as year'))
            ->orderBy('year')
            ->pluck('year')
            ->toArray();
        // Ánh xạ các giá trị trạng thái với các văn bản mô tả
        $statusMap = [
            'Đang giải quyết' => 'Đang giải quyết',
            'Cấp bằng' => 'Cấp bằng',
            'Hết hạn' => 'Hết hạn',
            'Rút đơn' => 'Rút đơn',
            'Từ bỏ' => 'Từ bỏ',
            'Từ chối' => 'Từ chối',
        ];

        // Tạo mảng các tùy chọn trạng thái
        $uniqueStatus = [];
        foreach ($uniqueStatuses as $status) {
            if (isset($statusMap[$status])) {
                $uniqueStatus[$status] = $statusMap[$status];
            }
        }

        $query = Trademark::query();
        $filters = ['district_id', 'commune_id', 'type_id', 'mark', 'owner', 'status', 'filing_number', 'publication_date'];
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
            'uniqueStatus',
            'uniquePublicationYears'
        ));
    }
}
