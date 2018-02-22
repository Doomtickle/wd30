<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_update_their_info()
    {
        $user = factory('App\User')->create();

        $this->actingAs($user);

        $newUserData = [
            'name'         => 'Changed Name',
            'email'        => 'newemail@new.com',
            'mls_id'       => 'B7777',
            'address'      => 'This is a new address',
            'cell_phone'   => '123-456-7890',
            'office_phone' => '123-456-7890',
            'company'      => 'Beachy Beach Real Estate'
        ];

        $this->json('PATCH', '/users/'. $user->id, $newUserData);

        $changedUser = User::find($user->id);

        $this->assertDatabaseHas('users', $newUserData);
    }
}
