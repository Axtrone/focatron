<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use TeamNameGenerator\FakerProvider;

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
    {   /*
        $faker = $this->app->make(Faker\Generator::class);*/
        fake()->addProvider(new FakerProvider(fake()));
    }
}
