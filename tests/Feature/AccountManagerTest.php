<?php

namespace Tests\Feature;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccountManagerTest extends TestCase
{
    use RefreshDatabase;

    public function test_assign_account_manager_page_is_restricted_to_admin()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        $organization = Organization::factory()->create();
        $response = $this->get('organization/'.$organization->id.'/account-manager/create');
        
        $response->assertStatus(403);
    }

    public function test_user_can_be_assigned_to_an_organiztion()
    {   
        $user = User::factory()->create(['is_admin' => true]);
        $user2 = User::factory()->create();
        $response = $this->actingAs($user);
        $organization = Organization::factory()->create();
        $response = $this->post('organization/'.$organization->id.'/account-manager/store/'.$user2->id);

        $this->assertEquals($organization->refresh()->user_id, $user2->id);
        $response->assertRedirect(route('organization.show', $organization));
    }

    public function test_user_can_be_unassigned_from_an_organiztion()
    {
        $user = User::factory()->create(['is_admin' => true]);
        $user2 = User::factory()->create();
        $response = $this->actingAs($user);
        $organization = Organization::factory()->create();
        $organization->update(['user_id' => $user2->id]);
        $response = $this->delete('organization/'.$organization->id.'/account-manager');
        
        $this->assertNull($organization->refresh()->user_id);
        $response->assertRedirect(route('organization.show', $organization));
    }
}
