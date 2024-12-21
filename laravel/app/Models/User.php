<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    // Polymorphic Relationships :: https://laravel.com/docs/11.x/eloquent-relationships
    
    // One to One $this->hasOne use model 1 - 1
    // One to Many $this->hasMany use model 1 - N
    // One of Many $this->belongsTo use model M - 1
    
    // Many to Many $this->hasManyThrough use model N-M or M-M 
    // 
    // use Illuminate\Database\Eloquent\Relations\HasManyThrough;
    // public function deployments(): HasManyThrough
    // {
    //     return $this->hasManyThrough(Deployment::class, Environment::class);
    // }
    

        /**
     * Get the user that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    //  hasMany 1 คน สามารถมีได้ มากกว่า 1 โพส
    public function posts(): hasMany
    {
        return $this->hasMany(Post::class);
    }

}
