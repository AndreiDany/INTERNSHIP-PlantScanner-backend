<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    use HasFactory;

    protected $primary_key = [
        'id'
    ];

    protected $fillable = [
        'name',
        'user_id',
    ];
}