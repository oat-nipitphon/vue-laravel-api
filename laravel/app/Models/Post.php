<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasApiTokens, HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'body',
        'created_at',
        'updated_at'
    ];


  
    /**
     * Get the user that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    // BelongsTo 1 คน สามารภมีได้หลาย โพส
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function photoPost(): HasOne
    {
        return $this->hasOne(PhotoPost::class);
    }

}
