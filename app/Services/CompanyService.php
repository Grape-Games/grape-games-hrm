<?php

namespace App\Services;

use App\Models\Department;

class CompanyService
{
    public static function saveDepartmentTypes($types, $companyId)
    {
        Department::where('company_id', $companyId)->delete();
        foreach ($types as $type) {
            Department::create([
                'company_id' => $companyId,
                'department_type_id' => $type
            ]);
        }
    }
}
