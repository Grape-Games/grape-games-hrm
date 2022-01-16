<?php

namespace App\Services;

use App\Models\Department;

class CompanyService
{
    public static function saveDepartmentTypes($types, $companyId)
    {
        foreach ($types as $type) {
            Department::create([
                'company_id' => $companyId,
                'department_type_id' => $type
            ]);
        }
    }
}
