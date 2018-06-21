<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Image;
use Mbarwick83\Instagram\Instagram;

class PictureController extends Controller
{
    //
    public function index()
    {
        return view('picture');
    }



    // // Get login url:
    // function index(Instagram $instagram)
    // {
    // 	return $instagram->getLoginUrl();
    // 	// or Instagram::getLoginUrl();
    // }
    //
    // // Get access token on callback, once user has authorized via above method
    // function callback(Request $request, Instagram $instagram)
    // {
    // 	$response = $instagram->getAccessToken($request->code);
    // 	// or $response = Instagram::getAccessToken($request->code);
    //
    //     if (isset($response['code']) == 400)
    //     {
    //         throw new \Exception($response['error_message'], 400);
    //     }
    //
    //     return $response['access_token'];
    // }
}
