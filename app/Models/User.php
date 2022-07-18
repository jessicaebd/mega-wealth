<?php

namespace App\Models;


use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ['id'];
    public $incrementing = false;

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'role_id',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
     */

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class)
            ->withPivot('add_date');
    }
}
