<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatMessage extends Model
{
    protected $fillable = [
        'session_id',
        'sender_role',
        'content',
        'recipe_data',
    ];

    protected function casts(): array
    {
        return [
            'recipe_data' => 'array',
        ];
    }

    /**
     * Get the session this message belongs to.
     */
    public function session(): BelongsTo
    {
        return $this->belongsTo(ChatSession::class, 'session_id');
    }
}
