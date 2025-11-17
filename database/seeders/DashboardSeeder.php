<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DashboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dashboards')->insert([
            [
                'report_code' => 1,
                'title' => 'Jalan Berlubang',
                'description' => 'Jalan berlubang dengan ukuran diameter kurang lebih 25cm, mohon untuk segera ditindaklanjuti.',
                'location' => 'Jl. Nangka (depan pos ronda)',
                'photo' => null,
                'contact' => '08884007485',
                'status' => 'terkirim'
            ],
        ]);
    }
}
