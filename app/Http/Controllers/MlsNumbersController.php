<?php

namespace App\Http\Controllers;

use App\MlsNumber;
use Illuminate\Http\Request;
use App\User;

class MlsNumbersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MlsNumber::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'mls_id' => 'required|max:10|unique:mls_numbers'
        ]);

        $user = User::realtor();

        $mlsNumber = MlsNumber::create([
            'user_id' => $user->id,
            'mls_id' => $request->mls_id
        ]);

        return $mlsNumber;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MlsNumber  $mlsNumber
     * @return \Illuminate\Http\Response
     */
    public function destroy(MlsNumber $mlsNumber)
    {
        $mlsNumber->delete();
    }
}
