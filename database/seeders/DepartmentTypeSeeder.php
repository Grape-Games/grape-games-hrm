<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'name' => 'Apps & Games',
                'owner_id' => 1
            ],
            [
                'name' => 'Web Development',
                'owner_id' => 1
            ]
        ];
        DB::table('department_types')->insert($types);
    }
}
