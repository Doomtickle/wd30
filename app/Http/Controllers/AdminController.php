<?php

namespace App\Http\Controllers;

use App\Lead;
use App\User;
use App\Avatar;
use App\Realtor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Facades\KeriganSolutions\Drone\Mothership;
use App\MlsNumber;

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
        $this->middleware('installed');
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
        $avatarPath   = Avatar::where('user_id', $user->id)
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
        return Mothership::agentListingsWithAnalytics(MlsNumber::toString());
    }
}
