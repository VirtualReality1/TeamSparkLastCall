<?php

namespace Tests\Feature\Http\Controllers;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function login_displays_the_login_form()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    /** @test */
    public function login_displays_validation_errors()
    {
        $response = $this->post(route('login'), []);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function login_authenticates_and_redirects_user()
    {
        $user = factory(User::class)->create();

        $response = $this->post(route('login', [
            'email' => $user->email,
            'password' => 'password',
        ]));

        $response->assertRedirect(route('index'));
        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function register_displays_the_register_form()
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
    }

    /** @test */
    public function register_displays_validation_errors()
    {
        $response = $this->post(route('register'), []);
        $response->assertStatus(302);
        $response->assertSessionHasErrors('username');
        $response->assertSessionHasErrors('firstName');
        $response->assertSessionHasErrors('lastName');
        $response->assertSessionHasErrors('email');
        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function register_creates_and_authenticates_a_user()
    {

        $username = $this->faker->name;
        $email = $this->faker->safeEmail;
        $password = $this->faker->password(8);

        $response = $this->post(route('register'), [
            'username' => $username,
            'firstName' => $username,
            'lastName' => $username,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
        ]);


        $response->assertRedirect(route('index'));

        $user = User::where('email', $email)->where('username', $username)->first();

        //JSON Returns Null - Value. Not sure how to fix it.
        $this->assertNotNull($user);

        $this->assertAuthenticatedAs($user);

    }
}
