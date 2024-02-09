<?php

namespace Database\Seeders;

use App\Models\YearModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class YearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected $yearModel;

    public function __construct(YearModel $yearModel)
    {
        $this->yearModel = $yearModel;
    }
    
    public function run(): void
    {
        for ($year= 2024 ; $year <= 2028 ; $year++) { 
            $this->yearModel::create([
                'id' => Str::uuid(),
                'year' => (string)$year
            ]);
        }
    }
}
