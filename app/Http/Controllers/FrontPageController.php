<?php

namespace App\Http\Controllers;

use App\User;
use App\Content;
use Facades\App\Realtor;
use Facades\App\MetaData;
use Illuminate\Http\Request;
use Facades\KeriganSolutions\Drone\Mothership;

class FrontPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('installed');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        MetaData::generate();

        $realtor           = User::realtor();
        $realtor->listings = Mothership::agentListings($realtor->mls_id);

        $default = $realtor->default_photo ?? Realtor::PLACEHOLDER_PHOTO;
        $avatar  = isset($realtor->avatar->path) ? asset('storage/' . $realtor->avatar->path) : $default;
        $content = Content::first();

        return view('StaticPages.front', compact('realtor', 'content', 'avatar'));
    }
}
