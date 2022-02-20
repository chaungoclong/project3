<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $props = ['checked', 'selected', 'actived'];

        foreach ($props as $prop) {
            Blade::directive($prop, function($value) use($prop) {
                return "<?php if($value) echo '$prop'; ?>";
            });
        }
    }
}
