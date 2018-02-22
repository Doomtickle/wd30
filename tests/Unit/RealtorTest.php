<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Facades\App\Realtor;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RealtorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_realtor_knows_if_they_exist()
    {
        create(User::class);

        self::assertTrue(Realtor::exists());
    }
}
