<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\hasMany;

class UserPhoto extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'photo_path',
        'photo_name',
        'photo_data'
    ];

    public function user () :BelongsTo {
        return $this->BelongsTo(User::class);
    }

}
