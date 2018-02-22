<?php

namespace Tests\Feature;

use App\MetaData;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateMetaDataTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_create_metadata()
    {
        $meta = make(MetaData::class);

        $this->post('/metadata', $meta->toArray())
            ->assertSuccessful();

        $this->assertDatabaseHas('meta_data', [
            'title' => $meta->title,
            'description' => $meta->description
        ]);
    }
}
