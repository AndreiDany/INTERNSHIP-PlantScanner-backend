<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pin extends Model
{
    use HasFactory;

    protected $primary_key = [
        'id'
    ];

    protected $fillable = [
        'user_id',
        'pin',
    ];
}