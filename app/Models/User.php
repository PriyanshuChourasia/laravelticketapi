<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Str;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'phoneNumber',
        'username',
        'email',
        'password',
        'user_type_id'
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

    /**
     * Jwt Auth function needs to be implemented as per documented in PHPOpensource documentation
     *
     * @return void
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * keyType
     *
     * @var string
     *
     * This is keyType variable value is set to string. This tells model that we are not going to use integer as id.
     * This also tells model that the key is a type of string
     *
     */
    protected $keyType = 'string';

    /**
     * incrementing
     *
     * @var boolean
     *
     * This will tell model to stop incrementing this uuid value.
     */
    public $incrementing = false;


    // But will face an error while creating new record. To solve this issue you have to define a UUID each time you create a new record

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }


    public function user_types()
    {
        return $this->belongsTo(UserType::class, 'user_type_id', 'id');
    }
}
