<?php

namespace App\Http\Controllers\Admin;

use App\Exports\Admin\PatentsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PatentRequest;
use App\Models\Admin\Commune;
use App\Models\Admin\District;
use App\Models\Admin\Document;
use App\Models\Admin\Image;
use App\Models\Admin\Patent;
use App\Models\Admin\PatentType;
use App\Traits\Filterable;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class PatentController extends Controller
{
    use Filterable;
    public function index(Request $request): View
    {
        $districts = District::pluck('name', 'id')->toArray();
        $communes = Commune::pluck('name', 'id')->toArray();
        $types = PatentType::pluck('name', 'id')->toArray();

        $uniquePublicationYears = Patent::select(DB::raw('DISTINCT EXTRACT(YEAR FROM publication_date) as year'))
            ->orderBy('year')
            ->pluck('year')
            ->toArray();

        $query = Patent::query();
        $filters = ['district_id', 'commune_id', 'type_id', 'filing_number', 'title', 'applicant_address', 'inventor', 'other_inventor', 'publication_date',  'status'];
        $query = $this->applyFilters($request, $query, $filters);

        // Order by updated_at in descending order
        $patents = $query->with('commune.district')->orderBy('updated_at', 'asc')->paginate(10);

        if ($request->ajax()) {
            return view('admin.patents.ajax_list', compact('patents'))->render();
        }

        return view('admin.patents.index', compact(
            'patents',
            'districts',
            'communes',
            'types',
            'uniquePublicationYears'
        ));
    }

    public function ajaxList(Request $request)
    {
        $query = Patent::query();
        $filters = ['district_id', 'commune_id', 'type_id', 'filing_number', 'title', 'applicant_address', 'inventor', 'other_inventor', 'publication_date',  'status'];
        $query = $this->applyFilters($request, $query, $filters);

        // Order by updated_at in descending order
        $patents = $query->with('commune.district')->orderBy('updated_at', 'asc')->paginate(10);

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
        $patent_types = PatentType::all();
        return view('admin.patents.create', compact('districts', 'communes', 'patent_types'));
    }

    public function store(PatentRequest $request, Patent $patent): RedirectResponse
    {
        $validatedData = $request->validated();

        $patent = Patent::create($validatedData);

        // Lưu các tệp đính kèm
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $fileName = $file->getClientOriginalName(); // Lấy tên gốc của tệp
                $directory = 'public/patents/documents/' . $patent->filing_number;
                $filePath = $file->storeAs($directory, $fileName); // Lưu tệp vào thư mục public
                Document::create([
                    'file_path' => str_replace('public/', '', $filePath), // Lưu đường dẫn lưu trữ
                    'file_name' => $fileName, // Lưu tên gốc
                    'patent_id' => $patent->id,
                ]);
            }
        }

        // Lưu các ảnh
        if ($request->hasFile('images')) 
        {
            foreach ($request->file('images') as $file) 
            {
                $fileName = $file->getClientOriginalName(); // Lấy tên gốc của tệp
                $directory = 'public/patents/images/' . $patent->filing_number; // Tạo thư mục dựa trên filing_number
                $filePath = $file->storeAs($directory, $fileName); // Lưu tệp vào thư mục
                    Image::create([
                        'file_path' => str_replace('public/', '', $filePath), // Lưu đường dẫn lưu trữ
                        'file_name' => $fileName, // Lưu tên gốc
                        'patent_id' => $patent->id,
                    ]);
            }
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
        $patent_types = PatentType::all();
        return view('admin.patents.edit', compact('patent', 'districts', 'communes', 'patent_types'));
    }

    public function update(PatentRequest $request, Patent $patent): RedirectResponse
    {
        // Cập nhật thông tin cơ bản
        $validatedData = $request->validated();
        $patent->update($validatedData);

        // Cập nhật tọa độ
        $longitude = $request->input('longitude');
        $latitude = $request->input('latitude');
        $patent->updateCoordinates($patent->id, $longitude, $latitude);

        // Chỉ xóa các tài liệu cũ nếu có tệp đính kèm mới
        if ($request->hasFile('documents')) {
            $documentsDirectory = 'public/patents/documents/' . $patent->filing_number;

            // Xóa các tài liệu cũ trong cơ sở dữ liệu và thư mục lưu trữ
            $patent->documents()->each(function ($document) use ($documentsDirectory) {
                Storage::delete($documentsDirectory . '/' . $document->file_name);
                $document->delete();
            });

            // Xóa thư mục cũ nếu rỗng
            if (Storage::exists($documentsDirectory)) {
                Storage::deleteDirectory($documentsDirectory);
            }

            // Lưu các tệp đính kèm mới
            foreach ($request->file('documents') as $file) {
                if ($file->isValid()) {
                    $fileName = $file->getClientOriginalName(); // Lấy tên gốc của tệp
                    $directory = 'public/patents/documents/' . $patent->filing_number;
                    $filePath = $file->storeAs($directory, $fileName); // Lưu tệp vào thư mục public
                    Document::create([
                        'file_path' => str_replace('public/', '', $filePath), // Lưu đường dẫn lưu trữ
                        'file_name' => $fileName, // Lưu tên gốc
                        'patent_id' => $patent->id,
                    ]);
                }
            }
        }

        // Chỉ xóa các ảnh cũ nếu có ảnh mới
        if ($request->hasFile('images')) {
            $imagesDirectory = 'public/patents/images/' . $patent->filing_number;

            // Xóa các ảnh cũ trong cơ sở dữ liệu và thư mục lưu trữ
            $patent->images()->each(function ($image) use ($imagesDirectory) {
                Storage::delete($imagesDirectory . '/' . $image->file_name);
                $image->delete();
            });

            // Xóa thư mục cũ nếu rỗng
            if (Storage::exists($imagesDirectory)) {
                Storage::deleteDirectory($imagesDirectory);
            }

            // Lưu các ảnh mới
            foreach ($request->file('images') as $file) {
                if ($file->isValid()) {
                    $fileName = $file->getClientOriginalName(); // Lấy tên gốc của tệp
                    $directory = 'public/patents/images/' . $patent->filing_number; // Tạo thư mục dựa trên filing_number
                    $filePath = $file->storeAs($directory, $fileName); // Lưu tệp vào thư mục public
                    Image::create([
                        'file_path' => str_replace('public/', '', $filePath), // Lưu đường dẫn lưu trữ
                        'file_name' => $fileName, // Lưu tên gốc
                        'patent_id' => $patent->id,
                    ]);
                }
            }
        }

        return redirect()->route('admin.patents.index')->with('success', 'Sáng chế đã được cập nhật thành công.');
    }

    public function destroy(Patent $patent): RedirectResponse
    {
        // Đường dẫn tới thư mục lưu trữ tài liệu và hình ảnh
        $documentsDirectory = 'public/patents/documents/' . $patent->filing_number;
        $imagesDirectory = 'public/patents/images/' . $patent->filing_number;

        // Xóa các tài liệu trong cơ sở dữ liệu và thư mục lưu trữ
        $patent->documents()->each(function ($document) use ($documentsDirectory) {
            Storage::delete($documentsDirectory . '/' . $document->file_name);
            $document->delete();
        });

        // Xóa các hình ảnh trong cơ sở dữ liệu và thư mục lưu trữ
        $patent->images()->each(function ($image) use ($imagesDirectory) {
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
        $filters = ['district_id', 'commune_id', 'type_id', 'filing_number', 'title', 'applicant_address', 'inventor', 'other_inventor', 'publication_date',  'status'];
        $query = $this->applyFilters($request, $query, $filters);

        // Order by updated_at in descending order
        $patents = $query->with('commune.district')->orderBy('updated_at', 'desc')->get();

        return view('admin.patents.ajax_export', compact('patents'))->render();
    }

    public function statistical(Request $request): View
    {
        $districts = District::pluck('name', 'id')->toArray();
        $communes = Commune::pluck('name', 'id')->toArray();
        $types = PatentType::pluck('name', 'id')->toArray();

        $uniquePublicationYears = Patent::select(DB::raw('DISTINCT EXTRACT(YEAR FROM publication_date) as year'))
            ->orderBy('year')
            ->pluck('year')
            ->toArray();

        $query = Patent::query();
        $filters = ['district_id', 'commune_id', 'type_id', 'filing_number', 'title', 'applicant_address', 'inventor', 'other_inventor', 'publication_date',  'status'];
        $query = $this->applyFilters($request, $query, $filters);

        // Order by updated_at in descending order
        $patents = $query->with('commune.district')->orderBy('updated_at', 'asc')->paginate(10);

        if ($request->ajax()) {
            return view('admin.patents.ajax_list', compact('patents'))->render();
        }

        return view('admin.patents.statistical', compact(
            'patents',
            'districts',
            'communes',
            'types',
            'uniquePublicationYears'
        ));
    }
}
