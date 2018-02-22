<?php

namespace App\Http\Controllers;

use App\MetaData;
use Illuminate\Http\Request;

class MetaDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new MetaData())->getOrCreate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return MetaData::create([
            'title'       => $request->title,
            'description' => $request->description
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MetaData  $metaData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MetaData $metadata)
    {
        $metadata->update($request->all());

        return $metadata;
    }
}
