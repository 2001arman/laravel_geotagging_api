<?php

namespace Database\Seeders;

use App\Models\Holiday;
use Illuminate\Database\Seeder;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $holidays = [
            ['tanggal' => '2024-01-01', 'nama' => 'New Year\'s Day (Tahun Baru)'],
            ['tanggal' => '2024-03-09', 'nama' => 'Hari Raya Nyepi (Balinese Day of Silence)'],
            ['tanggal' => '2024-04-05', 'nama' => 'Good Friday (Jumat Agung)'],
            ['tanggal' => '2024-05-01', 'nama' => 'Labor Day (Hari Buruh Internasional)'],
            ['tanggal' => '2024-05-24', 'nama' => 'Eid al-Fitr (Hari Raya Idul Fitri)'],
            ['tanggal' => '2024-05-25', 'nama' => 'Eid al-Fitr Holiday'],
            ['tanggal' => '2024-05-30', 'nama' => 'Ascension of Jesus Christ (Kenaikan Isa Almasih)'],
            ['tanggal' => '2024-06-01', 'nama' => 'Pancasila Day (Hari Lahir Pancasila)'],
            ['tanggal' => '2024-06-12', 'nama' => 'Eid al-Adha (Hari Raya Idul Adha)'],
            ['tanggal' => '2024-08-17', 'nama' => 'Independence Day (Hari Kemerdekaan Republik Indonesia)'],
            ['tanggal' => '2024-08-31', 'nama' => 'Islamic New Year (Tahun Baru Hijriyah)'],
            ['tanggal' => '2024-12-25', 'nama' => 'Christmas Day (Hari Natal)'],
        ];

        foreach ($holidays as $holiday) {
            Holiday::create($holiday);
        }
    }
}
