<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Brew extends Model
{
    /** @use HasFactory<\Database\Factories\BrewFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'brewed_at' => 'datetime',
            'dose_grams' => 'decimal:2',
            'yield_grams' => 'decimal:2',
            'water_temp_c' => 'decimal:2',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bean(): BelongsTo
    {
        return $this->belongsTo(Bean::class);
    }
}
