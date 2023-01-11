<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Reseller extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use HasRoles;

    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name',
    'company_name',
        'nice_name', 'token', 'charge',
        'national_id', 'email', 'mobile', 'phone',
        'profile_image', 'background_image', 'default_language', 'password',
        'last_ip', 'last_login_at', 'activated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'reseller_id', 'id');
    }

    public function regions()
    {
        return $this->hasMany(Region::class, 'reseller_id', 'id');
    }
}
