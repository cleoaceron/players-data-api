<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Players\PlayersInterface;
use App\Services\Players\PlayersService;

class PlayersServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PlayersInterface::class, PlayersService::class);
    }
}