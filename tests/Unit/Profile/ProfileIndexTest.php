<?php

namespace Tests\Unit\Profile;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
class ProfileIndexTest extends TestCase
{
    use RefreshDatabase;
   public function test_Index_Redirect_Unauthenticated_to_login()
    {
    $response = $this->get(route('profiles.index'));
    $response->assertRedirect('login');
    $response->assertStatus(302);
    }

    public function test_show_index_to_authenticated()
    {
        $this->actingAs(factory(User::class)->create());
        $response= $this->get(route('profiles.index'));
        $response->assertOk();
    }

}
