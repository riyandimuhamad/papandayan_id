<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroSlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slides = [
            [
                'image' => 'https://images.unsplash.com/photo-1542308111-e63ccce11666?q=80&w=1920&auto=format&fit=crop',
                'title' => 'Taklukkan Puncak Impian',
                'subtitle' => 'Jelajahi keindahan kawah, hutan mati, dan padang edelweis bersama tim profesional kami.',
                'order' => 1,
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1551632811-561732d1e306?q=80&w=1920&auto=format&fit=crop',
                'title' => 'Pengalaman Tak Terlupakan',
                'subtitle' => 'Fasilitas premium, aman, dan nyaman. Cocok untuk pendaki pemula maupun profesional.',
                'order' => 2,
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1519904981063-b0cf448d479e?q=80&w=1920&auto=format&fit=crop',
                'title' => 'Sunrise Terbaik di Garut',
                'subtitle' => 'Saksikan keindahan matahari terbit dari ketinggian 2665 MDPL.',
                'order' => 3,
            ]
        ];

        foreach ($slides as $slide) {
            \App\Models\HeroSlide::create($slide);
        }
    }
}
