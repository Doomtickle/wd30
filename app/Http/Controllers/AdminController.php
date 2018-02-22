<?php

namespace App\Http\Controllers;

use App\Lead;
use App\User;
use App\Avatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Facades\KeriganSolutions\Drone\Mothership;
use App\Realtor;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $user         = Auth::user();
        $defaultPhoto = $user->default_photo != '' ? $user->default_photo : Realtor::PLACEHOLDER_PHOTO;
        $avatarPath   = Avatar::where('user_id', 1)
                            ->exists() ? Avatar::first()->path
                            : $defaultPhoto;

        return view('home', compact('user', 'avatarPath'));
    }

    /**
     * Show listings with analytics.
     *
     * @return string
     */
    public function myProperties()
    {
        $user = User::realtor();

        return Mothership::agentListingsWithAnalytics($user->mls_id);
    }
}
