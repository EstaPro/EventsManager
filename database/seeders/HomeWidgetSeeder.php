<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HomeWidget;
use App\Models\HomeWidgetItem;

class HomeWidgetSeeder extends Seeder
{
    public function run()
    {
        // Clear old widgets to avoid duplicates if re-running
        HomeWidget::query()->delete();

        // ---------------------------------------------------------
        // 1. TOP SECTION (Visuals & Main Navigation)
        // ---------------------------------------------------------

        // 1. Main Slider (Hero)
        $slider = HomeWidget::create([
            'title' => 'Main Slider',
            'widget_type' => 'slider',
            'order' => 10,
            'is_active' => true,
        ]);
        // Add sample slides
        HomeWidgetItem::create(['home_widget_id' => $slider->id, 'title' => 'Welcome to HCE 2026', 'subtitle' => 'The leading cleaning expo', 'image' => 'seeds/slider1.jpg', 'order' => 1]);
        HomeWidgetItem::create(['home_widget_id' => $slider->id, 'title' => 'Book Your Stand', 'subtitle' => 'Spaces are limited', 'image' => 'seeds/slider2.jpg', 'order' => 2]);


        // 2. Bannière Sponsor (Single Banner - Middle Ad)
        $banner = HomeWidget::create([
            'title' => 'Sponsor Banner',
            'widget_type' => 'single_banner',
            'order' => 20,
            'is_active' => true,
        ]);
        HomeWidgetItem::create(['home_widget_id' => $banner->id, 'image' => 'seeds/banner_ad.jpg', 'action_url' => 'https://sponsor-link.com']);


        // ---------------------------------------------------------
        // 2. MAIN MENU GRID (Shortcuts)
        // ---------------------------------------------------------
        // This widget contains buttons like "Exhibitors", "Badge", "Plan Trip"

        $menuGrid = HomeWidget::create([
            'title' => 'Quick Menu',
            'widget_type' => 'menu_grid',
            'order' => 30,
            'is_active' => true,
        ]);

        $menuItems = [
            ['title' => 'Exhibitors', 'icon' => 'store', 'action_url' => '/exhibitors'],
            ['title' => 'Products', 'icon' => 'inventory_2', 'action_url' => '/products'],
            ['title' => 'B2B Meeting', 'icon' => 'handshake', 'action_url' => '/appointments'],
            ['title' => 'Networking', 'icon' => 'emoji_events', 'action_url' => '/networking'],
            ['title' => 'HCE Awards', 'icon' => 'emoji_events', 'action_url' => '/awards'],
            ['title' => 'Speakers', 'icon' => 'record_voice_over', 'action_url' => '/speakers'],
            ['title' => 'Conferences', 'icon' => 'event', 'action_url' => '/conferences'],
            ['title' => 'My Badge', 'icon' => 'badge', 'action_url' => '/badge'],
            ['title' => 'Plan Your Trip', 'icon' => 'flight', 'action_url' => '/travel-guide'],
            ['title' => 'Floor Plan', 'icon' => 'map', 'action_url' => '/floor-plan'],
        ];

        foreach ($menuItems as $index => $item) {
            HomeWidgetItem::create([
                'home_widget_id' => $menuGrid->id,
                'title' => $item['title'],
                'icon' => $item['icon'],       // Material Icon Name
                'action_url' => $item['action_url'], // Internal App Route
                'order' => $index + 1
            ]);
        }

        // ---------------------------------------------------------
        // 3. DYNAMIC CONTENT (Teasers)
        // ---------------------------------------------------------

        // Featured Exhibitors (Dynamic List)
        HomeWidget::create([
            'title' => 'Featured Exhibitors',
            'widget_type' => 'dynamic_list',
            'data_source' => 'companies', // Fetches DB automatically
            'order' => 40,
            'is_active' => true,
        ]);

        // New Products (Dynamic List)
        HomeWidget::create([
            'title' => 'Latest Products',
            'widget_type' => 'dynamic_list',
            'data_source' => 'products',
            'order' => 50,
            'is_active' => true,
        ]);


        // ---------------------------------------------------------
        // 4. PARTNERS & LOGOS (Logo Clouds)
        // ---------------------------------------------------------
        // "Ensuite des zones pour logos comme sur références"

        // Institutional Partners
        $instPartners = HomeWidget::create([
            'title' => 'Institutional Partners',
            'widget_type' => 'logo_cloud',
            'order' => 60,
            'is_active' => true,
        ]);
        HomeWidgetItem::create(['home_widget_id' => $instPartners->id, 'image' => 'seeds/partner1.png', 'action_url' => 'https://gov.ma']);
        HomeWidgetItem::create(['home_widget_id' => $instPartners->id, 'image' => 'seeds/partner2.png', 'action_url' => 'https://chamber.ma']);

        // Sponsors
        $sponsors = HomeWidget::create([
            'title' => 'Sponsors',
            'widget_type' => 'logo_cloud',
            'order' => 70,
            'is_active' => true,
        ]);
        HomeWidgetItem::create(['home_widget_id' => $sponsors->id, 'image' => 'seeds/sponsor1.png', 'order' => 1]);
        HomeWidgetItem::create(['home_widget_id' => $sponsors->id, 'image' => 'seeds/sponsor2.png', 'order' => 2]);

        // Media Partners
        HomeWidget::create([
            'title' => 'Media Partners',
            'widget_type' => 'logo_cloud',
            'order' => 80,
            'is_active' => true,
        ]);

        // Exhibition Partners
        HomeWidget::create([
            'title' => 'Exhibition Partners',
            'widget_type' => 'logo_cloud',
            'order' => 90,
            'is_active' => true,
        ]);

        // Trademarks (Marques)
        HomeWidget::create([
            'title' => 'Trademarks',
            'widget_type' => 'logo_cloud',
            'order' => 100,
            'is_active' => true,
        ]);
    }
}
