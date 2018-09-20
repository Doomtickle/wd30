<?php

namespace App;

use App\User;
use App\MlsNumber;
use Illuminate\Database\Eloquent\Model;
use Facades\KeriganSolutions\Drone\Mothership;

class Realtor
{
    const PLACEHOLDER_PHOTO = 'https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png';

    public $data;
    public $listings;

    public function __construct()
    {
        $this->data = [];
        $this->listings = [];
    }
    public function exists()
    {
        return User::where('is_realtor', 1)->exists();
    }

    public function getProfile()
    {
        $this->data = $this->exists() ? User::realtor() : [];

        return $this;
    }

    public function withListings()
    {
        $agentMlsNumberString = MlsNumber::toString();

        $this->listings = Mothership::agentListings($agentMlsNumberString);

        return $this;
    }

    public function shouldHaveFacebook()
    {
        return (config('modules.facebook') && $this->data->fb_page_id && $this->data->fb_access_token);
    }

    public function shouldHaveYoutube()
    {
        return (config('modules.youtube') && $this->data->youtube_channel_id);
    }

    public function shouldHaveBlogs()
    {
        return (config('modules.blog') && (Blog::count() > 0));
    }

    public function hasListings()
    {
        return (count($this->listings) > 0);
    }
}
