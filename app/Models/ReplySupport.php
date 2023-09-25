<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected $with = ['user'];

    protected static function booted(): void
    {
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->latest();
        } );
    }

    public function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $createdAt) => Carbon::make($createdAt)->format('d/m/Y H:i')
        );
    }
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
