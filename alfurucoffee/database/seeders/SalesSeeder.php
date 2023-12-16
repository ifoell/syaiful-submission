<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sales;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insert =
        [
            [
                'employee_id' => '1',
                'sales' => 15000
            ],
            [
                'employee_id' => '2',
                'sales' => 12000
            ],
            [
                'employee_id' => '3',
                'sales' => 18000
            ],
            [
                'employee_id' => '1',
                'sales' => 20000
            ],
            [
                'employee_id' => '4',
                'sales' => 22000
            ],
            [
                'employee_id' => '5',
                'sales' => 19000
            ],
            [
                'employee_id' => '6',
                'sales' => 13000
            ],
            [
                'employee_id' => '2',
                'sales' => 14000
            ]
        ];

        Sales::insert($insert);
    }
}
