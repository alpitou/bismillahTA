<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function login_page_can_be_rendered_for_guests()
    {
        // test login route shows the login page for guests
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertViewIs('login.index');
        $response->assertViewHas('title', 'Login');
    }

    /** @test */
    public function authenticated_users_cannot_access_login_page()
    {
        // create and authenticate a user with role
        $user = User::factory()->create([
            'role' => 'Pegawai'
        ]);
        $this->actingAs($user);
        
        // try to access login page while authenticated
        $response = $this->get('/login');
        
        // should be redirected away from login page
        $response->assertRedirect('/');
    }

    /** @test */
    public function user_can_authenticate_with_valid_credentials()
    {
        // create a test user
        $user = User::factory()->create([
            'username' => 'testuser',
            'password' => bcrypt('password'),
            'role' => 'Pegawai',
        ]);

        // login with valid credentials
        $response = $this->post('/login', [
            'username' => 'testuser',
            'password' => 'password',
        ]);

        // assert user is authenticated and redirected to dashboard
        $this->assertAuthenticated();
        $response->assertRedirect('/dashboard');
    }

    /** @test */
    public function user_cannot_authenticate_with_invalid_credentials()
    {
        // create a test user
        $user = User::factory()->create([
            'username' => 'testuser',
            'password' => Hash::make('correctpassword'),
            'role' => 'Pegawai'
        ]);

        // login with invalid password
        $response = $this->post('/login', [
            'username' => 'testuser',
            'password' => 'wrongpassword',
        ]);

        // assert user is not authenticated and has error message
        $this->assertGuest();
        $response->assertRedirect();
        $response->assertSessionHas('loginError', 'username atau password salah.');
    }

    /** @test */
    public function login_validates_username_requirement()
    {
        // login without username
        $response = $this->post('/login', [
            'username' => '',
            'password' => 'password',
        ]);

        // assert validation error
        $response->assertSessionHasErrors('username');
        $this->assertGuest();
    }

    /** @test */
    public function login_validates_password_requirement()
    {
        // login without password
        $response = $this->post('/login', [
            'username' => 'testuser',
            'password' => '',
        ]);

        // assert validation error
        $response->assertSessionHasErrors('password');
        $this->assertGuest();
    }

    /** @test */
    public function authenticated_user_can_logout()
    {
        // create and authenticate a user with role
        $user = User::factory()->create([
            'role' => 'Pegawai'
        ]);
        $this->actingAs($user);
        
        // verify user is authenticated
        $this->assertAuthenticated();
        
        // perform logout
        $response = $this->post('/logout');
        
        // assert user is logged out and redirected to home
        $this->assertGuest();
        $response->assertRedirect('/');
    }

    /** @test */
    public function logout_invalidates_session_and_regenerates_token()
    {
        // create and authenticate a user with role
        $user = User::factory()->create([
            'role' => 'Pegawai'
        ]);
        $this->actingAs($user);
        
        // get session ID before logout
        $sessionId = session()->getId();
        
        // perform logout
        $this->post('/logout');
        
        // assert session has been regenerated (id changed)
        $this->assertNotEquals($sessionId, session()->getId());
    }
    
    /** @test */
    public function each_role_can_authenticate()
    {
        // test for each role: Pegawai, Ketua Tim, Inspektur
        $roles = ['Pegawai', 'Ketua Tim', 'Inspektur'];
        
        foreach ($roles as $index => $role) {
            // create user with specific role
            // use role-specific username without spaces
            $username = "testuser{$index}";

            $user = User::factory()->create([
                'username' => $username,
                'password' => bcrypt('password'),
                'role' => $role,
            ]);
            
            // login with valid credentials
            $response = $this->post('/login', [
                'username' => $username,
                'password' => 'password',
            ]);
            
            // assert user is authenticated and redirected to dashboard
            $this->assertAuthenticated();
            $response->assertRedirect('/dashboard');
            
            // logout for next test
            $this->post('/logout');
        }
    }
}