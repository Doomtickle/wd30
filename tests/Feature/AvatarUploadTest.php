<?php

namespace Tests\Feature;

use App\Avatar;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function GuzzleHttp\json_decode;

class AvatarUploadTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();

        $this->user = create('App\User');
    }

    /** @test */
    public function a_realtor_can_upload_an_avatar()
    {
        $this->uploadPhoto();

        $avatar = Avatar::first();

        Storage::disk('public')->assertExists($avatar->path);
    }

    /** @test */
    public function an_uploaded_avatar_is_persisted_to_the_database()
    {
        $response = $this->uploadPhoto();
        $avatar   = $this->getAvatar();

        self::assertEquals($response->getContent(), $avatar->getContent());
    }

    /** @test */
    public function it_deletes_the_old_avatar_when_a_new_one_is_uploaded()
    {
        //upload original photo
        $originalPhoto = $this->uploadPhoto();
        self::assertEquals(1, count(Storage::disk('public')->files('avatar')));
        $this->assertDatabaseHas(
            'avatars',
            ['path' => $originalPhoto->getContent()]
        );

        //upload a new photo
        $newPhoto = $this->uploadPhoto();
        self::assertEquals(1, count(Storage::disk('public')->files('avatar')));
        $this->assertDatabaseHas(
            'avatars',
            ['path' => $newPhoto->getContent()]);
        $this->assertDatabaseMissing(
            'avatars',
            ['path' => $originalPhoto->getContent()]
        );

    }

    protected function uploadPhoto()
    {
        Storage::fake('public');

        return $this->json('POST', '/avatar', [
            'avatar' => UploadedFile::fake()->image('avatar.jpg')
        ]);

    }
    protected function getAvatar()
    {
        return $this->get('/avatar');
    }
}
