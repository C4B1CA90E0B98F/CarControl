<?php

namespace Database\Seeders;

use App\Models\Approval;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApprovalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Approval::factory()->count(5)->create();
    }
}
