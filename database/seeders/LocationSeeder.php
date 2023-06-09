<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            [
                'name' => 'Kantor Pusat',
                'address' => 'Jl. Maninjau Raya No.44, Sawojajar, Kec. Kedungkandang, Kota Malang, Jawa Timur 65139'
            ],
            [
                'name' => 'Kantor Cabang',
                'address' => 'Jl. Maninjau Raya No.44, Sawojajar, Kec. Kedungkandang, Kota Malang, Jawa Timur 65139'
            ],
            [
                'name' => 'Tambang 1',
                'address' => 'Alamat A Tambang 1'
            ],
            [
                'name' => 'Tambang 2',
                'address' => 'Alamat B Tambang 2'
            ],
            [
                'name' => 'Tambang 3',
                'address' => 'Alamat C Tambang 3'
            ],
            [
                'name' => 'Tambang 4',
                'address' => 'Alamat D Tambang 4'
            ],
            [
                'name' => 'Tambang 5',
                'address' => 'Alamat E Tambang 5'
            ],
            [
                'name' => 'Tambang 6',
                'address' => 'Alamat F Tambang 6'
            ]
        ];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}
