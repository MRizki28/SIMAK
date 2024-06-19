<?php

namespace Database\Seeders;

use App\Models\PositionModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $position = [
            'Lurah',
            'Seketaris',
            'Staf Seketaris',
            'Kasi Pemerintahan, Ketentraman dan Ketertiban Umum',
            'Staf Kasi Pemerintahan, Ketentraman dan Ketertiban Umum',
            'Kasi Ekonomi dan Pembangunan',
            'Staf Kasi Ekonomi dan Pembangunan',
            'Kasi Pemberdayaan Masyarakat dan kesejahteraan sosial',
            'Staf Kasi Pemberdayaan Masyarakat dan kesejahteraan sosial',

        ];

        foreach ($position as $pos) {
            PositionModel::create(['position' => $pos]);
        }

        echo "success create seed position";
    }
}
