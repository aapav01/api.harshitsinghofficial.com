<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'title',
        'description',
        'thumbUrl',
        'length',
        'url',
        'status',
        'platform',
        'public',
        'user_id',
        'chapter_id'
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }
}
