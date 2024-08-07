<?php

use App\Http\Controllers\Admin\AdvisorySupportController;
use App\Http\Controllers\Admin\AnswerController;
use App\Http\Controllers\Admin\CommuneController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\GeographicalIndicationController;
use App\Http\Controllers\Admin\IndustrialDesignController;
use App\Http\Controllers\Admin\IndustrialDesignTypeController;
use App\Http\Controllers\Admin\InfringementController;
use App\Http\Controllers\Admin\InitiativeController;
use App\Http\Controllers\Admin\InitiativeDossierController;
use App\Http\Controllers\Admin\InitiativeEvaluateController;
use App\Http\Controllers\Admin\PatentController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\Support\TinymceController;
use App\Http\Controllers\Admin\TechnicalInnovationCommitteeController;
use App\Http\Controllers\Admin\TechnicalInnovationDossierController;
use App\Http\Controllers\Admin\TechnicalInnovationResultController;
use App\Http\Controllers\Admin\TrademarkController;
use App\Http\Controllers\Admin\TrademarkTypeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ImageSearchController;
use App\Http\Controllers\ProfileController;
use App\Models\Admin\TechnicalInnovationResult;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function () {
    //// Huyện
        Route::get('districts', [DistrictController::class, 'index'])->middleware('can:index,App\Models\Admin\District')->name('districts.index');
        Route::get('districts/create', [DistrictController::class, 'create'])->middleware('can:create,App\Models\Admin\District')->name('districts.create');
        Route::post('districts', [DistrictController::class, 'store'])->middleware('can:create,App\Models\Admin\District')->name('districts.store');
        Route::get('districts/{district}/edit', [DistrictController::class, 'edit'])->middleware('can:edit,App\Models\Admin\District')->name('districts.edit');
        Route::put('districts/{district}', [DistrictController::class, 'update'])->middleware('can:edit,App\Models\Admin\District')->name('districts.update');
        Route::delete('districts/{district}', [DistrictController::class, 'destroy'])->middleware('can:destroy,App\Models\Admin\District')->name('districts.destroy');
        // POST cho lọc, GET cho phân trang
        Route::match(['get', 'post'], 'districts/ajax_list', [DistrictController::class, 'ajaxList'])->name('districts.ajax_list');

        // POST cho lọc, GET cho export excel, pdf
        Route::post('districts/ajax_export', [DistrictController::class, 'ajaxExport'])->name('districts.ajax_export');
        Route::post('districts/export_excel', [DistrictController::class, 'exportExcel'])->name('districts.export_excel');
        Route::post('districts/export_pdf', [DistrictController::class, 'exportPdf'])->name('districts.export_pdf');

    //// Xã
        Route::get('communes', [CommuneController::class, 'index'])->middleware('can:index,App\Models\Admin\Commune')->name('communes.index');
        Route::get('communes/create', [CommuneController::class, 'create'])->middleware('can:create,App\Models\Admin\Commune')->name('communes.create');
        Route::post('communes', [CommuneController::class, 'store'])->middleware('can:create,App\Models\Admin\Commune')->name('communes.store');
        Route::get('communes/{commune}/edit', [CommuneController::class, 'edit'])->middleware('can:edit,App\Models\Admin\Commune')->name('communes.edit');
        Route::put('communes/{commune}', [CommuneController::class, 'update'])->middleware('can:edit,App\Models\Admin\Commune')->name('communes.update');
        Route::delete('communes/{commune}', [CommuneController::class, 'destroy'])->middleware('can:destroy,App\Models\Admin\Commune')->name('communes.destroy');

        // POST cho lọc, GET cho phân trang
        Route::match(['get', 'post'], 'communes/ajax_list', [CommuneController::class, 'ajaxList'])->name('communes.ajax_list');

        // POST cho lọc, GET cho export excel, pdf
        Route::post('communes/ajax_export', [CommuneController::class, 'ajaxExport'])->name('communes.ajax_export');
        Route::post('communes/export_excel', [CommuneController::class, 'exportExcel'])->name('communes.export_excel');
        Route::post('communes/export_pdf', [CommuneController::class, 'exportPdf'])->name('communes.export_pdf');

    ////Sáng chế shtt
        // Route::resource('patents', PatentController::class);
        Route::get('patents', [PatentController::class, 'index'])->middleware('can:index,App\Models\Admin\Patent')->name('patents.index');
        Route::get('patents/create', [PatentController::class, 'create'])->middleware('can:create,App\Models\Admin\Patent')->name('patents.create');
        Route::post('patents', [PatentController::class, 'store'])->middleware('can:create,App\Models\Admin\Patent')->name('patents.store');
        Route::get('patents/{patent}/edit', [PatentController::class, 'edit'])->middleware('can:edit,App\Models\Admin\Patent')->name('patents.edit');
        Route::put('patents/{patent}', [PatentController::class, 'update'])->middleware('can:edit,App\Models\Admin\Patent')->name('patents.update');
        Route::delete('patents/{patent}', [PatentController::class, 'destroy'])->middleware('can:destroy,App\Models\Admin\Patent')->name('patents.destroy');
            //Lấy xã theo huyện 
            Route::get('admin/patents/get-communes/{district_id}', [PatentController::class, 'getCommunes'])->name('patents.getCommunes');
            // POST cho lọc, GET cho phân trang
            Route::match(['get', 'post'], 'patents/ajax_list', [PatentController::class, 'ajaxList'])->name('patents.ajax_list');

            // POST cho lọc, GET cho export excel, pdf
            Route::post('patents/ajax_export', [PatentController::class, 'ajaxExport'])->name('patents.ajax_export');
            Route::post('patents/export_excel', [PatentController::class, 'exportExcel'])->name('patents.export_excel');
            Route::post('patents/export_pdf', [PatentController::class, 'exportPdf'])->name('patents.export_pdf');
        
    ////Bảo hộ nhãn hiệu
        // Route::resource('trademark_types', TrademarkTypeController::class);
        Route::get('trademark_types', [TrademarkTypeController::class, 'index'])->middleware('can:index,App\Models\Admin\TrademarkType')->name('trademark_types.index');
        Route::get('trademark_types/create', [TrademarkTypeController::class, 'create'])->middleware('can:create,App\Models\Admin\TrademarkType')->name('trademark_types.create');
        Route::post('trademark_types', [TrademarkTypeController::class, 'store'])->middleware('can:create,App\Models\Admin\TrademarkType')->name('trademark_types.store');
        Route::get('trademark_types/{trademark_type}/edit', [TrademarkTypeController::class, 'edit'])->middleware('can:edit,App\Models\Admin\TrademarkType')->name('trademark_types.edit');
        Route::put('trademark_types/{trademark_type}', [TrademarkTypeController::class, 'update'])->middleware('can:edit,App\Models\Admin\TrademarkType')->name('trademark_types.update');
        Route::delete('trademark_types/{trademark_type}', [TrademarkTypeController::class, 'destroy'])->middleware('can:destroy,App\Models\Admin\TrademarkType')->name('trademark_types.destroy');

        // Route::resource('trademarks', TrademarkController::class);
        Route::get('trademarks', [TrademarkController::class, 'index'])->middleware('can:index,App\Models\Admin\Trademark')->name('trademarks.index');
        Route::get('trademarks/create', [TrademarkController::class, 'create'])->middleware('can:create,App\Models\Admin\Trademark')->name('trademarks.create');
        Route::post('trademarks', [TrademarkController::class, 'store'])->middleware('can:create,App\Models\Admin\Trademark')->name('trademarks.store');
        Route::get('trademarks/{trademark}/edit', [TrademarkController::class, 'edit'])->middleware('can:edit,App\Models\Admin\Trademark')->name('trademarks.edit');
        Route::put('trademarks/{trademark}', [TrademarkController::class, 'update'])->middleware('can:edit,App\Models\Admin\Trademark')->name('trademarks.update');
        Route::delete('trademarks/{trademark}', [TrademarkController::class, 'destroy'])->middleware('can:destroy,App\Models\Admin\Trademark')->name('trademarks.destroy');
                //Lấy xã theo huyện 
                Route::get('admin/trademarks/get-communes/{district_id}', [TrademarkController::class, 'getCommunes'])->name('trademarks.getCommunes');
                // POST cho lọc, GET cho phân trang
                Route::match(['get', 'post'], 'trademarks/ajax_list', [TrademarkController::class, 'ajaxList'])->name('trademarks.ajax_list');
        
                // POST cho lọc, GET cho export excel, pdf
                Route::post('trademarks/ajax_export', [TrademarkController::class, 'ajaxExport'])->name('trademarks.ajax_export');
                Route::post('trademarks/export_excel', [TrademarkController::class, 'exportExcel'])->name('trademarks.export_excel');
                Route::post('trademarks/export_pdf', [TrademarkController::class, 'exportPdf'])->name('trademarks.export_pdf');
                


    ///Kiểu dáng công nghiệp
        // Route::resource('industrial_design_types', IndustrialDesignTypeController::class);
        Route::get('industrial_design_types', [IndustrialDesignTypeController::class, 'index'])->middleware('can:index,App\Models\Admin\IndustrialDesignType')->name('industrial_design_types.index');
        Route::get('industrial_design_types/create', [IndustrialDesignTypeController::class, 'create'])->middleware('can:create,App\Models\Admin\IndustrialDesignType')->name('industrial_design_types.create');
        Route::post('industrial_design_types', [IndustrialDesignTypeController::class, 'store'])->middleware('can:create,App\Models\Admin\IndustrialDesignType')->name('industrial_design_types.store');
        Route::get('industrial_design_types/{industrial_design_type}/edit', [IndustrialDesignTypeController::class, 'edit'])->middleware('can:edit,App\Models\Admin\IndustrialDesignType')->name('industrial_design_types.edit');
        Route::put('industrial_design_types/{industrial_design_type}', [IndustrialDesignTypeController::class, 'update'])->middleware('can:edit,App\Models\Admin\IndustrialDesignType')->name('industrial_design_types.update');
        Route::delete('industrial_design_types/{industrial_design_type}', [IndustrialDesignTypeController::class, 'destroy'])->middleware('can:destroy,App\Models\Admin\IndustrialDesignType')->name('industrial_design_types.destroy');

        // Route::resource('industrial_designs', IndustrialDesignController::class);
        Route::get('industrial_designs', [IndustrialDesignController::class, 'index'])->middleware('can:index,App\Models\Admin\IndustrialDesign')->name('industrial_designs.index');
        Route::get('industrial_designs/create', [IndustrialDesignController::class, 'create'])->middleware('can:create,App\Models\Admin\IndustrialDesign')->name('industrial_designs.create');
        Route::post('industrial_designs', [IndustrialDesignController::class, 'store'])->middleware('can:create,App\Models\Admin\IndustrialDesign')->name('industrial_designs.store');
        Route::get('industrial_designs/{industrial_design}/edit', [IndustrialDesignController::class, 'edit'])->middleware('can:edit,App\Models\Admin\IndustrialDesign')->name('industrial_designs.edit');
        Route::put('industrial_designs/{industrial_design}', [IndustrialDesignController::class, 'update'])->middleware('can:edit,App\Models\Admin\IndustrialDesign')->name('industrial_designs.update');
        Route::delete('industrial_designs/{industrial_design}', [IndustrialDesignController::class, 'destroy'])->middleware('can:destroy,App\Models\Admin\IndustrialDesign')->name('industrial_designs.destroy');

             // POST cho lọc, GET cho phân trang
             Route::match(['get', 'post'], 'industrial_designs/ajax_list', [IndustrialDesignController::class, 'ajaxList'])->name('industrial_designs.ajax_list');
            
             // POST cho lọc, GET cho export excel, pdf
             Route::post('industrial_designs/ajax_export', [IndustrialDesignController::class, 'ajaxExport'])->name('industrial_designs.ajax_export');
             Route::post('industrial_designs/export_excel', [IndustrialDesignController::class, 'exportExcel'])->name('industrial_designs.export_excel');
             Route::post('industrial_designs/export_pdf', [IndustrialDesignController::class, 'exportPdf'])->name('industrial_designs.export_pdf');

    ///Sáng kiến
        // Route::resource('initiatives', InitiativeController::class); //sáng kiến
        Route::get('initiatives', [InitiativeController::class, 'index'])->middleware('can:index,App\Models\Admin\Initiative')->name('initiatives.index');
        Route::get('initiatives/create', [InitiativeController::class, 'create'])->middleware('can:create,App\Models\Admin\Initiative')->name('initiatives.create');
        Route::post('initiatives', [InitiativeController::class, 'store'])->middleware('can:create,App\Models\Admin\Initiative')->name('initiatives.store');
        Route::get('initiatives/{initiative}/edit', [InitiativeController::class, 'edit'])->middleware('can:edit,App\Models\Admin\Initiative')->name('initiatives.edit');
        Route::put('initiatives/{initiative}', [InitiativeController::class, 'update'])->middleware('can:edit,App\Models\Admin\Initiative')->name('initiatives.update');
        Route::delete('initiatives/{initiative}', [InitiativeController::class, 'destroy'])->middleware('can:destroy,App\Models\Admin\Initiative')->name('initiatives.destroy');

            // POST cho lọc, GET cho phân trang
            Route::match(['get', 'post'], 'initiatives/ajax_list', [InitiativeController::class, 'ajaxList'])->name('initiatives.ajax_list');

            // POST cho lọc, GET cho export excel, pdf
            Route::post('initiatives/ajax_export', [InitiativeController::class, 'ajaxExport'])->name('initiatives.ajax_export');
            Route::post('initiatives/export_excel', [InitiativeController::class, 'exportExcel'])->name('initiatives.export_excel');
            Route::post('initiatives/export_pdf', [InitiativeController::class, 'exportPdf'])->name('initiatives.export_pdf');

        // Route::resource('initiative_dossiers', InitiativeDossierController::class); //hồ sơ sáng kiến
        Route::get('initiative_dossiers', [InitiativeDossierController::class, 'index'])->middleware('can:index,App\Models\Admin\InitiativeDossier')->name('initiative_dossiers.index');
        Route::get('initiative_dossiers/create', [InitiativeDossierController::class, 'create'])->middleware('can:create,App\Models\Admin\InitiativeDossier')->name('initiative_dossiers.create');
        Route::post('initiative_dossiers', [InitiativeDossierController::class, 'store'])->middleware('can:create,App\Models\Admin\InitiativeDossier')->name('initiative_dossiers.store');
        Route::get('initiative_dossiers/{initiative_dossier}/edit', [InitiativeDossierController::class, 'edit'])->middleware('can:edit,App\Models\Admin\InitiativeDossier')->name('initiative_dossiers.edit');
        Route::put('initiative_dossiers/{initiative_dossier}', [InitiativeDossierController::class, 'update'])->middleware('can:edit,App\Models\Admin\InitiativeDossier')->name('initiative_dossiers.update');
        Route::delete('initiative_dossiers/{initiative_dossier}', [InitiativeDossierController::class, 'destroy'])->middleware('can:destroy,App\Models\Admin\InitiativeDossier')->name('initiative_dossiers.destroy');

        // Route::resource('initiative_evaluates', InitiativeEvaluateController::class); //Hội đồng thông qua
        Route::get('initiative_evaluates', [InitiativeEvaluateController::class, 'index'])->middleware('can:index,App\Models\Admin\InitiativeEvaluate')->name('initiative_evaluates.index');
        Route::get('initiative_evaluates/create', [InitiativeEvaluateController::class, 'create'])->middleware('can:create,App\Models\Admin\InitiativeEvaluate')->name('initiative_evaluates.create');
        Route::post('initiative_evaluates', [InitiativeEvaluateController::class, 'store'])->middleware('can:create,App\Models\Admin\InitiativeEvaluate')->name('initiative_evaluates.store');
        Route::get('initiative_evaluates/{initiative_evaluate}/edit', [InitiativeEvaluateController::class, 'edit'])->middleware('can:edit,App\Models\Admin\InitiativeEvaluate')->name('initiative_evaluates.edit');
        Route::put('initiative_evaluates/{initiative_evaluate}', [InitiativeEvaluateController::class, 'update'])->middleware('can:edit,App\Models\Admin\InitiativeEvaluate')->name('initiative_evaluates.update');
        Route::delete('initiative_evaluates/{initiative_evaluate}', [InitiativeEvaluateController::class, 'destroy'])->middleware('can:destroy,App\Models\Admin\InitiativeEvaluate')->name('initiative_evaluates.destroy');

        Route::get('/get-dossiers/{initiativeId}', [InitiativeEvaluateController::class, 'getDossiers'])->name('initiatives.getDossiers');

        //Sáng tạo kỹ thuật
        // Route::resource('technical_innovation_dossiers', TechnicalInnovationDossierController::class); //Hố sơ
        Route::get('technical_innovation_dossiers', [TechnicalInnovationDossierController::class, 'index'])->middleware('can:index,App\Models\Admin\TechnicalInnovationDossier')->name('technical_innovation_dossiers.index');
        Route::get('technical_innovation_dossiers/create', [TechnicalInnovationDossierController::class, 'create'])->middleware('can:create,App\Models\Admin\TechnicalInnovationDossier')->name('technical_innovation_dossiers.create');
        Route::post('technical_innovation_dossiers', [TechnicalInnovationDossierController::class, 'store'])->middleware('can:create,App\Models\Admin\TechnicalInnovationDossier')->name('technical_innovation_dossiers.store');
        Route::get('technical_innovation_dossiers/{technical_innovation_dossier}/edit', [TechnicalInnovationDossierController::class, 'edit'])->middleware('can:edit,App\Models\Admin\TechnicalInnovationDossier')->name('technical_innovation_dossiers.edit');
        Route::put('technical_innovation_dossiers/{technical_innovation_dossier}', [TechnicalInnovationDossierController::class, 'update'])->middleware('can:edit,App\Models\Admin\TechnicalInnovationDossier')->name('technical_innovation_dossiers.update');
        Route::delete('technical_innovation_dossiers/{technical_innovation_dossier}', [TechnicalInnovationDossierController::class, 'destroy'])->middleware('can:destroy,App\Models\Admin\TechnicalInnovationDossier')->name('technical_innovation_dossiers.destroy');

        // Route::resource('technical_innovation_committees', TechnicalInnovationCommitteeController::class); //Hội đồng
        Route::get('technical_innovation_committees', [TechnicalInnovationCommitteeController::class, 'index'])->middleware('can:index,App\Models\Admin\TechnicalInnovationCommittee')->name('technical_innovation_committees.index');
        Route::get('technical_innovation_committees/create', [TechnicalInnovationCommitteeController::class, 'create'])->middleware('can:create,App\Models\Admin\TechnicalInnovationCommittee')->name('technical_innovation_committees.create');
        Route::post('technical_innovation_committees', [TechnicalInnovationCommitteeController::class, 'store'])->middleware('can:create,App\Models\Admin\TechnicalInnovationCommittee')->name('technical_innovation_committees.store');
        Route::get('technical_innovation_committees/{technical_innovation_committee}/edit', [TechnicalInnovationCommitteeController::class, 'edit'])->middleware('can:edit,App\Models\Admin\TechnicalInnovationCommittee')->name('technical_innovation_committees.edit');
        Route::put('technical_innovation_committees/{technical_innovation_committee}', [TechnicalInnovationCommitteeController::class, 'update'])->middleware('can:edit,App\Models\Admin\TechnicalInnovationCommittee')->name('technical_innovation_committees.update');
        Route::delete('technical_innovation_committees/{technical_innovation_committee}', [TechnicalInnovationCommitteeController::class, 'destroy'])->middleware('can:destroy,App\Models\Admin\TechnicalInnovationCommittee')->name('technical_innovation_committees.destroy');

        // Route::resource('technical_innovation_results', TechnicalInnovationResultController::class); //Kết quả
        Route::get('technical_innovation_results', [TechnicalInnovationResultController::class, 'index'])->middleware('can:index,App\Models\Admin\TechnicalInnovationResult')->name('technical_innovation_results.index');
        Route::get('technical_innovation_results/create', [TechnicalInnovationResultController::class, 'create'])->middleware('can:create,App\Models\Admin\TechnicalInnovationResult')->name('technical_innovation_results.create');
        Route::post('technical_innovation_results', [TechnicalInnovationResultController::class, 'store'])->middleware('can:create,App\Models\Admin\TechnicalInnovationResult')->name('technical_innovation_results.store');
        Route::get('technical_innovation_results/{technical_innovation_result}/edit', [TechnicalInnovationResultController::class, 'edit'])->middleware('can:edit,App\Models\Admin\TechnicalInnovationResult')->name('technical_innovation_results.edit');
        Route::put('technical_innovation_results/{technical_innovation_result}', [TechnicalInnovationResultController::class, 'update'])->middleware('can:edit,App\Models\Admin\TechnicalInnovationResult')->name('technical_innovation_results.update');
        Route::delete('technical_innovation_results/{technical_innovation_result}', [TechnicalInnovationResultController::class, 'destroy'])->middleware('can:destroy,App\Models\Admin\TechnicalInnovationResult')->name('technical_innovation_results.destroy');

        Route::match(['get', 'post'], 'technical_innovation_results/ajax_list', [TechnicalInnovationResultController::class, 'ajaxList'])->name('technical_innovation_results.ajax_list');

    ///Chỉ dẫn địa lý
        // Route::resource('geographical_indications', GeographicalIndicationController::class);
        Route::get('geographical_indications', [GeographicalIndicationController::class, 'index'])->middleware('can:index,App\Models\Admin\GeographicalIndication')->name('geographical_indications.index');
        Route::get('geographical_indications/create', [GeographicalIndicationController::class, 'create'])->middleware('can:create,App\Models\Admin\GeographicalIndication')->name('geographical_indications.create');
        Route::post('geographical_indications', [GeographicalIndicationController::class, 'store'])->middleware('can:create,App\Models\Admin\GeographicalIndication')->name('geographical_indications.store');
        Route::get('geographical_indications/{geographical_indication}/edit', [GeographicalIndicationController::class, 'edit'])->middleware('can:edit,App\Models\Admin\GeographicalIndication')->name('geographical_indications.edit');
        Route::put('geographical_indications/{geographical_indication}', [GeographicalIndicationController::class, 'update'])->middleware('can:edit,App\Models\Admin\GeographicalIndication')->name('geographical_indications.update');
        Route::delete('geographical_indications/{geographical_indication}', [GeographicalIndicationController::class, 'destroy'])->middleware('can:destroy,App\Models\Admin\GeographicalIndication')->name('geographical_indications.destroy');

            // POST cho lọc, GET cho phân trang
            Route::match(['get', 'post'], 'geographical_indications/ajax_list', [GeographicalIndicationController::class, 'ajaxList'])->name('geographical_indications.ajax_list');
            
            // POST cho lọc, GET cho export excel, pdf
            Route::post('geographical_indications/ajax_export', [GeographicalIndicationController::class, 'ajaxExport'])->name('geographical_indications.ajax_export');
            Route::post('geographical_indications/export_excel', [GeographicalIndicationController::class, 'exportExcel'])->name('geographical_indications.export_excel');
            Route::post('geographical_indications/export_pdf', [GeographicalIndicationController::class, 'exportPdf'])->name('geographical_indications.export_pdf');

    ///Sản phẩm
        // Route::resource('products', ProductController::class);
        Route::get('products', [ProductController::class, 'index'])->middleware('can:index,App\Models\Admin\Product')->name('products.index');
        Route::get('products/create', [ProductController::class, 'create'])->middleware('can:create,App\Models\Admin\Product')->name('products.create');
        Route::post('products', [ProductController::class, 'store'])->middleware('can:create,App\Models\Admin\Product')->name('products.store');
        Route::get('products/{product}/edit', [ProductController::class, 'edit'])->middleware('can:edit,App\Models\Admin\Product')->name('products.edit');
        Route::put('products/{product}', [ProductController::class, 'update'])->middleware('can:edit,App\Models\Admin\Product')->name('products.update');
        Route::delete('products/{product}', [ProductController::class, 'destroy'])->middleware('can:destroy,App\Models\Admin\Product')->name('products.destroy');

            // POST cho lọc, GET cho phân trang
            Route::match(['get', 'post'], 'products/ajax_list', [ProductController::class, 'ajaxList'])->name('products.ajax_list');

            // POST cho lọc, GET cho export excel, pdf
            Route::post('products/ajax_export', [ProductController::class, 'ajaxExport'])->name('products.ajax_export');
            Route::post('products/export_excel', [ProductController::class, 'exportExcel'])->name('products.export_excel');
            Route::post('products/export_pdf', [ProductController::class, 'exportPdf'])->name('products.export_pdf');

    ///thông tin hỗ trợ, tư vấn
        Route::get('advisory_supports', [AdvisorySupportController::class, 'index'])->middleware('can:index,App\Models\Admin\AdvisorySupport')->name('advisory_supports.index');
        Route::get('advisory_supports/create', [AdvisorySupportController::class, 'create'])->middleware('can:create,App\Models\Admin\AdvisorySupport')->name('advisory_supports.create');
        Route::post('advisory_supports', [AdvisorySupportController::class, 'store'])->middleware('can:create,App\Models\Admin\AdvisorySupport')->name('advisory_supports.store');
        Route::get('advisory_supports/{advisory_support}/edit', [AdvisorySupportController::class, 'edit'])->middleware('can:edit,App\Models\Admin\AdvisorySupport')->name('advisory_supports.edit');
        Route::put('advisory_supports/{advisory_support}', [AdvisorySupportController::class, 'update'])->middleware('can:edit,App\Models\Admin\AdvisorySupport')->name('advisory_supports.update');
        Route::delete('advisory_supports/{advisory_support}', [AdvisorySupportController::class, 'destroy'])->middleware('can:destroy,App\Models\Admin\AdvisorySupport')->name('advisory_supports.destroy');

        Route::get('advisory_supports/categories', [AdvisorySupportController::class, 'indexCategories'])->name('advisory_supports.categories.index');
        Route::get('advisory_supports/categories/create', [AdvisorySupportController::class, 'createCategory'])->name('advisory_supports.categories.create');
        Route::post('advisory_supports/categories', [AdvisorySupportController::class, 'storeCategory'])->name('advisory_supports.categories.store');
        Route::get('advisory_supports/categories/{category}/edit', [AdvisorySupportController::class, 'editCategory'])->name('advisory_supports.categories.edit');
        Route::put('advisory_supports/categories/{category}', [AdvisorySupportController::class, 'updateCategory'])->name('advisory_supports.categories.update');

    ///Vi phạm
        // Route::resource('infringements', InfringementController::class);
        Route::get('infringements', [InfringementController::class, 'index'])->middleware('can:index,App\Models\Admin\Infringement')->name('infringements.index');
        Route::get('infringements/create', [InfringementController::class, 'create'])->middleware('can:create,App\Models\Admin\Infringement')->name('infringements.create');
        Route::post('infringements', [InfringementController::class, 'store'])->middleware('can:create,App\Models\Admin\Infringement')->name('infringements.store');
        Route::get('infringements/{infringement}/edit', [InfringementController::class, 'edit'])->middleware('can:edit,App\Models\Admin\Infringement')->name('infringements.edit');
        Route::put('infringements/{infringement}', [InfringementController::class, 'update'])->middleware('can:edit,App\Models\Admin\Infringement')->name('infringements.update');
        Route::delete('infringements/{infringement}', [InfringementController::class, 'destroy'])->middleware('can:destroy,App\Models\Admin\Infringement')->name('infringements.destroy');

    /// Question routes
        // Route::resource('questions', QuestionController::class);
        Route::get('questions', [QuestionController::class, 'index'])->middleware('can:index,App\Models\Admin\Question')->name('questions.index');
        Route::get('questions/create', [QuestionController::class, 'create'])->middleware('can:create,App\Models\Admin\Question')->name('questions.create');
        Route::post('questions', [QuestionController::class, 'store'])->middleware('can:create,App\Models\Admin\Question')->name('questions.store');
        Route::get('questions/{question}/edit', [QuestionController::class, 'edit'])->middleware('can:edit,App\Models\Admin\Question')->name('questions.edit');
        Route::put('questions/{question}', [QuestionController::class, 'update'])->middleware('can:edit,App\Models\Admin\Question')->name('questions.update');
        Route::delete('questions/{question}', [QuestionController::class, 'destroy'])->middleware('can:destroy,App\Models\Admin\Question')->name('questions.destroy');

    /// Answer routes
        // Route::resource('answers', AnswerController::class);
        Route::get('answers', [AnswerController::class, 'index'])->middleware('can:index,App\Models\Admin\Answer')->name('answers.index');
        Route::get('answers/create', [AnswerController::class, 'create'])->middleware('can:create,App\Models\Admin\Answer')->name('answers.create');
        Route::post('answers', [AnswerController::class, 'store'])->middleware('can:create,App\Models\Admin\Answer')->name('answers.store');
        Route::get('answers/{answer}/edit', [AnswerController::class, 'edit'])->middleware('can:edit,App\Models\Admin\Answer')->name('answers.edit');
        Route::put('answers/{answer}', [AnswerController::class, 'update'])->middleware('can:edit,App\Models\Admin\Answer')->name('answers.update');
        Route::delete('answers/{answer}', [AnswerController::class, 'destroy'])->middleware('can:destroy,App\Models\Admin\Answer')->name('answers.destroy');

        Route::post('answers/{id}/update-view', 'AnswerController@updateViewCount')->name('answers.updateView');

    ///Tài khoản
        // Route::resource('users', UserController::class);
        Route::get('users', [UserController::class, 'index'])->middleware('can:index,App\Models\User')->name('users.index');
        Route::get('users/create', [UserController::class, 'create'])->middleware('can:create,App\Models\User')->name('users.create');
        Route::post('users', [UserController::class, 'store'])->middleware('can:create,App\Models\User')->name('users.store');
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->middleware('can:edit,App\Models\User')->name('users.edit');
        Route::put('users/{user}', [UserController::class, 'update'])->middleware('can:edit,App\Models\User')->name('users.update');
        Route::delete('users/{user}', [UserController::class, 'destroy'])->middleware('can:destroy,App\Models\User')->name('users.destroy');

    ///Vai trò
        // Route::resource('roles', RoleController::class);
        Route::get('roles', [RoleController::class, 'index'])->middleware('can:index,App\Models\Admin\Role')->name('roles.index');
        Route::get('roles/create', [RoleController::class, 'create'])->middleware('can:create,App\Models\Admin\Role')->name('roles.create');
        Route::post('roles', [RoleController::class, 'store'])->middleware('can:create,App\Models\Admin\Role')->name('roles.store');
        Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->middleware('can:edit,App\Models\Admin\Role')->name('roles.edit');
        Route::put('roles/{role}', [RoleController::class, 'update'])->middleware('can:edit,App\Models\Admin\Role')->name('roles.update');
        Route::delete('roles/{role}', [RoleController::class, 'destroy'])->middleware('can:destroy,App\Models\Admin\Role')->name('roles.destroy');

    ///Quyền
        // Route::resource('permissions', PermissionController::class);
        Route::resource('permissions', PermissionController::class)->middleware([
            'create' => 'can:create,App\Models\Admin\Role',
            'store' => 'can:create,App\Models\Admin\Role',
        ]);
        
        //post of category
        Route::get('category/{slug}', [PostController::class, 'index'])->name('categories.posts.index');
        Route::get('category/{category}/posts/create', [PostController::class, 'create'])->name('categories.posts.create');
        Route::post('category/{category}/posts', [PostController::class, 'store'])->name('categories.posts.store');
        Route::get('category/{category}/posts/{post}/edit', [PostController::class, 'edit'])->name('categories.posts.edit');
        Route::put('category/{category}/posts/{post}', [PostController::class, 'update'])->name('categories.posts.update');
        Route::delete('category/{category}/posts/{post}', [PostController::class, 'destroy'])->name('categories.posts.destroy');

        //contact
        Route::resource('contacts', ContactController::class);
        //faq
        Route::resource('faqs', FaqController::class);

        /*
         *  KEEP THESE AT THE END OF THE FILE
         */
        Route::post('tinymce-attachment', TinymceController::class)->name('tinymce.attachment');
    });
});
Route::get('/export-applies', [ExportController::class, 'exportExcel']);
// Route trong file routes/web.php
Route::delete('/admin/users/{media}/delete-media', [UserController::class, 'deleteMedia'])->name('admin.users.delete-media');

