<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\IndustrialDesignsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\IndustrialDesignRequest;
use App\Models\Admin\Commune;
use App\Models\Admin\District;
use App\Models\Admin\Document;
use App\Models\Admin\Image;
use App\Models\Admin\IndustrialDesign;
use App\Models\Admin\IndustrialDesignType;
use App\Traits\Filterable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
        $filters = ['district_id', 'commune_id', 'type_id', 'name', 'filing_number', 'owner', 'publication_date',];
        $query = $this->applyFilters($request, $query, $filters);

        // Order by updated_at in descending order
        $IndustrialDesigns = $query->with('commune.district')->first()->paginate(10);

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
        $filters = ['district_id', 'commune_id', 'type_id', 'name', 'owner', 'filing_number', 'publication_date',];
        $query = $this->applyFilters($request, $query, $filters);

        // Order by updated_at in descending order
        $IndustrialDesigns = $query->with('commune.district', 'images')->first()->paginate(10);

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
        $validatedData = $request->validated();
        $industrialDesign = IndustrialDesign::create($validatedData);

        // Lưu các tệp đính kèm
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $fileName = $file->getClientOriginalName(); // Lấy tên gốc của tệp
                $directory = 'public/industrial_designs/documents/' . $industrialDesign->filing_number;
                $filePath = $file->storeAs($directory, $fileName); // Lưu tệp vào thư mục public
                Document::create([
                    'file_path' => str_replace('public/', '', $filePath), // Lưu đường dẫn lưu trữ
                    'file_name' => $fileName, // Lưu tên gốc
                    'industrial_design_id' => $industrialDesign->id,
                ]);
            }
        }

        // Lưu các ảnh
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $fileName = $file->getClientOriginalName(); // Lấy tên gốc của tệp
                $directory = 'public/industrial_designs/images/' . $industrialDesign->filing_number; // Tạo thư mục dựa trên filing_number
                $filePath = $file->storeAs($directory, $fileName); // Lưu tệp vào thư mục
                Image::create([
                    'file_path' => str_replace('public/', '', $filePath), // Lưu đường dẫn lưu trữ
                    'file_name' => $fileName, // Lưu tên gốc
                    'industrial_design_id' => $industrialDesign->id,
                ]);
            }
        }
        // Cập nhật tọa độ
        $longitude = $request->input('longitude');
        $latitude = $request->input('latitude');

        $industrialDesign->updateCoordinates($industrialDesign->id, $longitude, $latitude);

        return redirect()->route('admin.industrial_designs.index')->with('success', 'Kiểu dáng đã được tạo thành công.');
    }


    public function edit(IndustrialDesign $industrialDesign): View
    {
        $districts = District::all();
        $communes = Commune::where('district_id', $industrialDesign->district_id)->get();

        $industrialDesignType = IndustrialDesignType::all();
        return view('admin.industrial_designs.edit', compact('industrialDesign', 'districts', 'communes', 'industrialDesignType'));
    }

    public function update(IndustrialDesignRequest $request, IndustrialDesign $industrialDesign): RedirectResponse
    {
        // Cập nhật thông tin cơ bản
        $validatedData = $request->validated();
        $industrialDesign->update($validatedData);
    
        // Cập nhật tọa độ
        $longitude = $request->input('longitude');
        $latitude = $request->input('latitude');
        $industrialDesign->updateCoordinates($industrialDesign->id, $longitude, $latitude);
    
        // Chỉ xóa các tài liệu và ảnh cũ nếu có tệp đính kèm mới
        $documentsDirectory = 'public/industrial_designs/documents/' . $industrialDesign->filing_number;
        $imagesDirectory = 'public/industrial_designs/images/' . $industrialDesign->filing_number;
    
        if ($request->hasFile('documents') || $request->hasFile('images')) {
            // Xóa các tài liệu cũ trong cơ sở dữ liệu và thư mục lưu trữ
            $industrialDesign->documents()->each(function ($document) use ($documentsDirectory) {
                Storage::delete($documentsDirectory . '/' . $document->file_name);
                $document->delete();
            });
    
            // Xóa các ảnh cũ trong cơ sở dữ liệu và thư mục lưu trữ
            $industrialDesign->images()->each(function ($image) use ($imagesDirectory) {
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
                    $directory = 'public/industrial_designs/documents/' . $industrialDesign->filing_number;
                    $filePath = $file->storeAs($directory, $fileName); // Lưu tệp vào thư mục public
                    Document::create([
                        'file_path' => str_replace('public/', '', $filePath), // Lưu đường dẫn lưu trữ
                        'file_name' => $fileName, // Lưu tên gốc
                        'industrial_design_id' => $industrialDesign->id,
                    ]);
                }
            }
        }
    
        // Lưu các ảnh mới
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                if ($file->isValid()) {
                    $fileName = $file->getClientOriginalName(); // Lấy tên gốc của tệp
                    $directory = 'public/industrial_designs/images/' . $industrialDesign->filing_number; // Tạo thư mục dựa trên filing_number
                    $filePath = $file->storeAs($directory, $fileName); // Lưu tệp vào thư mục public
                    Image::create([
                        'file_path' => str_replace('public/', '', $filePath), // Lưu đường dẫn lưu trữ
                        'file_name' => $fileName, // Lưu tên gốc
                        'industrial_design_id' => $industrialDesign->id,
                    ]);
                }
            }
        }
    
        return redirect()->route('admin.industrial_designs.index')->with('success', 'Kiểu dáng đã được cập nhật thành công.');
    }
    

    public function destroy(IndustrialDesign $industrialDesign): RedirectResponse
    {
        // Đường dẫn tới thư mục lưu trữ tài liệu và hình ảnh
        $documentsDirectory = 'public/industrial_designs/documents/' . $industrialDesign->filing_number;
        $imagesDirectory = 'public/industrial_designs/images/' . $industrialDesign->filing_number;
    
        // Xóa các tài liệu trong cơ sở dữ liệu và thư mục lưu trữ
        $industrialDesign->documents()->each(function ($document) use ($documentsDirectory) {
            Storage::delete($documentsDirectory . '/' . $document->file_name);
            $document->delete();
        });
    
        // Xóa các hình ảnh trong cơ sở dữ liệu và thư mục lưu trữ
        $industrialDesign->images()->each(function ($image) use ($imagesDirectory) {
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
        $filters = ['district_id', 'commune_id', 'type_id', 'name', 'owner', 'filing_number', 'publication_date',];
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
        $filters = ['district_id', 'commune_id', 'type_id', 'name', 'owner', 'filing_number', 'publication_date',];
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
