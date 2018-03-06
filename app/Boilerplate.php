<?php

namespace App;

use App\User;
use App\Lead;
use App\Content;
use App\MetaData;

class Boilerplate
{
    public static function metaData()
    {
        $user = User::realtor();

        MetaData::create([
            'title' => $user->company . ' | ' . $user->name,
            'description' => 'Combining experience, honesty, and state-of-the-art analytics, discover why '. $user->name .' is the perfect Bay County realtor to help you find your new home.'

        ]);
    }

    public static function content()
    {
        $user = User::realtor();

        Content::create([
            'title' => $user->name . ', Real Estate Expert',
            'body' => 'Use this area to tell the world why they should conduct their real estate business with you'
        ]);
    }

    public static function lead()
    {
        Lead::create([
            'name'    => 'Kerigan Marketing Associates',
            'email'   => 'web@kerigan.com',
            'phone'   => '(850) 648-4560',
            'message' => 'Thanks for choosing KMA! We think this is the beginning of a beautiful relationship. Let us know if there\'s anything we can do for you!'
        ]);
    }
}
