<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;

class UserProfile extends Model
{
    
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title_name',
        'first_name',
        'last_name',
        'address',
        'zip_code',
        'tel_phone',
        'birth_day'
    ];

    public function userProfiles(): HasOne {
        return $this->hasOne(UserProfile::class);
    }

}
