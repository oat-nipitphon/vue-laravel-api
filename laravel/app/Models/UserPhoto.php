<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;

class UserPhoto extends Model
{
    use HasApiTokens;
    protected $fillable = [
        'id',
        'user_id',
        'photo_path',
        'photo_name',
        'photo_data'
    ];

    public function user () :HasOne {
        return $this->hasOne(User::class);
    }

}
