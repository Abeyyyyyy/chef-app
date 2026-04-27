<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pantry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'category',
        'quantity',
        'unit',
        'status',
    ];

    /**
     * Get the user that owns the pantry item.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
