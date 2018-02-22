<?php

namespace App\Http\Controllers;

use App\User;
use Facades\App\Installer;
use Illuminate\Http\Request;
use Facades\KeriganSolutions\Drone\Mothership;

class ConfigureInstallController extends Controller
{
    /**
     * Consolidate user data to prepare for the install.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'name'     => 'required|max:255',
            'email'    => 'required|unique:users|email|max:255',
            'company'  => 'required|max:255',
            'password' => 'min:6|confirmed'
        ]);

        User::create([
            'name'       => $request->name,
            'email'      => $request->email,
            'company'    => $request->company,
            'is_realtor' => 1,
            'password'   => bcrypt($request->password)
        ]);

        $email     = urlencode($request->email);
        $agentData = Installer::configure(Mothership::agentData($email));

        return response()->json($agentData);
    }
}
