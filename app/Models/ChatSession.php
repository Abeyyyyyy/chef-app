<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ChatSession extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'title',
        'is_bookmarked',
        'pantry_context',
        'last_active_at',
    ];

    protected function casts(): array
    {
        return [
            'is_bookmarked' => 'boolean',
            'last_active_at' => 'datetime',
        ];
    }

    /**
     * Get the user that owns the chat session.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all messages in this session.
     */
    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class, 'session_id');
    }

    /**
     * Get the latest message in this session.
     */
    public function latestMessage()
    {
        return $this->hasOne(ChatMessage::class, 'session_id')->latestOfMany();
    }
}
