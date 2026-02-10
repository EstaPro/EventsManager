<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
use App\Models\Company;
use App\Models\Conference;
use PHPUnit\Framework\Attributes\Test;

class ApiFlowTest extends TestCase
{
    // We don't use RefreshDatabase here because we want to use your seeded data.
    // If you want to use a fresh DB every time, uncomment the line below.
    // use RefreshDatabase;

    protected $token;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // 1. Find our Visitor "Sarah" (Created by your Seeder)
        $this->user = User::where('email', 'sarah@visitor.ma')->first();

        if (!$this->user) {
            $this->markTestSkipped('Sarah not found. Please run: php artisan db:seed --class=SaharaSummitSeeder');
        }
    }

    #[Test]
    public function it_can_login_and_get_token()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'sarah@visitor.ma',
            'password' => 'password',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'access_token',
                'user' => ['id', 'email', 'badge_code']
            ]);

        // Save token for next steps (in real app, mobile does this)
        $this->token = $response->json('access_token');
    }

    #[Test]
    public function it_can_fetch_agenda()
    {
        // Login first to get token
        $token = $this->user->createToken('test')->plainTextToken;

        $response = $this->withToken($token)->getJson('/api/agenda');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'title', 'start_time', 'is_attending']
                ]
            ]);
    }

    #[Test]
    public function it_can_attend_a_conference()
    {
        $token = $this->user->createToken('test')->plainTextToken;
        $conference = Conference::first();

        $response = $this->withToken($token)->postJson('/api/attend-conference', [
            'conference_id' => $conference->id
        ]);

        // It should be 200 (Success) or 409 (Already Registered)
        $this->assertTrue(in_array($response->status(), [200, 409]));
    }

    #[Test]
    public function it_can_book_a_b2b_meeting()
    {
        $token = $this->user->createToken('test')->plainTextToken;
        $company = Company::first();

        $response = $this->withToken($token)->postJson('/api/book-meeting', [
            'company_id' => $company->id,
            'scheduled_at' => now()->addDays(5)->format('Y-m-d H:i:s'),
            'notes' => 'Integration Test Meeting'
        ]);

        $response->assertStatus(200);
    }
}
