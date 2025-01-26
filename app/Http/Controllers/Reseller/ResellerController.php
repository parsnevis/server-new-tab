<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResellerController extends Controller
{
    public function __constarct()
    {
//        $this->middleware('auth:reseller');
    }


    /**
     * Show the application console.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
//        dd(Auth::guard('reseller')->user());
        $_auth = Auth::guard('reseller')->User();
//        $_url = $this->baseData($request)['url'];
//        $_siteSettings = app('requireFunction')->siteSettings();

//        dd($_auth);
        return view('reseller.dashboard',
            compact('_auth'));
    }
}
