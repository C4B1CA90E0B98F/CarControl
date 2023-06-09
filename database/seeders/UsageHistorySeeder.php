<?php

namespace Database\Seeders;

use App\Models\UsageHistory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsageHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UsageHistory::factory()->count(10)->create();
    }
}
