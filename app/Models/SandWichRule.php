<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SandWichRule extends Model
{
    use HasFactory;
      use HasFactory;
     protected $fillable = ['date','status','assigned_by'];

      public function user(){
        return $this->hasOne (User::class, 'id', 'assigned_by');
    }
}
