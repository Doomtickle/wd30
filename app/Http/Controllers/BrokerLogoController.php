<?php

namespace App\Http\Controllers;

use App\User;
use App\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrokerLogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (Avatar::where('user_id', 1)->exists()) {
        //     return '/storage/' . Avatar::first()->path;
        // }

        return 'http://via.placeholder.com/150x150';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'broker_logo' => 'required|image'
        ]);

        if (Storage::disk('public')->exists(Content::first()->broker_logo_path)) {
            Content::first()->update([ 'broker_logo_path' => null ]);
        }
        Content::first()->update([
            'broker_logo_path' => request()->file('broker_logo')->store('/broker_logo', 'public')
        ]);

        $brokerLogoPath = Content::first()->broker_logo_path;

        return asset('storage/'. $brokerLogoPath);
    }
}
