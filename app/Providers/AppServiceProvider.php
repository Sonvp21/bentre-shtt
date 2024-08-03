<?php

namespace App\Providers;

use App\Models\Admin\IndustrialDesign;
use App\Models\Admin\IndustrialDesignType;
use App\Models\Admin\Initiative;
use App\Models\Admin\InitiativeDossier;
use App\Models\Admin\InitiativeEvaluate;
use App\Models\Admin\Patent;
use App\Models\Admin\Product;
use App\Models\Admin\Trademark;
use App\Models\Admin\TrademarkType;
use App\Observers\IndustrialDesignTypeObserver;
use App\Observers\InitiativeDossierObserver;
use App\Observers\InitiativeEvaluateObserver;
use App\Observers\InitiativeObserver;
use App\Observers\PatentObserver;
use App\Observers\ProductObserver;
use App\Observers\TrademarkObserver;
use App\Observers\TrademarkTypeObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Patent::observe(PatentObserver::class);
        TrademarkType::observe(TrademarkTypeObserver::class);
        Trademark::observe(TrademarkObserver::class);
        IndustrialDesignType::observe(IndustrialDesignTypeObserver::class);
        Initiative::observe(InitiativeObserver::class);
        InitiativeDossier::observe(InitiativeDossierObserver::class);
        InitiativeEvaluate::observe(InitiativeEvaluateObserver::class);
        Product::observe(ProductObserver::class);
    }
}
