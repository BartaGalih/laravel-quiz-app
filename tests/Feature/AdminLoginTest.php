<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_login_page_is_accessible()
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertSee('Admin Login');
    }

    /** @test */
    public function valid_admin_can_authenticate()
    {
        $admin = Admin::factory()->create(['password' => bcrypt('secret')]);

        $response = $this->post('/admin/login', [
            'email' => $admin->email,
            'password' => 'secret',
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($admin, 'admin');
    }

    /** @test */
    public function invalid_admin_credentials_are_rejected()
    {
        $response = $this->from('/admin/login')->post('/admin/login', [
            'email' => 'nope@example.com',
            'password' => 'wrong',
        ]);

        $response->assertRedirect('/admin/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest('admin');
    }

    /** @test */
    public function logged_in_admin_is_redirected_away_from_login()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get('/admin/login');
        $response->assertRedirect('/admin/dashboard');
    }
}
