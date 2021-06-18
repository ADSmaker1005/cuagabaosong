<?php

namespace App\Providers;
use App\Http\View\Composers\PartialsComposer;
use App\Http\View\Composers\ThemesComposer;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            ['themes.*'],ThemesComposer::class
        );
        view()->composer(
            ['themes.partials.*'],PartialsComposer::class
        );
    }
}
