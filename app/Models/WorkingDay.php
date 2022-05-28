<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingDay extends Model
{
    use HasFactory;

    // protected $dates = ['date'];

    protected $appends = [
        'custom_date',
    ];

    protected $fillable = [
        'reason',
        'date'
    ];
    
    
    public function getCustomDateAttribute()
    {
        return Carbon::parse($this->date)->format('l Y-M-d');
    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }
}
