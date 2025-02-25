<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function register_page_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertViewIs('register.index');
        $response->assertViewHas('title', 'Register');
    }

    /** @test */
    public function authenticated_users_cannot_access_register_page()
    {
        $user = User::factory()->create([
            'role' => 'Pegawai'
        ]);
        $this->actingAs($user);
        
        $response = $this->get('/register');
        
        $response->assertRedirect('/');
    }

    /** @test */
    public function user_can_register_with_valid_data()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@gmail.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHas('success', 'Akun berhasil dibuat!');
        
        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@gmail.com',
        ]);
        
        // verify password was hashed
        $user = User::where('email', 'test@gmail.com')->first();
        $this->assertTrue(Hash::check('password123', $user->password));
    }

    /** @test */
    public function register_requires_name()
    {
        $response = $this->post('/register', [
            'name' => '',
            'username' => 'testuser',
            'email' => 'test@gmail.com',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function register_requires_username()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'username' => '',
            'email' => 'test@gmail.com',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('username');
    }

    /** @test */
    public function register_requires_valid_email()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'invalid-email',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function register_requires_password()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@gmail.com',
            'password' => '',
        ]);

        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function register_requires_minimum_password_length()
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@gmail.com',
            'password' => '1234', // less than 5 characters
        ]);

        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function username_must_be_unique()
    {
        // create a user with the username
        User::factory()->create([
            'username' => 'existinguser',
            'role' => 'Pegawai'
        ]);
        
        // register with the same username
        $response = $this->post('/register', [
            'name' => 'Test User',
            'username' => 'existinguser',
            'email' => 'test@gmail.com',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('username');
    }

    /** @test */
    public function email_must_be_unique()
    {
        // create a user with the email
        User::factory()->create([
            'email' => 'existing@gmail.com',
            'role' => 'Pegawai'
        ]);
        
        // try to register with the same email
        $response = $this->post('/register', [
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'existing@gmail.com',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
    }
}