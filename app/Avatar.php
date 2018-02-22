<?php

namespace App;

use App\User;
use App\Avatar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Avatar extends Model
{
    protected $guarded = [];

    /**
     * An avatar belongs to a realtor.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function realtor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Delete user's avatar if it exists.
     *
     * @return void
     */
    public static function deleteIfExists()
    {
        $avatar = Avatar::where('user_id', 1)->exists() ? Avatar::first() : null;
        if ($avatar) {
            Storage::disk('public')->delete($avatar->path);
            $avatar->delete();
        }
    }

    /**
     * User can create a new avatar.
     *
     * @param
     * @return
     */
    public static function upload($file)
    {
        $path = Storage::put('avatar', $file);

        $user = User::realtor();

        $avatar = Avatar::create([
            'user_id' => $user->id,
            'path'    => $path
        ]);

        return $path;
    }
}
