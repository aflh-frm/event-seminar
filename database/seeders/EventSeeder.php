<?php

namespace Database\Seeders;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan User ID 2 (EO) ada, sesuai data di file SQL kamu
        $eoId = 2;

        $events = [
            [
                'title' => 'Workshop UI/UX Design 2025',
                'description' => 'Pelajari cara membuat desain aplikasi yang user-friendly langsung dari expert Google. Materi mencakup Wireframing, Prototyping, hingga Usability Testing.',
                'event_date' => Carbon::now()->addDays(10), // 10 hari lagi
                'location' => 'Zoom Meeting',
                'quota' => 50,
                'price' => 150000,
                'category_id' => 1, // Teknologi
                'user_id' => $eoId,
                'status' => 'published',
                'banner' => null, // Biarkan null, nanti pakai placeholder default di view
            ],
            [
                'title' => 'Strategi Digital Marketing UMKM',
                'description' => 'Bagaimana cara meningkatkan omset penjualan menggunakan Facebook & Instagram Ads dengan budget minim.',
                'event_date' => Carbon::now()->addDays(5),
                'location' => 'Hotel Pangeran Pekanbaru',
                'quota' => 100,
                'price' => 75000,
                'category_id' => 2, // Bisnis
                'user_id' => $eoId,
                'status' => 'published',
                'banner' => null,
            ],
            [
                'title' => 'Webinar Mental Health: Stress Management',
                'description' => 'Menjaga kesehatan mental di lingkungan kerja yang toxic. Sesi tanya jawab bersama Psikolog klinis.',
                'event_date' => Carbon::now()->addDays(15),
                'location' => 'Google Meet',
                'quota' => 200,
                'price' => 0, // GRATIS
                'category_id' => 4, // Kesehatan
                'user_id' => $eoId,
                'status' => 'published',
                'banner' => null,
            ],
            [
                'title' => 'Konser Amal: Suara untuk Negeri',
                'description' => 'Konser musik penggalangan dana yang dimeriahkan oleh artis-artis papan atas ibukota.',
                'event_date' => Carbon::now()->addDays(20),
                'location' => 'Stadion Utama Riau',
                'quota' => 1000,
                'price' => 50000,
                'category_id' => 6, // Musik
                'user_id' => $eoId,
                'status' => 'published',
                'banner' => null,
            ],
            [
                'title' => 'Bootcamp Fullstack Laravel 11',
                'description' => 'Intensive coding bootcamp selama 3 hari. Membangun aplikasi Event Organizer dari nol sampai deploy.',
                'event_date' => Carbon::now()->addDays(30),
                'location' => 'Lab Komputer PCR',
                'quota' => 30,
                'price' => 500000,
                'category_id' => 5, // Pendidikan
                'user_id' => $eoId,
                'status' => 'draft', // Status draft (tidak muncul di depan)
                'banner' => null,
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}