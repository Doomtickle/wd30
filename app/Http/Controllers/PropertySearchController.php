<?php

namespace App\Http\Controllers;

use App\User;
use App\Realtor;
use Carbon\Carbon;
use Facades\App\Feature;
use Facades\App\Property;
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
        $realtor    = (new Realtor())->getProfile();
        $properties = Mothership::search($request);
        $searchParams = json_encode($request->all());

        return view('properties.index', compact('properties', 'realtor', 'searchParams'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($mlsNumber)
    {
        $property   = Mothership::listing($mlsNumber);
        $address    = Property::fullAddress($property); // used for lead generation
        $features   = Feature::list($property);
        $openHouses = OpenHouse::extract($property->open_houses);
        $realtor    = (new Realtor())->getProfile();

        return view(
            'properties.show',
            compact(
                'address',
                'realtor',
                'features',
                'property',
                'openHouses',
                'featuresCount'
            )
        );
    }

    /**
     * Show listings in property search.
     *
     * @return string
     */
    public function search(Request $request)
    {
        return response()->json(Mothership::search($request));
    }

    /**
     * Show listings in map search.
     *
     * @return string
     */
    public function mapSearch(Request $request)
    {
        return response()->json(Mothership::search($request));
    }

    /**
     * Get single listing when map pin is clicked.
     *
     * @return string
     */
    public function singleListing($mlsNumber)
    {
        return response()->json(Mothership::listing($mlsNumber));
    }

}
