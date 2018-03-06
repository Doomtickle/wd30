<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadMlsNumbersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_see_their_mls_number()
    {
        $user = create('App\User');
        $mlsNumber = create('App\MlsNumber', [
            'user_id' => $user->id
        ]);

        $this->get('mls-numbers')
            ->assertSuccessful()
            ->assertJsonFragment([
                'mls_id' => $mlsNumber->mls_id,
            ]);
    }
}
