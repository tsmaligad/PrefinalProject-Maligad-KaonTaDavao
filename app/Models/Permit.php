<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Permit extends Model
{
    use HasFactory;

    protected $fillable = [
        'eatery_id',
        'permit_no',
        'expires_on',
    ];

    protected function casts(): array
    {
        return [
            'expires_on' => 'date',
        ];
    }

    public function eatery(): BelongsTo
    {
        return $this->belongsTo(Eatery::class);
    }
}
