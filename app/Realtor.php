<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Realtor
{
    const PLACEHOLDER_PHOTO = 'https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png';

    public function exists()
    {
        return User::where('is_realtor', 1)->exists();
    }
}