//User activity
Route::group([
    'namespace' => 'App\Http\Controllers\Admin',
    'middleware' => config('user-activity.middleware')
], function () {
    Route::get(config('user-activity.route_path'), 'ActivityController@getIndex')->name('user_activity');
    Route::post(config('user-activity.route_path'), 'ActivityController@handlePostRequest');
});

Route::get('/upload', [ImageSearchController::class, 'showUploadForm'])->name('image.upload');
Route::post('/upload', [ImageSearchController::class, 'uploadAndSearch'])->name('image.search');

///Thống kê
Route::get('admin/patents/statistical', [PatentController::class, 'statistical'])->name('admin.patents.statistical');
Route::get('admin/trademarks/statistical', [TrademarkController::class, 'statistical'])->name('admin.trademarks.statistical');
Route::get('admin/geographical_indications/statistical', [GeographicalIndicationController::class, 'statistical'])->name('admin.geographical_indications.statistical');
Route::get('admin/industrial_designs/statistical', [IndustrialDesignController::class, 'statistical'])->name('admin.industrial_designs.statistical');
Route::get('admin/initiatives/statistical', [InitiativeController::class, 'statistical'])->name('admin.initiatives.statistical');
Route::get('admin/products/statistical', [ProductController::class, 'statistical'])->name('admin.products.statistical');
Route::get('admin/technical_innovation_results/statistical', [TechnicalInnovationResultController::class, 'statistical'])->name('admin.technical_innovation_results.statistical');


require __DIR__ . '/auth.php';
