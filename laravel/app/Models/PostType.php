<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PostType extends Model
{
    protected $fillable = [
        'id',
        'type_name',
        'type_img_path',
        'type_img_name',
        'type_img_data',
        'created_at',
        'updated_at'
    ];

    public function post(): HasOne {
        return $this->hasOne(Post::class);
    }

}
