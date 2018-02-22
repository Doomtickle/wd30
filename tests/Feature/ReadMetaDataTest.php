<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\MetaData;

class ReadMetaDataTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_see_their_site_metadata()
    {
        $meta = create(MetaData::class);

        $this->get('/metadata')
            ->assertSuccessful()
            ->assertJsonFragment([
                'title'       => $meta->title,
                'description' => $meta->description
            ]);
    }
}
