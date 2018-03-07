<?php

namespace App;

use App\User;
use App\MlsNumber;
use Facades\KeriganSolutions\Drone\Mothership;
use Illuminate\Database\Eloquent\Model;

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
}
