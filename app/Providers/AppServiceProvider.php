<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\AgentExtraInformation;
use App\Models\AgentSituationAdministrative;
use App\Observers\AgentExtraInformationObserver;
use App\Observers\AgentSituationAdministrativeObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Debugbar', \Barryvdh\Debugbar\Facades\Debugbar::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        AgentExtraInformation::observe(AgentExtraInformationObserver::class);
        AgentSituationAdministrative::observe(AgentSituationAdministrativeObserver::class);
    }
}
