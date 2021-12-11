<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_is_rendered()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        
        $response = $this->get('home');

        $response->assertStatus(200);
    }

    public function test_home_page_cannot_be_rendered_by_guest()
    {
        $response = $this->get('home');

        $response->assertRedirect(route('login'));
    }

    public function test_search_is_working()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        $response = $this->get('home?keyword=something');

        $response->assertStatus(200);
    }
}
