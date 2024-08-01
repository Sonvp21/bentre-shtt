<?php

use App\Http\Middleware\LocalizationMiddleware;
use App\Policies\AdvisorySupportPolicy;
use App\Policies\AnswerPolicy;
use App\Policies\DistrictPolicy;
use App\Policies\GeographicalIndicationPolicy;
use App\Policies\IndustrialDesignPolicy;
use App\Policies\IndustrialDesignTypePolicy;
use App\Policies\InfringementPolicy;
use App\Policies\InitiativeDossierPolicy;
use App\Policies\InitiativeEvaluatePolicy;
use App\Policies\InitiativePolicy;
use App\Policies\PatentPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\ProductPolicy;
use App\Policies\QuestionPolicy;
use App\Policies\RolePolicy;
use App\Policies\TechnicalInnovationCommitteePolicy;
use App\Policies\TechnicalInnovationDossierPolicy;
use App\Policies\TechnicalInnovationResultPolicy;
use App\Policies\TrademarkPolicy;
use App\Policies\TrademarkTypePolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Gate;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            LocalizationMiddleware::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
    
// Đăng ký các policies và gates sau khi tạo ứng dụng
Gate::resource('patents', PatentPolicy::class); //patent-index, patent-create, patent-edit, patent-destroy cho App\Policies\PatentPolicy
// Gate::define('index', 'App\Policies\PatentPolicy@index');
// Gate::define('create', 'App\Policies\PatentPolicy@create');
// Gate::define('edit', 'App\Policies\PatentPolicy@edit');
// Gate::define('destroy', 'App\Policies\PatentPolicy@destroy');
Gate::resource('districts', DistrictPolicy::class);
Gate::resource('communes', PatentPolicy::class);

Gate::resource('trademarks', TrademarkPolicy::class);
Gate::resource('trademark_types', TrademarkTypePolicy::class);

Gate::resource('industrial_design_types', IndustrialDesignTypePolicy::class);
Gate::resource('industrial_designs', IndustrialDesignPolicy::class);

Gate::resource('initiatives', InitiativePolicy::class);
Gate::resource('initiative_dossiers', InitiativeDossierPolicy::class);
Gate::resource('initiative_evaluates', InitiativeEvaluatePolicy::class);

Gate::resource('technical_innovation_dossiers', TechnicalInnovationDossierPolicy::class);
Gate::resource('technical_innovation_committees', TechnicalInnovationCommitteePolicy::class);
Gate::resource('technical_innovation_results', TechnicalInnovationResultPolicy::class);

Gate::resource('geographical_indications', GeographicalIndicationPolicy::class);

Gate::resource('products', ProductPolicy::class);

Gate::resource('advisory_supports', AdvisorySupportPolicy::class);

Gate::resource('infringements', InfringementPolicy::class);

Gate::resource('questions', QuestionPolicy::class);
Gate::resource('answers', AnswerPolicy::class);

Gate::resource('users', UserPolicy::class);
Gate::resource('roles', RolePolicy::class);
Gate::resource('permissions', PermissionPolicy::class);

