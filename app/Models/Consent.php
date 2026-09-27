<?php

namespace App\Models;

use Database\Factories\ConsentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consent extends Model
{
    /** @use HasFactory<ConsentFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['user_id', 'type', 'document_version', 'fields', 'ip', 'user_agent', 'given_at', 'withdrawn_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'fields' => 'array',
            'given_at' => 'datetime',
            'withdrawn_at' => 'datetime',
        ];
    }
}
