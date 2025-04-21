<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'purpose',
        'visit_datetime',
        'left'
    ];

    protected $casts = [
        'visit_datetime' => 'datetime',
        'left' => 'boolean'
    ];
}
