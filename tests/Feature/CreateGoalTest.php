<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateGoalTest extends TestCase
{
    /**
     * A user can create a goal.
     *
     * @test
     * @return void
     */
    public function creatingAGoal()
    {
        // As any user...
        $user = factory(User::class)->create();

        // Given sample goal data...
        $goalData = [
            'name'          => 'Test Goal',
            'description'   => 'This goal was created by testing.',
            'target'        => 1,
            'operator'      => '=='
        ];

        // Send a request to create a new goal...
        $response = $this->actingAs($user)->post('/api/goals', $goalData);

        // And make sure the response contains a valid status code plus the goal data
        $response
            ->assertStatus(201)
            ->assertJson(['goal' => $goalData])
            ->assertJsonFragment(['id']);
    }
}
