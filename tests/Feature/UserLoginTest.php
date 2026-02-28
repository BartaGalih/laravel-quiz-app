<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function login_page_is_accessible_to_guests()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Login');
    }

    /** @test */
    public function valid_user_can_authenticate_and_is_redirected()
    {
        $user = User::factory()->create(['is_admin' => false, 'password' => bcrypt('secret')]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret',
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function invalid_credentials_are_rejected()
    {
        $response = $this->from('/login')->post('/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'wrong',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    /** @test */
    public function admin_user_cannot_use_user_login()
    {
        $admin = User::factory()->create(['is_admin' => true, 'password' => bcrypt('secret')]);

        $response = $this->from('/login')->post('/login', [
            'email' => $admin->email,
            'password' => 'secret',
        ]);

        $response->assertRedirect('/login');
        $this->assertGuest();
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function authenticated_user_can_logout()
    {
        $user = User::factory()->create(['is_admin' => false, 'password' => bcrypt('secret')]);
        $this->be($user);

        $response = $this->post('/logout');
        $response->assertRedirect('/login');
        $this->assertGuest();
    }
}
