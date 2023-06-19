<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanInstallment extends Model
{
    use HasFactory,
        Cachable;

    protected $fillable = [
        'loan_id',
        'amount',
        'date',
        'status',
        'created_at'
    ];
    public function loan()
    {
        return $this->belongTo(Loan::class);
    }
}
