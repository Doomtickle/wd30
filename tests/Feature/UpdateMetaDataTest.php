<?php

namespace Tests\Feature;

use App\MetaData;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateMetaDataTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function metadata_can_be_updated()
    {
        $meta = create(MetaData::class);

        $response = $this->patch('/metadata/'. $meta->id, [
            'title'       => 'New Title',
            'description' => 'New Description'
        ])
            ->assertSuccessful()
            ->assertJsonFragment([
                'title'       => 'New Title',
                'description' => 'New Description'
            ]);
    }
}
