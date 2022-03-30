<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Models\City;
use App\Models\OrganizationRole;
use App\Models\User;
use App\Models\UserOrganizationMembership;
use App\Models\UserOrganizationMembershipRole;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $num_rows = $request->input('num_rows', 10);
        // $services = User::where('organization_id', organization_id())->sortable('id')->paginate($num_rows)->withQueryString();
        $current_organization_id = organization_id(true);

        $members = UserOrganizationMembership::with('user') -> where('organization_id', $current_organization_id) -> sortable('user.id')->paginate($num_rows)->withQueryString();
        return view('members.index', compact(
            'members',
            'num_rows',
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::orderBy('name') -> get();
        $organization_roles = OrganizationRole::orderBy('id', 'DESC') -> get();
        return view('members.create', compact(
            'cities',
            'organization_roles'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRegisterRequest $request)
    {
        // dd($request -> all());

        $current_organization_id = organization_id();
        

        $user = new User();
        $user -> name = $request -> name;
        $user -> email = $request -> email;
        $user -> password = Hash::make($request -> password);
        $user -> phone_number = $request -> phone_number;
        $user -> address = $request -> address;
        $user -> area_id = $request -> area_id;
        $user -> user_state_id = 1;
        $user -> save();

        event(new Registered($user));


        $organization_membersip = new UserOrganizationMembership();
        $organization_membersip -> user_id = $user -> id;
        $organization_membersip -> organization_id = $current_organization_id;
        $organization_membersip -> save();

        $role_id = $request -> input('role_id', '3');
        if (empty($role_id)){
            $role_id = '3';
        }

        $membersip_role = new UserOrganizationMembershipRole();
        $membersip_role -> organization_role_id = $role_id;
        $membersip_role -> user_organization_membership_id = $organization_membersip -> id;
        $membersip_role -> save();


        return redirect() -> route('members.index') -> with('message', 'Member added successfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
