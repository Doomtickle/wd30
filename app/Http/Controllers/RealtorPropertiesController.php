<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Facades\KeriganSolutions\Drone\Mothership;

class RealtorPropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mlsId      = User::realtor()->mls_id;
        $properties = Mothership::agentListings($mlsId);

        return $properties;
    }
}
