<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MyPropertiesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_realtor_can_view_their_properties_page()
    {
        $this->signIn();
        $this->get('/my-properties')
            ->assertSuccessful();
    }

    /** @test */
    public function guests_cannot_view_the_realtors_property_page()
    {
        $this->get('/my-properties')
            ->assertRedirect('/login');
    }
}
