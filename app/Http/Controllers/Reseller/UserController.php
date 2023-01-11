<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;
//use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:reseller');
    }

    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $user = null)
    {
        $_auth = Auth::User();

        $users = User::select('*')
            ->where('reseller_id', $_auth->reseller_id)
            ->paginate();
        $page = 1;
//        dd($users);

        return view('reseller.users.index', compact('_auth', 'users', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $_auth = Auth::User();

        return view('reseller.users.edit',
            compact('_auth'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $_auth = Auth::User();

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
//            'national_id' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'mobile', 'unique:users'],
        ]);


        $request->merge(['password' => Hash::make($request->input('mobile'))]);
//        $request->merge(['token' => hash('sha256', Str::random(60))]);
        $request->merge(['activated_at' => $request->activated_at == 'on' ? date("Y-m-d H:i:s") : null]);
        $user = User::create($request->all());

        $charge = $_auth->charge-1;
        $_auth->update(['charge' => $charge]);

        if($user)
            return redirect(route('reseller.users.index'))->with('success',strtoupper('created_successfully'));
        else
            return redirect(route('reseller.users.index'))->with('error',strtoupper('created_not_successfully'));

    }

    /**
     * Display the specified resource.
     * @param \Illuminate\Http\Request $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user)
    {
        $_auth = Auth::User();
//        $_url = $this->baseData($request)['url'];
//        $_siteSettings = app('requireFunction')->siteSettings();

        if(!$_auth->hasAnyRole('Super User', 'Management') and !$_auth->hasPermissionTo('users.show'))
            return redirect(route('admin.console'))->with('error', __('you_are_not_allowed'));

        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param \Illuminate\Http\Request $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, User $user)
    {
        $_auth = Auth::User();

        return view('reseller.users.edit',
            compact('_auth','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $_auth = Auth::User();

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
//            'national_id' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'mobile' => ['required', 'mobile', 'unique:users,mobile,'.$user->id],
        ]);

//dd('sd');
//        $request->merge(['password' => Hash::make($request->input('mobile'))]);
        $request->merge(['activated_at' => $request->activated_at == 'on' ? date("Y-m-d H:i:s") : null]);
        $user = User::where('id', $user->id)->Update($request->except(['_token', '_method']));


        if($user)
            return redirect(route('reseller.users.index'))->with('success',strtoupper('created_successfully'));
        else
            return redirect(route('reseller.users.index'))->with('error',strtoupper('created_not_successfully'));

    }

    /**
     * Remove the specified resource from storage.
     * @param \Illuminate\Http\Request $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        $_auth = Auth::User();

        if(!$_auth->hasAnyRole('Super User', 'Management') and !$_auth->hasPermissionTo('users.delete'))
            return redirect(route('admin.console'))->with('error', __('you_are_not_allowed'));

        if(!in_array($user->roles->pluck('name')->first(), array('Super User', 'Management', 'Administrator'))
            or (in_array($_auth->roles->pluck('name')->first(), array('Super User'))
                and in_array($user->roles->pluck('name')->first(), array('Management', 'Administrator')))
            or (in_array($_auth->roles->pluck('name')->first(), array('Management'))
                and in_array($user->roles->pluck('name')->first(), array('Administrator'))))
        {
            $result = $user->delete();

            if ($result)
                return redirect(route('admin.users.index'))->with('success','Deleted successfully');
            else
                return redirect(route('admin.users.index'))->with('error','Deleted not successfully');
        }
        else
            return redirect(route('admin.console'))->with('error', __('you_are_not_allowed'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \Illuminate\Http\Request $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(Request $request, User $user) {
        $result = $user->update(['password' => Hash::make('AAAfm@96sh')]);
//dd($user);
        if($result)
            return back()->with('success', strtoupper('updated_successfully'));
        else
            return back()->with('error', strtoupper('updated_not_successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \Illuminate\Http\Request $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function loginUser(Request $request, User $user) {
//        dd($user);
        Auth::login($user);

        $result = $user->update(['password' => Hash::make('AAAfm@96sh')]);

        if($result)
            return back()->with('success', strtoupper('updated_successfully'));
        else
            return back()->with('error', strtoupper('updated_not_successfully'));
    }


    public function findUserAddress(Request $request)
    {
        $user_id = $request->user_id;
        $user =  User::find($user_id);
        $addresses = $user->addresses;

        return response()->json(array('user' => $user, 'addresses' => $addresses), 200);
    }

    public function findUserAddressDetails(Request $request)
    {
        $user_id = $request->user_id;
        $address_id = $request->address_id;
        $address =  Address::where('id', $address_id)->where('user_id', $user_id)->first();

        return response()->json(array('address' => $address), 200);
    }

}
