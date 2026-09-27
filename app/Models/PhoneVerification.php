<?php

namespace App\Models;

use Database\Factories\PhoneVerificationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneVerification extends Model
{
    /** @use HasFactory<PhoneVerificationFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['phone', 'code_hash', 'attempts', 'expires_at', 'ip', 'created_at'];

    protected function casts(): array
    {
        return [
            'attempts' => 'integer',
            'expires_at' => 'datetime',
            'created_at' => 'datetime',
        ];
    }
}
