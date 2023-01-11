<?php

namespace App\Http\Controllers;

use App\Models\Reseller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function register_from_app_create()
    {

        return view('register-from-app-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register_from_app_store(Request $request)
    {
//        dd($request->all());
//        $request->validate([
//            'company_name' => ['required', 'string', 'max:255'],
////            'last_name' => ['required', 'string', 'max:255'],
////            'national_id' => ['required', 'string', 'email', 'max:255', 'unique:resellers'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:resellers'],
////            'mobile' => ['required', 'mobile', 'unique:resellers'],
//        ]);
//
//
//        $request->merge(['password' => Hash::make($request->input('password'))]);
//        $request->merge(['token' => (string) Str::uuid()]);
//        $request->merge(['activated_at' => $request->activated_at == 'on' ? date("Y-m-d H:i:s") : null]);
//
//
//        $user = Reseller::create($request->all());
//
//        if($user)
//            return redirect(route('reseller.dashboard'))->with('success',strtoupper('created_successfully'));
//        else
//            return redirect(route('reseller.users.index'))->with('error',strtoupper('created_not_successfully'));

    }
}
