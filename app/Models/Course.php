<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'short',
        'description',
        'slug',
        'image',
        'latest_price',
        'before_price',
        'public',
        'publish_at',
        'user_id'
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class);
    }
}
