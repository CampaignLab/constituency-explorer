<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;
use RyanChandler\BunnyFonts\Facades\BunnyFonts;
use RyanChandler\BunnyFonts\FontFamily;

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
        Builder::macro('search', function ($field, $string) {
            return $string ? $this->where($field, 'like', '%' . $string . '%') : $this;
        });

        BunnyFonts::default()
            ->add(FontFamily::Inter, [400, 500, 600, 700]);
    }
}
