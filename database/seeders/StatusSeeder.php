<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            'name' => 'incomplete',
            'color' => '#4338CA',
        ]);
        DB::table('statuses')->insert([
            'name' => 'in-progress',
            'color' => '#2563EB',
        ]);
        DB::table('statuses')->insert([
            'name' => 'completed',
            'color' => '#059669',
        ]);
    }
}
