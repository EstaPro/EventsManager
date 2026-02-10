<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeSection;
use App\Constants\AppSections;

class HomeSectionSeeder extends Seeder
{
    public function run()
    {
        // Clear existing to avoid duplicates if running multiple times
        HomeSection::truncate();

        $sections = [
            // 1. HEADER
            [
                'key' => AppSections::MAIN_SLIDER,
                'title' => 'Welcome to Sahara Summit',
                'order' => 10,
                'bg_color' => '#000000'
            ],
            [
                'key' => AppSections::SPONSOR_BANNER,
                'title' => 'Headline Sponsor',
                'order' => 20,
                'bg_color' => '#FFFFFF'
            ],

            // 2. CORE NAVIGATION TILES (The Grid)
            [
                'key' => AppSections::EXHIBITORS,
                'title' => 'Exhibitors',
                'order' => 30,
                'bg_color' => '#0F2624' // Dark Green
            ],
            [
                'key' => AppSections::PRODUCTS,
                'title' => 'Exhibitor Products',
                'order' => 40,
                'bg_color' => '#1E3A8A' // Deep Blue
            ],
            [
                'key' => AppSections::B2B_MEETING,
                'title' => 'B2B Matchmaking',
                'order' => 50,
                'bg_color' => '#2C3E50' // Dark Grey
            ],
            [
                'key' => AppSections::AWARDS,
                'title' => 'HCE Cleaning Awards',
                'order' => 60,
                'bg_color' => '#D35400' // Orange
            ],
            [
                'key' => AppSections::SPONSORS_PARTNERS,
                'title' => 'Sponsors & Partners',
                'order' => 70,
                'bg_color' => '#FFFFFF'
            ],
            [
                'key' => AppSections::MESSAGERIE_INBOX,
                'title' => ' Messagerie / Inbox Tile',
                'order' => 70,
                'bg_color' => '#FFFFFF'
            ],
            [
                'key' => AppSections::SPEAKERS,
                'title' => 'Keynote Speakers',
                'order' => 80,
                'bg_color' => '#C0392B' // Red
            ],
            [
                'key' => AppSections::CONFERENCES,
                'title' => 'Conference Agenda',
                'order' => 90,
                'bg_color' => '#2980B9' // Blue
            ],
            [
                'key' => AppSections::BADGE,
                'title' => 'My E-Badge',
                'order' => 100,
                'bg_color' => '#16A085' // Teal
            ],
            [
                'key' => AppSections::PLAN_TRIP,
                'title' => 'Plan Your Trip',
                'order' => 110,
                'bg_color' => '#8E44AD' // Purple
            ],
            [
                'key' => AppSections::FLOOR_PLAN,
                'title' => 'Venue Map',
                'order' => 120,
                'bg_color' => '#34495E'
            ],

            // 3. FOOTER LOGO LISTS
            [
                'key' => AppSections::INSTITUTIONAL_PARTNERS,
                'title' => 'Institutional Partners',
                'order' => 130,
                'bg_color' => '#F8F9FA'
            ],
            [
                'key' => AppSections::MEDIA_PARTNERS,
                'title' => 'Media Partners',
                'order' => 140,
                'bg_color' => '#F8F9FA'
            ],
            [
                'key' => AppSections::EXHIBITIONS_PARTNERS,
                'title' => 'Exhibition Partners',
                'order' => 150,
                'bg_color' => '#F8F9FA'
            ],
            [
                'key' => AppSections::TRADEMARKS,
                'title' => 'Trademarks',
                'order' => 160,
                'bg_color' => '#FFFFFF'
            ],
        ];

        foreach ($sections as $s) {
            HomeSection::create([
                'section_key' => $s['key'],
                'title' => $s['title'],
                'order' => $s['order'],
                'background_color' => $s['bg_color'],
                'is_active' => true,
                // You can add default images here if you have them in storage
                // 'background_image' => 'sections/default_' . $s['key'] . '.jpg'
            ]);
        }
    }
}
