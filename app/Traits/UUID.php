<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Str;  


trait UUID
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            try {
                $model->id = (string) Str::uuid(); // generate uuid
                // Change id with your primary key
            } catch (Exception $e) {
                abort(500, $e->getMessage());
            }
        });
    }
}
