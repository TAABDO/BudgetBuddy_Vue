<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Depense;

class DepensesControllerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }


    public function test_index_returns_list_of_depenses()
    {
        // Create a user
        $user = User::factory()->create();
        // Create some depenses for the user
        $depenses = Depense::factory(3)->create(['user_id' => $user->id]);
        // Authenticate the user
        $this->actingAs($user);
        // Make a GET request to the index endpoint
        $response = $this->get('/api/depenses');
        // Assert that the response has a status code of 200
        $response->assertStatus(200);
        // Assert that the response contains the depenses data
        foreach ($depenses as $depense) {
            $response->assertJsonFragment([
                'id' => $depense->id,
                // Add other attributes as needed
            ]);
        }
    }

    public function test_store_creates_new_depense()
    {
        // Create a user
        $user = User::factory()->create();
        // Authenticate the user
        $this->actingAs($user);
        // Make a POST request to the store endpoint
        $response = $this->post('/api/depenses', [
            'amount' => 100,
            'date' => '2024-03-25',
            'Description' => 'Test description',
        ]);
        // Assert that the response has a status code of 201
        $response->assertStatus(201);
        // Assert that the response contains the newly created depense
        $response->assertJsonFragment([
            'message' => 'Depense created successfully',
            // Add other attributes as needed
        ]);
        // Assert that the depense was created in the database
        $this->assertDatabaseHas('depenses', [
            'user_id' => $user->id,
            'amount' => 100,
            // Add other attributes as needed
        ]);
    }
}
