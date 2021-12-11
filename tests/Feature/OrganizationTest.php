<?php

namespace Tests\Feature;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrganizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_organization_show_page_is_rendered()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        
        $organization = Organization::factory()->create();
        $response = $this->get('organization/show/'.$organization->id);

        $response->assertStatus(200);
    }

    public function test_create_organization_page_can_be_rendered()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        $response = $this->get('organization/create');

        $response->assertStatus(200);
    }

    public function test_can_create_new_organization()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        $response = $this->post('organization/store', [
            'name' => 'Organization 1',
            'email' => 'org1@email.com',
            'phone' => '+6281242200988',
            'website' => 'https://printerous.com'
        ]);

        $response->assertRedirect(route('home'));
    }

    public function test_edit_page_can_can_be_rendered()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        
        $organization = Organization::factory()->create();
        $response = $this->get('organization/edit/'.$organization->id);

        $response->assertStatus(200);
    }

    public function test_organization_can_be_updated()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        
        $organization = Organization::factory()->create();
        $response = $this->put('organization/update/'.$organization->id, [
            'name' => 'Organization 2',
            'email' => 'org2@email.com',
            'phone' => '+6281242200988',
            'website' => 'https://printerous2.com'
        ]);

        $response->assertRedirect(route('organization.show', $organization));
    }
}
