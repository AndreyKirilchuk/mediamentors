<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class portfolios extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'info',
        'type',
        'author',
        'direction_id'
    ];
}
