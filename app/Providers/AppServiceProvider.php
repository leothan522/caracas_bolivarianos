<?php

namespace App\Providers;

use Filament\Http\Responses\Auth\Contracts\LogoutResponse;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(LogoutResponse::class, \App\Http\Responses\LogoutResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Customizing the asset URL Livewire's
        if (config('app.livewire')){
            Livewire::setUpdateRoute(function ($handle) {
                return Route::post('/'.config('app.livewire').'/livewire/update', $handle)->name('assetlivewire.update');
            });

            Livewire::setScriptRoute(function ($handle) {
                return Route::get('/'.config('app.livewire').'/livewire/livewire.js', $handle);
            });
        }
    }
}
