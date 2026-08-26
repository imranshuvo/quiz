<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('user:admin {email} {--revoke : Remove staff access}', function () {
    $user = User::where('email', $this->argument('email'))->firstOrFail();
    $user->forceFill(['is_admin' => ! $this->option('revoke')])->save();

    $this->info($this->option('revoke') ? 'Staff access removed.' : 'Staff access granted.');
})->purpose('Grant or revoke access to the internal Filament admin panel');

Schedule::command('activitylog:clean')->monthly();
