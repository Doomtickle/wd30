<?php

namespace Tests\Feature;

use App\Lead;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateLeadsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_lead_can_be_created()
    {
        $lead = [
            'name'    => 'Joe Testerson',
            'phone'   => '850-555-5555',
            'email'   => 'test@test.com',
            'message' => 'Message contents',
        ];
        $this->post('/leads', $lead);
        $this->assertDatabaseHas('leads', $lead);
    }
}
