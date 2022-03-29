<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evalutation extends Model
{
    use HasFactory;
    protected $fillable = [
        'performance',
        'points',
        'behaviour'
    ];
}
