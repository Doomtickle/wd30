<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\MlsNumber;

class MlsNumbersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_mls_number_belongs_to_a_realtor()
    {
        $user = create('App\User');
        $created = factory('App\MlsNumber')->create([
            'user_id' => $user->id
        ]);

        $mls_number = MlsNumber::with('realtor')->first();

        self::assertInstanceOf('App\User', $mls_number->realtor);
    }
}
