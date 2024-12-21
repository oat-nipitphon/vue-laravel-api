<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PhotoPost extends Model
{
    /** @use HasFactory<\Database\Factories\PhotoPostFactory> */
    use HasFactory;

    protected $fillable = [
        'post_id',
        'name',
        'path',
        'data',
        'created_at',
        'updated_at'
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

}
