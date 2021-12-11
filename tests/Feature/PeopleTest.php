<?php

namespace Tests\Feature;

use App\Models\Organization;
use App\Models\Person;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PeopleTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_person_page_can_be_rendered_by_admin()
    {
        $user = User::factory()->create(['is_admin' => true]);
        $response = $this->actingAs($user);
        $organization = Organization::factory()->create();
        $response = $this->get('organization/'.$organization->id.'/people/create');

        $response->assertStatus(200);
    }

    public function test_create_person_page_can_not_be_rendered_by_non_admin()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        $organization = Organization::factory()->create();
        $response = $this->get('organization/'.$organization->id.'/people/create');

        $response->assertStatus(403);
    }

    public function test_create_person_page_can_be_rendered_by_account_manager()
    {
        $user = User::factory()->create();
        $organization = Organization::factory()->create();
        $organization->update(['user_id' => $user->id]);
        $organization->refresh();

        $response = $this->actingAs($user);
        $response = $this->get('organization/'.$organization->id.'/people/create');

        $response->assertStatus(200);
    }

    public function test_admin_can_create_new_person()
    {
        $user = User::factory()->create(['is_admin' => true]);
        $response = $this->actingAs($user);
        $organization = Organization::factory()->create();
        $response = $this->post('organization/'.$organization->id.'/people/store', [
            'name' => 'someone',
            'email' => 'org1@email.com',
            'phone' => '+6281242200988',
        ]);

        $response->assertRedirect(route('organization.show', $organization));
    }

    public function test_account_manager_can_create_new_person()
    {
        $user = User::factory()->create();
        $organization = Organization::factory()->create();
        $organization->update(['user_id' => $user->id]);
        $organization->refresh();

        $response = $this->actingAs($user);
        $response = $this->post('organization/'.$organization->id.'/people/store', [
            'name' => 'someone',
            'email' => 'org1@email.com',
            'phone' => '+6281242200988',
        ]);

        $response->assertRedirect(route('organization.show', $organization));
    }

    public function test_non_admin_can_not_create_new_person()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        $organization = Organization::factory()->create();
        $response = $this->post('organization/'.$organization->id.'/people/store', [
            'name' => 'someone',
            'email' => 'org1@email.com',
            'phone' => '+6281242200988',
        ]);

        $response->assertStatus(403);
    }

    public function test_edit_page_can_be_rendered_by_admin()
    {
        $user = User::factory()->create(['is_admin' => true ]);
        $response = $this->actingAs($user);
        
        $organization = Organization::factory()->create();
        $person = Person::factory()->for($organization)->create();

        $response = $this->get('organization/'.$organization->id.'/people/edit/'.$person->id);

        $insertedPerson = Person::whereId($person->id)->first();
        $this->assertModelExists($insertedPerson);
        $this->assertEquals($organization->id, $insertedPerson->organization_id);
        $response->assertStatus(200);
    }

    public function test_edit_page_can_be_rendered_by_account_manager()
    {
        $user = User::factory()->create();
        
        $organization = Organization::factory()->create(['user_id' => $user->id]);
        $person = Person::factory()->for($organization)->create();
        
        $response = $this->actingAs($user);
        $response = $this->get('organization/'.$organization->id.'/people/edit/'.$person->id);

        $insertedPerson = Person::whereId($person->id)->first();
        $this->assertModelExists($insertedPerson);
        $this->assertEquals($organization->id, $insertedPerson->organization_id);
        $response->assertStatus(200);
    }

    public function test_edit_page_can_not_be_rendered_by_non_admin()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        
        $organization = Organization::factory()->create();
        $person = Person::factory()->for($organization)->create();

        $response = $this->get('organization/'.$organization->id.'/people/edit/'.$person->id);

        $insertedPerson = Person::whereId($person->id)->first();
        $this->assertModelExists($insertedPerson);
        $this->assertEquals($organization->id, $insertedPerson->organization_id);
        $response->assertStatus(403);
    }

    public function test_person_can_be_updated_by_admin()
    {
        $user = User::factory()->create(['is_admin' => true]);
        $response = $this->actingAs($user);
        
        $organization = Organization::factory()->create();
        $person = Person::factory()->for($organization)->create();

        $response = $this->put('organization/'.$organization->id.'/people/update/'.$person->id, [
            'name' => 'People 2',
            'email' => 'org2@email.com',
            'phone' => '+6281242200988',
        ]);

        $this->assertEquals('People 2', Person::whereId($person->id)->first()->name);
        $response->assertRedirect(route('organization.show', $organization));
    }

    public function test_person_can_be_updated_by_account_manager()
    {
        $user = User::factory()->create();
        $organization = Organization::factory()->create(['user_id' => $user->id]);
        $response = $this->actingAs($user);
        
        $person = Person::factory()->for($organization)->create();

        $response = $this->put('organization/'.$organization->id.'/people/update/'.$person->id, [
            'name' => 'People 2',
            'email' => 'org2@email.com',
            'phone' => '+6281242200988',
        ]);

        $this->assertEquals('People 2', Person::whereId($person->id)->first()->name);
        $response->assertRedirect(route('organization.show', $organization));
    }

    public function test_person_can_not_be_updated_by_non_admin()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        
        $organization = Organization::factory()->create();
        $person = Person::factory()->for($organization)->create();

        $response = $this->put('organization/'.$organization->id.'/people/update/'.$person->id, [
            'name' => 'People 2',
            'email' => 'org2@email.com',
            'phone' => '+6281242200988',
        ]);

        $response->assertStatus(403);
    }

    public function test_person_can_be_deleted_by_admin()
    {
        $user = User::factory()->create(['is_admin' => true]);
        $response = $this->actingAs($user);
        
        $organization = Organization::factory()->create();
        $person = Person::factory()->for($organization)->create();

        $response = $this->delete('organization/'.$organization->id.'/people/'.$person->id);

        $this->assertNull(Person::whereId($person->id)->first());
        $response->assertRedirect(route('organization.show', $organization));
    }

    public function test_person_can_be_deleted_by_account_manager()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        
        $organization = Organization::factory()->create(['user_id' => $user->id]);
        $person = Person::factory()->for($organization)->create();

        $response = $this->delete('organization/'.$organization->id.'/people/'.$person->id);

        $this->assertNull(Person::whereId($person->id)->first());
        $response->assertRedirect(route('organization.show', $organization));
    }

    public function test_person_can_not_be_deleted_by_non_admin()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        
        $organization = Organization::factory()->create();
        $person = Person::factory()->for($organization)->create();

        $response = $this->delete('organization/'.$organization->id.'/people/'.$person->id);

        $response->assertStatus(403);
    }
}
