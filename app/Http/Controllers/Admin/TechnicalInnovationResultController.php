<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TechnicalInnovationResultRequest;
use App\Models\Admin\TechnicalInnovationDossier;
use App\Models\Admin\TechnicalInnovationResult;
use App\Traits\Filterable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class TechnicalInnovationResultController extends Controller
{
    public function index(Request $request)
    {
        // Lấy các tham số lọc từ request
        $name = $request->input('name');
        $unitName = $request->input('unit_name');
        $field = $request->input('field');
        $year = $request->input('year');
        $search = $request->input('search');

        // Lấy danh sách các giá trị cho dropdowns
        $years = TechnicalInnovationResult::pluck('year')->unique();
        $dossiers = TechnicalInnovationDossier::all();
        $names = $dossiers->pluck('name')->unique();
        $unitNames = $dossiers->pluck('unit_name')->unique();
        $fields = $dossiers->pluck('field')->unique();

        // Gọi hàm lọc và phân trang
        $results = $this->filterResults($name, $unitName, $field, $year, $search)
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return view('admin.technical_innovations.technical_innovation_results.ajax_list', compact('results'))->render();
        }

        return view('admin.technical_innovations.technical_innovation_results.index', compact(
            'results',
            'names',
            'unitNames',
            'fields',
            'years'
        ));
    }
    protected function filterResults($name, $unitName, $field, $year, $search)
    {
        return TechnicalInnovationResult::whereHas('dossier', function ($query) use ($name, $unitName, $field, $search) {
            $query->where(function ($query) use ($name, $unitName, $field) {
                if ($name) {
                    $query->where('name', 'ILIKE', "%$name%");
                }
                if ($unitName) {
                    $query->where('unit_name', 'ILIKE', "%$unitName%");
                }
                if ($field) {
                    $query->where('field', 'ILIKE', "%$field%");
                }
            });
            
            // Tìm kiếm không phân biệt chữ hoa chữ thường
            $query->where(function ($query) use ($search) {
                if ($search) {
                    $query->where('name', 'ILIKE', "%$search%")
                          ->orWhere('unit_name', 'ILIKE', "%$search%")
                          ->orWhere('field', 'ILIKE', "%$search%")
                          ->orWhere('year', 'ILIKE', "%$search%"); // Thêm tìm kiếm cho trường year
                }
            });
        })
        ->when($year, function ($query, $year) {
            return $query->where('year', $year);
        })
        ->orderBy('updated_at', 'desc');
    }
    
    

    public function ajaxList(Request $request)
    {
        try {
            $name = $request->input('name');
            $unitName = $request->input('unit_name');
            $field = $request->input('field');
            $year = $request->input('year');
            $search = $request->input('search');

            // Kiểm tra phần lọc và tìm kiếm
            $results = $this->filterResults($name, $unitName, $field, $year, $search)
                ->orderBy('updated_at', 'desc')
                ->paginate(10);

            return view('admin.technical_innovations.technical_innovation_results.ajax_list', compact('results'))->render();
        } catch (\Exception $e) {
            Log::error('Error in ajaxList: ' . $e->getMessage());
            return response()->json(['error' => 'Có lỗi xảy ra'], 500);
        }
    }


    public function create(): View
    {
        $dossiers = TechnicalInnovationDossier::select('id', 'name')->get();
        return view('admin.technical_innovations.technical_innovation_results.create', compact('dossiers'));
    }

    public function store(TechnicalInnovationResultRequest $request): RedirectResponse
    {
        $technicalInnovationResult = TechnicalInnovationResult::create($request->validated());

        if ($request->hasFile('document')) {
            $technicalInnovationResult->clearMediaCollection('document_technical');
            $technicalInnovationResult->addMedia($request->file('document'))->toMediaCollection('document_technical');
        }

        return redirect()->route('admin.technical_innovation_results.index')->with('success', 'Thêm mới thành công.');
    }

    public function edit(TechnicalInnovationResult $technicalInnovationResult): View
    {
        $dossiers = TechnicalInnovationDossier::select('id', 'name')->get();
        return view('admin.technical_innovations.technical_innovation_results.edit', compact('technicalInnovationResult', 'dossiers'));
    }

    public function update(TechnicalInnovationResultRequest $request, TechnicalInnovationResult $technicalInnovationResult): RedirectResponse
    {
        $technicalInnovationResult->update($request->validated());

        if ($request->hasFile('document')) {
            $technicalInnovationResult->clearMediaCollection('document_technical');
            $technicalInnovationResult->addMedia($request->file('document'))->toMediaCollection('document_technical');
        }

        return redirect()->route('admin.technical_innovation_results.index')->with('success', 'Cập nhật thành công.');
    }

    public function destroy(TechnicalInnovationResult $technicalInnovationResult): RedirectResponse
    {
        $technicalInnovationResult->clearMediaCollection('document_technical');
        $technicalInnovationResult->delete();
        return redirect()->route('admin.technical_innovation_results.index')->with('success', 'Xoá thành công!');
    }

    public function statistical(Request $request): View
    {
        // Lấy các tham số lọc từ request
        $name = $request->input('name');
        $unitName = $request->input('unit_name');
        $field = $request->input('field');
        $year = $request->input('year');
        $search = $request->input('search');

        // Lấy danh sách các giá trị cho dropdowns
        $years = TechnicalInnovationResult::pluck('year')->unique();
        $dossiers = TechnicalInnovationDossier::all();
        $names = $dossiers->pluck('name')->unique();
        $unitNames = $dossiers->pluck('unit_name')->unique();
        $fields = $dossiers->pluck('field')->unique();

        // Gọi hàm lọc và phân trang
        $results = $this->filterResults($name, $unitName, $field, $year, $search)
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        if ($request->ajax()) {
            return view('admin.technical_innovations.technical_innovation_results.ajax_list', compact('results'))->render();
        }

        return view('admin.technical_innovations.technical_innovation_results.statistical', compact(
            'results',
            'names',
            'unitNames',
            'fields',
            'years'
        ));
    }
}
