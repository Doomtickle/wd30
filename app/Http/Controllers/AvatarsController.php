<?php

namespace App\Http\Controllers;

use App\User;
use App\Avatar;
use Illuminate\Http\Request;

class AvatarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Avatar::where('user_id', 1)->exists()) {
            return Avatar::first()->path;
        }

        return 'http://via.placeholder.com/300x300';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Avatar::deleteIfExists();

        return Avatar::upload($request->file('avatar'));
    }
}
