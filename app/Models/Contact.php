<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'nice_name',
        'email',
        'user_id',
        // 'national_id',
        'mobile',
        'phone',
        'profile_image',
        'background_image',
        'activated_at',
        'region_id',
        'local_phone',
        'position',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }
}
