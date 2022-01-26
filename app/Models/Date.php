<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'year',
        '_1',
        '_2',
        '_3',
        '_4',
        '_5',
        '_6',
        '_7',
        '_8',
        '_9',
        '_10',
        '_11',
        '_12',
    ];
}
