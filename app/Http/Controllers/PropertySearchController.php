<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Facades\App\Feature;
use Facades\App\Realtor;
use Facades\App\OpenHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Facades\KeriganSolutions\Drone\Mothership;

class PropertySearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $realtor    = Realtor::exists() ? User::realtor() : null;
        $properties = Mothership::search($request);

        return view('properties.index', compact('properties', 'realtor'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($mlsNumber)
    {
        $property   = Mothership::listing($mlsNumber);
        $features   = Feature::list($property);
        $openHouses = OpenHouse::extract($property->open_houses);
        $realtor    = Realtor::exists() ? User::realtor() : null;

        return view(
            'properties.show',
            compact('property', 'features', 'openHouses', 'realtor', 'featuresCount')
        );
    }

}
