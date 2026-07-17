<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'papandayan_id', 'type' => 'text'],
            ['key' => 'contact_whatsapp', 'value' => '+62 812-3456-7890', 'type' => 'text'],
            ['key' => 'contact_email', 'value' => 'info@papandayan.id', 'type' => 'text'],
            ['key' => 'contact_address', 'value' => 'Basecamp Gn. Papandayan, Garut, Jawa Barat', 'type' => 'textarea'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/papandayan_id', 'type' => 'url'],
            ['key' => 'about_title', 'value' => 'Tentang papandayan_id', 'type' => 'text'],
            ['key' => 'about_description', 'value' => 'papandayan_id adalah penyedia layanan operator trip resmi dan terpercaya untuk kawasan Gunung Papandayan. Berawal dari kecintaan terhadap alam Garut, kami hadir untuk memastikan pengalaman pendakian Anda aman, nyaman, dan meninggalkan memori indah.', 'type' => 'textarea'],
            ['key' => 'about_image', 'value' => 'https://images.unsplash.com/photo-1522163182402-834f871fd851?q=80&w=1000&auto=format&fit=crop', 'type' => 'image'],
            ['key' => 'vision_description', 'value' => 'Menjadi operator wisata alam terkemuka di Jawa Barat yang mengedepankan kelestarian lingkungan, keselamatan pengunjung, dan pemberdayaan masyarakat lokal.', 'type' => 'textarea'],
            ['key' => 'mission_description', 'value' => '<ul><li>Menyediakan layanan pendakian dengan standar keamanan (SOP) yang ketat.</li><li>Memberikan fasilitas premium untuk menjamin kenyamanan klien.</li><li>Mengedukasi pendaki tentang pentingnya menjaga kebersihan ekosistem Gunung Papandayan.</li></ul>', 'type' => 'textarea'],
            ['key' => 'footer_description', 'value' => 'Penyedia layanan open trip, private trip, dan pemandu profesional bersertifikat untuk petualangan Anda di Gunung Papandayan. Keselamatan dan kenyamanan Anda adalah prioritas utama kami.', 'type' => 'textarea'],
        ];

        foreach ($settings as $setting) {
            \App\Models\Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
