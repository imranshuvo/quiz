<?php

namespace App\Models;

use App\Models\Concerns\BelongsToWorkspace;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebhookDelivery extends Model
{
    use BelongsToWorkspace;
    use HasFactory;

    protected $fillable = [
        'workspace_id',
        'webhook_endpoint_id',
        'response_id',
        'status',
        'attempts',
        'http_status',
        'last_error',
        'delivered_at',
    ];

    protected $casts = [
        'attempts' => 'integer',
        'http_status' => 'integer',
        'delivered_at' => 'datetime',
    ];

    public function endpoint(): BelongsTo
    {
        return $this->belongsTo(WebhookEndpoint::class, 'webhook_endpoint_id');
    }

    public function response(): BelongsTo
    {
        return $this->belongsTo(Response::class);
    }
}
