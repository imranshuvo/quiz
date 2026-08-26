<?php

namespace App\Models\Concerns;

use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

trait LogsWorkspaceActivity
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        $sensitive = ['secret', 'token', 'password', 'password_hash', 'remember_token'];
        $attributes = array_values(array_diff($this->getFillable(), $sensitive));

        return LogOptions::defaults()
            ->useLogName('workspace')
            ->logOnly($attributes)
            ->logOnlyDirty()
            ->dontLogEmptyChanges();
    }
}
