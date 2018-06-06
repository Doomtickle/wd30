<?php

namespace App\Http\Controllers;

use App\User;
use App\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeaderPhotoController extends Controller
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

        return 'http://via.placeholder.com/1920x750';
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
            'header_photo' => 'required|image'
        ]);

        if (Storage::disk('public')->exists(Content::first()->header_photo_path)) {
            Content::first()->update([ 'header_photo_path' => null ]);
        }
        Content::first()->update([
            'header_photo_path' => request()->file('header_photo')->store('/header_photo', 'public')
        ]);

        $headerPhotoPath = Content::first()->header_photo_path;

        return asset('storage/'. $headerPhotoPath);
    }
}
