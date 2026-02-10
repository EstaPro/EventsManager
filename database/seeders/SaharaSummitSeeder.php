<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Orchid\Platform\Models\Role;

// Models
use App\Models\EventSetting;
use App\Models\Company;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Conference;
use App\Models\Speaker;
use App\Models\Sponsor;
use App\Models\Appointment;
use App\Models\Connection;
use App\Models\AwardCategory;
use App\Models\AwardNominee;
use App\Models\Notification;

class SaharaSummitSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $this->command->info('🧹 Cleaning database...');
        Schema::disableForeignKeyConstraints();

        Notification::truncate();
        DB::table('notifications')->truncate();
        Appointment::truncate();
        Connection::truncate();
        AwardNominee::truncate();
        AwardCategory::truncate();
        Sponsor::truncate();
        DB::table('conference_registrations')->truncate();
        DB::table('conference_speaker')->truncate();
        Conference::truncate();
        Speaker::truncate();
        Product::truncate();
        ProductCategory::truncate();
        User::truncate();
        Company::truncate();
        EventSetting::truncate();

        Schema::enableForeignKeyConstraints();

        $this->createRoles();

        // --------------------------------------------------
        // EVENT SETTINGS
        // --------------------------------------------------
        EventSetting::create([
            'event_name' => 'Sahara Tech Summit 2026',
            'description' => 'The largest technology and innovation event in Africa.',
            'start_date' => '2026-11-20 09:00:00',
            'end_date' => '2026-11-22 18:00:00',
            'location_name' => 'Palais des Congrès',
            'location_address' => 'Avenue Mohammed VI, Marrakech, Morocco',
            'opening_hour' => '09:00',
            'closing_hour' => '18:00',
            'meeting_duration_minutes' => 30,
        ]);

        // --------------------------------------------------
        // PRODUCT CATEGORIES (ONCE)
        // --------------------------------------------------
        $this->command->info('📦 Creating Product Categories...');

        $categoryNames = [
            'Software Solutions',
            'Cloud Services',
            'Artificial Intelligence',
            'Cybersecurity',
            'Fintech Systems',
            'IoT Platforms',
            'Data Analytics',
        ];

        $productCategoryIds = [];

        foreach ($categoryNames as $name) {
            $cat = ProductCategory::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
            $productCategoryIds[] = $cat->id;
        }

        // --------------------------------------------------
        // COMPANIES (EXHIBITORS)
        // --------------------------------------------------
        $this->command->info('🏢 Creating Exhibitors...');

        $companiesData = [
            ['Orange Maroc', 'Telecom', 'Morocco'],
            ['Microsoft Africa', 'Cloud', 'USA'],
            ['OCP Group', 'Industry', 'Morocco'],
            ['Huawei', 'Telecom', 'China'],
            ['Salesforce', 'Software', 'USA'],
            ['HPS Worldwide', 'Fintech', 'Morocco'],
        ];

        $companyIds = [];
        $exhibitorUserIds = [];
        $roleExhibitor = Role::where('slug', 'exhibitor')->first();

        // Arabic names (latin)
        $arabicFirstNames = ['Ahmed', 'Youssef', 'Mehdi', 'Omar', 'Karim', 'Hamza', 'Ayoub'];
        $arabicLastNames  = ['El Amrani', 'Benali', 'Alaoui', 'El Idrissi', 'Bennani', 'Chraibi'];

        foreach ($companiesData as $c) {

            $company = Company::create([
                'name' => $c[0],
                'category' => $c[1],
                'country' => $c[2],
                'booth_number' => 'Stand ' . strtoupper(substr($c[0], 0, 1)) . rand(10, 99),
                'email' => $faker->unique()->safeEmail,
                'description' => 'Leading technology company delivering innovative solutions for African markets.',
                'is_featured' => $faker->boolean(40),
            ]);

            $companyIds[] = $company->id;

            // --------------------------------------------------
            // PRODUCTS
            // --------------------------------------------------
            $products = [
                [
                    'name' => 'Smart Business Management Platform',
                    'type' => 'Software',
                    'description' => 'An intelligent platform for managing business operations and analytics.',
                ],
                [
                    'name' => 'Secure Digital Payment System',
                    'type' => 'Fintech',
                    'description' => 'A fast and secure digital payment solution for enterprises.',
                ],
                [
                    'name' => 'Cloud Infrastructure Monitor',
                    'type' => 'Cloud',
                    'description' => 'Real-time cloud infrastructure monitoring and optimization system.',
                ],
            ];

            foreach ($products as $p) {
                Product::create([
                    'company_id' => $company->id,
                    'name' => $p['name'],
                    'type' => $p['type'],
                    'description' => $p['description'],
                    'is_featured' => $faker->boolean(30),
                    'category_id' => $faker->randomElement($productCategoryIds),
                ]);
            }

            // --------------------------------------------------
            // EXHIBITOR USERS
            // --------------------------------------------------
            for ($i = 0; $i < 2; $i++) {
                $firstName = $faker->randomElement($arabicFirstNames);
                $lastName  = $faker->randomElement($arabicLastNames);

                $user = User::create([
                    'name' => $firstName,
                    'last_name' => $lastName,
                    'email' => strtolower($firstName . '.' . $lastName) . '@' . Str::slug($c[0], '') . '.com',
                    'password' => Hash::make('password'),
                    'company_id' => $company->id,
                    'job_title' => $i === 0 ? 'Sales Manager' : 'Technical Lead',
                    'badge_code' => 'EX-' . $company->id . '-' . $i,
                    'is_visible' => true,
                ]);

                $user->addRole($roleExhibitor);
                $exhibitorUserIds[] = $user->id;
            }
        }

        // --------------------------------------------------
        // VISITORS
        // --------------------------------------------------
        $this->command->info('👥 Creating Visitors...');
        $roleVisitor = Role::where('slug', 'visitor')->first();
        $visitorIds = [];

        for ($i = 0; $i < 30; $i++) {
            $firstName = $faker->randomElement($arabicFirstNames);
            $lastName  = $faker->randomElement($arabicLastNames);

            $visitor = User::create([
                'name' => $firstName,
                'last_name' => $lastName,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'job_title' => 'Business Visitor',
                'badge_code' => 'VIS-' . (1000 + $i),
                'is_visible' => true,
                'company_id' => null,
            ]);

            $visitor->addRole($roleVisitor);
            $visitorIds[] = $visitor->id;
        }

        // --------------------------------------------------
        // CONFERENCES & SPEAKERS
        // --------------------------------------------------
        $topics = [
            'AI Innovation in Africa',
            'Future of Fintech',
            'Cybersecurity Challenges 2026',
            'Green Technology & Sustainability',
        ];

        foreach ($topics as $i => $topic) {
            $conf = Conference::create([
                'title' => $topic,
                'start_time' => '2026-11-20 ' . (10 + $i * 2) . ':00:00',
                'end_time' => '2026-11-20 ' . (11 + $i * 2) . ':30:00',
                'location' => 'Main Hall',
                'type' => $i === 0 ? 'Keynote' : 'Panel',
                'description' => 'Expert discussion on future technology trends.',
            ]);

            $speaker = Speaker::create([
                'full_name' => 'Dr. ' . $faker->name,
                'job_title' => 'Technology Expert',
                'company_name' => 'Global Tech',
                'bio' => 'International technology leader and keynote speaker.',
            ]);

            $conf->speakers()->attach($speaker->id);
            $conf->attendees()->attach($faker->randomElements($visitorIds, 5));
        }

        // --------------------------------------------------
        // B2B MEETINGS
        // --------------------------------------------------
        foreach ($visitorIds as $vid) {
            if ($faker->boolean(50)) {
                Appointment::create([
                    'booker_id' => $vid,
                    'target_user_id' => $faker->randomElement($exhibitorUserIds),
                    'scheduled_at' => '2026-11-21 14:00:00',
                    'duration_minutes' => 30,
                    'table_location' => 'Stand B' . rand(1, 20),
                    'status' => $faker->randomElement(['pending', 'confirmed']),
                    'notes' => 'Interested in learning more about your solution.',
                ]);
            }
        }

        // --------------------------------------------------
        // AWARDS
        // --------------------------------------------------
        $awardCategory = AwardCategory::create(['name' => 'Best Innovation 2026']);

        AwardNominee::create([
            'award_category_id' => $awardCategory->id,
            'company_id' => $companyIds[0],
            'product_name' => 'Smart Business Platform',
            'is_winner' => true,
        ]);

        AwardNominee::create([
            'award_category_id' => $awardCategory->id,
            'company_id' => $companyIds[1],
            'product_name' => 'Cloud Monitoring Suite',
            'is_winner' => false,
        ]);

        // --------------------------------------------------
        // SPONSORS
        // --------------------------------------------------
        Sponsor::create(['name' => 'Royal Air Maroc', 'category_type' => 'platinum']);
        Sponsor::create(['name' => 'Technopark Morocco', 'category_type' => 'institutional']);

        // --------------------------------------------------
        // NOTIFICATION
        // --------------------------------------------------
        Notification::create([
            'user_id' => $visitorIds[0],
            'title' => 'Welcome to Sahara Tech Summit',
            'body' => 'Do not miss the opening keynote at 10:00 AM.',
            'type' => 'info',
            'is_read' => false,
        ]);

        $this->command->info('✅ SEEDING COMPLETED SUCCESSFULLY!');
    }

    private function createRoles()
    {
        $roles = [
            ['slug' => 'visitor', 'name' => 'Visitor'],
            ['slug' => 'exhibitor', 'name' => 'Exhibitor'],
            ['slug' => 'admin', 'name' => 'Administrator'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['slug' => $role['slug']],
                ['name' => $role['name'], 'permissions' => []]
            );
        }
    }
}
