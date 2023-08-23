<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReplySupport extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'content',
        'support_id',
        'user_id',
    ];
    protected $table = 'replies_supports';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function Support(): BelongsTo
    {
        return $this->belongsTo(Support::class);
    }
}
