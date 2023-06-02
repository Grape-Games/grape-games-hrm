<?php

namespace App\Traits;

use App\Models\AssignedCompany;

trait RestrictTrait
{
    public function getCurrentUserCompaniesArray()
    {
        return AssignedCompany::where('user_id', auth()->id())->whereNotNull('company_id')->pluck('company_id')->toArray();
    }
}
