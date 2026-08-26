<?php

use App\Providers\AppServiceProvider;
use App\Providers\Filament\AdminPanelProvider;
use App\Providers\HorizonServiceProvider;
use App\Providers\TelescopeServiceProvider;
use App\Providers\VoltServiceProvider;

return [
    AppServiceProvider::class,
    AdminPanelProvider::class,
    HorizonServiceProvider::class,
    TelescopeServiceProvider::class,
    VoltServiceProvider::class,
];
