<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Region extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reseller_id',
        'title',

    ];

    public function users()
    {
        return $this->hasMany(User::class, 'region_id', 'id');
    }

    public function reseller()
    {
        return $this->belongsTo(Reseller::class, 'reseller_id', 'id');
    }
}
