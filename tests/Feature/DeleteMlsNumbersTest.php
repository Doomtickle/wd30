<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteMlsNumbersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_mls_can_be_deleted()
    {
        $mlsNumber = create('App\MlsNumber', [
            'user_id' => 1
        ]);

        $this->assertDatabaseHas('mls_numbers', [
            'id' => $mlsNumber->id
        ]);

        $this->delete('mls-numbers/'. $mlsNumber->id);

        $this->assertDatabaseMissing('mls_numbers', [
            'id' => $mlsNumber->id
        ]);
    }
}
