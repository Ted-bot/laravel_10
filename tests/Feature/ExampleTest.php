<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Notifications\RegisteredUserNotification;
use Illuminate\Support\Facades\Notification;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    public function test_notify_admins_by_mail_new_user(): void
    {
        Notification::fake();

        $admins = User::factory()->count(3)
            ->create();

        $user = User::factory()->create();

        $messages["greeting"] = "Dear Admin, a new member {$user->name} has singed up!";
        $messages["notify"] = "Congrats with the growth of your company.";

        foreach($admins as $admin)
        {
            $admin->notify(new RegisteredUserNotification($messages));

            Notification::assertSentTo($admin,RegisteredUserNotification::class);
        }
    }
}
