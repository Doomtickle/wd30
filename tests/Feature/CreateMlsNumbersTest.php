<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateMlsNumbersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_mls_number_can_be_added_to_a_realtor()
    {
        $user = create('App\User');
        $mls  = factory('App\MlsNumber')->make();

        $this->post('/mls-numbers', [
            'mls_id' => $mls->mls_id
        ])
        ->assertSuccessful()
        ->assertJsonFragment([
            'user_id' => $user->id,
            'mls_id' => $mls->mls_id
        ]);
    }

    /** @test */
    public function a_blank_mls_number_cannot_be_added_to_a_realtor()
    {
        $user = create('App\User');
        $mls = [
            'user_id' => $user->id,
            'mls_id' => ''
        ];

        $this->post('/mls-numbers', $mls)
            ->assertSessionHasErrors('mls_id');
    }
}
