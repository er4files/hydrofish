<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistorySeeder extends Seeder
{
    public function run()
    {
        // Insert data into the history table
        DB::table('history')->insert([
            [
                'timestamp' => '2025-04-23 12:00:00',
                'tds' => 600,
                'turbidity' => 7,
                'ph_air' => 5.2,
                'suhu_air' => 28.5,
                'tinggi_air' => 80,
            ],
            [
                'timestamp' => '2025-04-23 15:00:00',
                'tds' => 450,
                'turbidity' => 3,
                'ph_air' => 7.4,
                'suhu_air' => 27.5,
                'tinggi_air' => 85,
            ],
            [
                'timestamp' => '2025-04-22 18:00:00',
                'tds' => 450,
                'turbidity' => 3,
                'ph_air' => 7.4,
                'suhu_air' => 27.5,
                'tinggi_air' => 85,
            ],
            [
                'timestamp' => '2025-04-22 10:00:00',
                'tds' => 450,
                'turbidity' => 3,
                'ph_air' => 7.4,
                'suhu_air' => 27.5,
                'tinggi_air' => 85,
            ]
        ]);

        // Insert data into the feeding_logs table
        DB::table('feeding_logs')->insert([
            [
                'timestamp' => '2025-04-22 08:00:00',
                'jadwal' => 'Pagi',
                'status' => 'Berhasil',
                'jumlah_pakan' => 150,
            ],
            [
                'timestamp' => '2025-04-22 17:00:00',
                'jadwal' => 'Sore',
                'status' => 'Gagal',
                'jumlah_pakan' => 200,
            ],
            [
                'timestamp' => '2025-04-24 08:00:00',
                'jadwal' => 'Pagi',
                'status' => 'Berhasil',
                'jumlah_pakan' => 150,
            ],
            [
                'timestamp' => '2025-04-24 17:00:00',
                'jadwal' => 'Sore',
                'status' => 'Gagal',
                'jumlah_pakan' => 200,
            ]
        ]);
    }
}
